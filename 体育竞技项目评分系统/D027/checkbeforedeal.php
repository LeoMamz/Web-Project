<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/11/15
 * Time: 11:58
 */
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/6/19
 * Time: 13:42
 */
session_start();
header("Content-Type: text/html;charset=utf-8");
//检测是否登录，若没登录则转向登录界面
if(!isset($_COOKIE["user"])){
    session_unset();
    header("Location:login.html");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["member_id"])) {
    $c = $_GET["member_id"];
    $check_type = $_GET["check_type"];
    $con = new mysqli("localhost", "root", "mamz", "d027");
    $con->query("set names 'UTF8'");
    if ($con->connect_error) {
        die('连接失败: ' . $con->connect_error);
    } else {
        $sql1 = "update group_members set check_status = 1 where member_id = $c";
        $re = $con->query($sql1);
        if(!$re){
            echo "<script>
layer.confirm('检录失败！', {
                title:'系统提示',
                btn: ['确定','取消']
            }, function(){
                location.href = 'checkbefore.php';
            });
</script>";
        }
    }
    $con->close();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["member_id"])) {
    $c = $_POST["member_id"];
    $check_type = $_POST["check_type"];
    $con = new mysqli("localhost", "root", "mamz", "d027");
    $con->query("set names 'UTF8'");
    if ($con->connect_error) {
        die('连接失败: ' . $con->connect_error);
    } else {
        $c = -$c;
        $sql1 = "update group_members set check_status = 0 where member_id = $c";
        $re = $con->query($sql1);
        if(!$re){
            echo "<script>
layer.confirm('检录失败！', {
                title:'系统提示',
                btn: ['确定','取消']
            }, function(){
                location.href = 'checkbefore.php';
            });
</script>";
        }
    }
    $con->close();
}
header("Location:checkbefore.php");