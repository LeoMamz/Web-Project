<?php
include "buystock.php";
function http_post_json($url,$jsonstr){
    //init
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$jsonstr);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_TIMEOUT,1);
    curl_setopt($ch,CURLOPT_HTTPHEADER,array(
        'Content_Type:application/json;charset=utf-8',
        'Content_Length:'.strlen($jsonstr)));
    //exec
    $resp=curl_exec($ch);
    $httpcode=curl_getinfo($ch,CURLINFO_HTTP_CODE);
    //close
    curl_close($ch);
    return array($httpcode,$resp);
}
function http_post_data($url, $data_string) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($data_string))
    );
    ob_start();
    curl_exec($ch);
    $return_content = ob_get_contents();
    //echo $return_content."<br>";
    ob_end_clean();
    //  return array($return_code, $return_content);
    return  $return_content;
}
$url=' ';
$stock_id="";
$data1="";
if($stock_id == ''){
    echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('交易已发出');
           </script>";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location:login.html");

    $stock_id = $_POST["stock_id"];
    $data1 = json_encode(array('stock_id' => $stock_id ));
}
$a = http_post_data($url, $data1);
$b=json_decode($a);
if($b->bool==1){
    $url=' ';
    $stock_id=$user_id="";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_POST["user"];
        $stock_number =$_POST["stock_number"];
        $stock_price = $_POST["stock_price"];
        $buy_money =$stock_price * $stock_number;
        $data2 = json_encode(array('user_id'=> $user_id ));
    }
    $c = http_post_data($url, $data2);
    $d = json_decode($c);
    if($d->money > $buy_money ){
        $url='0.0.0.0/8080';
        //json_encode()函数 将生成一个json编码

        $date=date('y-m-d h:i:s');
        $stock_id=$stock_price=$stock_number=$user_id="";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $stock_id = $_POST["stock_id"];
            $stock_price = $_POST["stock_price"];
            $stock_number = $_POST["stock_number"];
            $user_id = $_COOKIE['user'];
            $jsonstr = json_encode(array('stock_id' => $stock_id, 'stock_price' =>$stock_price , 'stock_number' => $stock_number , 'user_id' => $user_id ,  'date' => $date,'type' => 0 ));

        }
        list($returncode,$returncontent)=http_post_json($url,$jsonstr);

    }
    else{
        echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('抱歉！资金不足');
           </script>";

        /*echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"抱歉！资金不足\");\r\n";
        echo " history.back();\r\n";
        echo "</script>";
        exit;*/

    }
}
else{

    echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('抱歉！股票不存在或已停止交易');
           </script>";
    /*echo "<script language=\"JavaScript\">\r\n";
    echo " alert(\"抱歉！股票不存在或已停止交易\");\r\n";
    echo " history.back();\r\n";
    echo "</script>";
    exit;*/
}


?>

<?php
echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('交易已发出');
           </script>";
/*echo "<script language=\"JavaScript\">\r\n";
echo " alert(\"交易已发出\");\r\n";
echo " location.replace(\"result.php\");\r\n"; // 自己修改网址
echo "</script>";
exit;*/
?>
