<?php
/*
//检测是否登录，若没登录则转向登录界面
if(!isset($_COOKIE["user"])){
echo "<script language=\"JavaScript\">\r\n";
echo " alert(\"用户未登陆\");\r\n";
echo " location.replace(\"login.html\");\r\n"; // 自己修改网址
echo "</script>";
exit;}

*/

function http_post_data($url, $data_string) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($data_string))
    );

    $return_content = curl_exec($ch);

    curl_close($ch);

    return  $return_content;
}
$url='http://localhost/mytest/center_transaction_2.php';
$stock_id="";
$data1="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stock_id = $_POST["stock_id"];
    $data1 = json_encode(array('stock_id' => $stock_id , 'type' => 7));
}
$a = http_post_data($url, $data1);
$b= json_decode($a);

if($b->re2 == 1){
    $url='http://localhost/Administration/Client_interface/sec';//账户组
    $stock_id=$user_id="";
    $data2 = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stock_id = $_POST["stock_id"];
        $user_id =$_COOKIE["user"];
        $stock_number = $_POST['stock_number'];
        $data2 = json_encode(array('stock_id' => $stock_id, 'user_id'=> $user_id ));
    }
    $c = http_post_data($url, $data2);
    $d = json_decode($c);
    if($d ->stock_num >= $stock_number){
        $url='http://localhost/mytest/center_transaction_2.php';//交易组
        //json_encode()函数 将生成一个json编码

        $date=date('y-m-d h:i:s');
        $stock_id=$stock_price=$stock_number=$user_id="";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $stock_id = $_POST["stock_id"];
            $stock_price = $_POST["stock_price"];
            $stock_number = $_POST["stock_number"];
            $user_id = $_COOKIE['user'];
            $data3 = json_encode(array('stock_id' => $stock_id, 'stock_price' =>$stock_price , 'stock_number' => $stock_number , 'user_id' => $user_id ,  'date' => $date,'type' => 0 ));

        }
        $e = http_post_data($url,$data3);
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"交易已发出\");\r\n";
       echo " location.replace(\"result.php\");\r\n"; // 自己修改网址
        echo "</script>";
        exit;
    }
  else{

      echo "<script language=\"JavaScript\">\r\n";
      echo " alert(\"抱歉！出售数量大于持有数量\");\r\n";
      echo " history.back();\r\n";
      echo "</script>";
      exit;

  }
}
else{
    echo "<script language=\"JavaScript\">\r\n";
    echo " alert(\"抱歉！股票不存在或已停止交易\");\r\n";
    echo " history.back();\r\n";
    echo "</script>";
    exit;
}




