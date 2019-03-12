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
    header("Location:login.html");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = 0;
    foreach ($_REQUEST as $key => $value){
        if($value == 1){
            $present = $_SESSION["present"];
            $present_order = $_SESSION["present_order"];
            if(!isset($sql1)) $sql1 = "update program set present = $present, present_order = $present_order where ";
            if($flag == 0) $sql1 = $sql1."program_id = ".$key." ";
            else $sql1 = $sql1." or program_id = ".$key." ";
            $flag = 1;
        }
    }
    if($flag == 0){
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"请选择选手上场！\");\r\n";
        echo "location.href='mainjudge1.php';";
        echo "</script>";
        exit;
    }
    $con = new mysqli("localhost", "root", "mamz", "d027");
    $con->query("set names 'UTF8'");
    if ($con->connect_error) {
        die('连接失败: ' . $con->connect_error);
    } else {
        mysqli_autocommit($con, FALSE);
        try{
            $re = $con->query($sql1);
            if(!$re){
                throw new Exception("ERROR_1: 上场失败！");
            }else{
                $_SESSION["present"] = $_SESSION["present"] + 1;
                $_SESSION["present_order"] = $present_order = $_SESSION["present_order"] + 1;
                $sql = "update mark set mark_num = $present_order where id = 1";
                $re = $con->query($sql1);
                if(!$re){
                    throw new Exception("ERROR_2: 上场失败！");
                }
                $con->commit();
                mysqli_autocommit($con, true);
                $con->close();
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"上场成功！\");\r\n";
                echo "location.href='mainjudge1.php';";
                echo "</script>";
                exit;
            }
        }catch(Exception $e){
            $con->rollback();
            mysqli_autocommit($con, true);
            $message = $e->getMessage();
            echo "<script language=\"JavaScript\">\r\n";
            echo " alert($message);\r\n";
            echo "location.href='mainjudge1.php';";
            echo "</script>";
            exit;
        }
    }
}

header("Location:mainjudge1.php");