<?php
// DEBUG
//$remID = array('0000101041', '0000101044');
//$c = 2;
//$data = json_encode(array('remID' => $remID, 'size' => $c));
// END DEBUG
$postData = file_get_contents('php://input');//$data;//
$re = json_decode($postData,true);
$size = $re['size'];
$p = array();
for($i = 0; $i < $size; $i++){
    $p[$i] = $re['remID'][$i]; // 数组$p中存储着需要查询价格变化的股票的ID
}
//你们在这里进行查询,将数据存储在二位数组$rem[][]中，
//其中$rem[i][0]中为股票ID；
//$rem[i][1]到$rem[i][3]中逐个为涨价、跌价、涨幅、diefu
//具体的样式参考下面的数组$return
$conn = new mysqli("localhost","root","123456");//数据库帐号密码为安装数据库时设置
if(mysqli_errno($conn)){
    echo mysqli_errno($conn);
    exit;
}
mysqli_select_db($conn,"stock");
mysqli_set_charset($conn,'utf8');
for($i=0;$i<$size;$i++){
    $sql= "select stock_price from message where stock_id='$p[$i]'";
    $res=mysqli_query($conn,$sql);
    $current_price=mysqli_fetch_array($res);
    $current_price = $current_price[0];
    $yestsql="select closing_price from dailyinfo where stock_name=(select stock_name from message where stock_id='$p[$i]') order by date desc limit 1" ;
    $result=mysqli_query($conn,$yestsql);
    $closing_price=mysqli_fetch_array($result);
    $closing_price = $closing_price[0];
    $rise_price=$current_price-$closing_price;
    $drop_price=-$rise_price;
    if($rise_price>=0){
        $drop_price=0;
        $temp=$rise_price/$closing_price*100;
        $rise_ammount=round($temp,2);
        $drop_amount = 0;
    }
    else{
        $rise_price=0;
        $temp=$drop_price/$closing_price*100;
        $drop_amount=round($temp,2);
        $rise_ammout=0;
    }
    $re[$i]=array($p[$i],$rise_price,$drop_price,$rise_ammount,$drop_amount);
}
$rem = $re;
$r = json_encode($rem);
echo $r;