<?php
function http_post_data($url, $data_string)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($data_string))
    );

    $return_content = curl_exec($ch);

    curl_close($ch);

    return $return_content;

}

$url1 = 'http://localhost/mytest/center_transaction_2.php';
//$url1='http://localhost/stock/test13.php';
$stock_id = "";
$data1 = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stock_id = $_POST["stock_id"];
    $data1 = json_encode(array('stock_id' => $stock_id, 'type' => 7));
}
$a = http_post_data($url1, $data1);
$b = json_decode($a);
if ($b->re2 == 1) {
    $url2 = 'http://localhost/Administration/Client_interface/cap';//账户组
    $stock_id = $user_id = $buy_money = "";
    $data2 = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_COOKIE["user"];
        $stock_number = $_POST["stock_number"];
        $stock_price = $_POST["stock_price"];
        $buy_money = $stock_price * $stock_number;
        $data2 = json_encode(array('user_id' => $user_id));
    }

    $c = http_post_data($url2, $data2);
    $d = json_decode($c);

    if ($buy_money <= $d->active_cap) {
        $url3 = 'http://localhost/mytest/center_transaction_2.php';//交易组
        //json_encode()函数 将生成一个json编码

        $date = date('y-m-d h:i:s');
        $stock_id = $stock_price = $stock_number = $user_id = "";
        $data3 = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $stock_id = $_POST["stock_id"];
            $stock_price = $_POST["stock_price"];
            $stock_number = $_POST["stock_number"];
            $user_id = $_COOKIE['user'];
            $data3 = json_encode(array('stock_id' => $stock_id, 'stock_price' => $stock_price, 'stock_number' => $stock_number, 'user_id' => $user_id, 'date' => $date, 'type' => 1));

        }
        $e = http_post_data($url3, $data3);

        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"交易已发出\");\r\n";
        echo " location.replace(\"result.php\");\r\n"; // 跳到交易结果界面
        echo "</script>";
        exit;
    } else {

        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"抱歉！资金不足\");\r\n";
        echo " history.back();\r\n";  //返回原界面
        echo "</script>";
        exit;

    }
} else {
    echo "<script language=\"JavaScript\">\r\n";
    echo " alert(\"抱歉！股票不存在或已停止交易\");\r\n";
    echo " history.back();\r\n";  //返回原界面
    echo "</script>";
    exit;
}




