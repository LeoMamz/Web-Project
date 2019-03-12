<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/6/23
 * Time: 17:19
 */

if (!session_id()) session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['update'])){
        $p = $_POST['update'];
        $_SESSION['upd'] = $p;;
        include "updateRem.php";
    }
    if (isset($_POST['delete'])){
        $p = $_POST['delete'];
        $_SESSION[$p][5] = 1;
    };




}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!session_id()) session_start();
    $size = $_SESSION['upd'];
    if ($_GET["priceup"] != "") $_SESSION[$size][1] = $_GET["priceup"];
    if ($_GET["pricedown"] != "") $_SESSION[$size][2] = $_GET["pricedown"];
    if ($_GET["dayup"] != "") $_SESSION[$size][3] = $_GET["dayup"];
    if ($_GET["daydown"] != "") $_SESSION[$size][4] = $_GET["daydown"];
}

header("Location:remember.php");