<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/6/19
 * Time: 13:42
 */
/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $signout = $_POST["signout"];
}
if($signout){
    setcookie("user", "", time()-3600);
    header("Location:login.html");
}*/
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_COOKIE["user"])){
    header("Location:login.html");
    exit();
}
include "index.html";

?>

