<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/6/23
 * Time: 21:24
 */
//echo "<script src=\"javascript/jquery.js\"></script>";
//session_start();
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

$url  = "http://localhost/grdeUI1.0/test1.11.php";
/*ignore_user_abort();//关闭浏览器后，继续执行php代码
set_time_limit(0);//程序执行时间无限制
$sleep_time = 5*60;//多长时间执行一次*/
//while(true){
    $c = 0;
    $remID = array();
    if(!isset($_SESSION['size'])) $daxiao = 0;
    else $daxiao = $_SESSION['size'];
    $rem = array();
    for($i = 0; $i < $daxiao; $i++){
        $size = '';
        $size .= chr(ord('a') + $i);
        if(isset($_SESSION[$size]) && $_SESSION[$size][7] == 0){
            $remID[$c] = $_SESSION[$size][0];
            $rem[$c++] = $size;
        }
    }
    $data = json_encode(array('remID'=>$remID,'size'=>$c));
    $jsonReturn = post_data($url, $data);
    $re = json_decode($jsonReturn);
    $l = 0;
    for($i = 0; $i < $c; $i++){
        $j = 1;
        $k = 7;
        /*$size = '';
        $size .= chr(ord('a') + $i);*/
        while($j < 7){
            if($re[$i][$j] >= $_SESSION[$rem[$i]][$j]) $_SESSION[$size][$k+$j] = 1;
            else $_SESSION[$size][$k+$j] = 0;
            $j++;
        }
    }

    // 写到这里了
    //sleep($sleep_time);//等待时间，进行下一次操作。
//}
//exit();