<?php
if (!session_id()) session_start();
function post_data($url, $data_string)
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

$url="http://localhost/mytest/center_transaction_2.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buy'])) {
        $size = '';
        $size .= chr(ord('Z') - $_POST['buy']-1);
        $arr[0] = $_SESSION[$size][0];
        $arr[1] = $_SESSION[$size][1];
        $arr[2] = $_SESSION[$size][2];
        $arr[3] = $_SESSION[$size][3];
//var_dump($arr);
        $data = array("stock_id" => $arr[0], "stock_price" => $arr[1], "stock_number" => $arr[2], "user_id" => $_COOKIE['user'], "date" => $arr[3], "type" => 3);
        //var_dump($data);
        echo "<br>";
        $ab = json_encode($data);
        //var_dump($ab);
        echo "<br>";
        $result = post_data($url, $ab);
        //var_dump($result);echo "<br>";
        $result1 = json_decode($result);
       //var_dump($result1);echo "<br>";
        if ($result1->re == 1) {
            echo "<script language=\"JavaScript\">\r\n";
            echo " alert(\"撤回成功!\");\r\n";
           echo " location.replace(\"result.php\");\r\n"; // 自己修改网址
            echo "</script>";
            exit;
        } else {
            echo "<script language=\"JavaScript\">\r\n";
            echo " alert(\"撤回失败!\");\r\n";
           echo " location.replace(\"result.php\");\r\n"; // 自己修改网址
            echo "</script>";
            exit;
        }
        }
        if (isset($_POST['sell'])) {
            $size = '';
            $size .= chr(ord('Z') - $_POST['sell']-1);

            $arr[0] = $_SESSION[$size][0];
            $arr[1] = $_SESSION[$size][1];
            $arr[2] = $_SESSION[$size][2];
            $arr[3] = $_SESSION[$size][3];
           // echo "<br>";
           // echo "<br>";
            $data = array("stock_id" => $arr[0], "stock_price" => $arr[1], "stock_number" => $arr[2], "user_id" => $_COOKIE['user'], "date" => $arr[3], "type" => 2);
           // echo "<br>";
           // var_dump($data);
            $ab = json_encode($data);
            $result = post_data($url, $ab);
          // var_dump($result);
            $result1 = json_decode($result);
            if ($result1->re == 1) {
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"撤回成功!\");\r\n";
               echo " location.replace(\"result.php\");\r\n"; // 自己修改网址
                echo "</script>";
                exit;
            } else {
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"撤回失败!\");\r\n";
               echo " location.replace(\"result.php\");\r\n"; // 自己修改网址
                echo "</script>";
                exit;
            }
        }

}