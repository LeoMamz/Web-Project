<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/6/25
 * Time: 14:30
 */
session_start();
function post_data($url, $postData) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($postData))
    );
    $return_content = curl_exec($ch);
    curl_close($ch);
    return  $return_content;
}
$url  = "http://localhost/stock/testquit.php";
if(!isset($_SESSION['size'])) $size= 0;
else $size = $_SESSION['size'];
$j = 0;
for($i = 0; $i < $size; $i++){
    $id = '';
    $id .= chr(ord('a') + $i);
    if(isset($_SESSION[$id]) && $_SESSION[$size][5] == 0){
        $a = $_SESSION[$id][0];
        $b = $_SESSION[$id][1];
        $c = $_SESSION[$id][2];
        $d = $_SESSION[$id][3];
        $e = $_SESSION[$id][4];
        $re[$j++] = array($a, $b,$c,$d,$e);
    }
}
if(isset($re)) {
    $data = json_encode(array('re'=>$re, 'user'=>$_COOKIE['user']));
    $jsonReturn = post_data($url, $data);
    $return = json_decode($jsonReturn);
    //echo $return;
}
setcookie("user", "", time()-3600);
session_unset();
//session_destroy();
header("Location:login.html");
