<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/6/25
 * Time: 14:30
 */
session_start();

setcookie("user", "", time()-18000);
session_unset();
//session_destroy();
header("Location:login.html");
