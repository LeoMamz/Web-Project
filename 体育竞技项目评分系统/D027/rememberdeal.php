<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/6/22
 * Time: 22:11
 */
//include "remember.php";
session_start();
//session_unset();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST["ID"];
    $b = $_POST["priceup"];
    $c = $_POST["pricedown"];
    $d = $_POST["dayup"];
    $e = $_POST["daydown"];
    $del = 0;
    $p = array($a, $b, $c, $d, $e, $del);
    if(!isset($_SESSION['size'])) $_SESSION['size'] = 1;
    else $_SESSION['size'] = $_SESSION['size'] + 1;
    $size = '';
    $size .= chr(ord('a') + $_SESSION['size']-1);
    $_SESSION[$size] = $p;
}
header("Location:remember.php");
/*for($i = count($_SESSION); $i > 0; $i--){
    $size = '';
    $size .= chr(ord('a') + $i-1);
    if($_SESSION[$size][7] == 0){
        echo $_SESSION[$size][0], " ", $_SESSION[$size][1], " ", $_SESSION[$size][2], " ",
        $_SESSION[$size][3], " ", $_SESSION[$size][4], " ", $_SESSION[$size][5], " ", $_SESSION[$size][6];
    }
    echo "<br>";
    echo count($_SESSION);
}*/



