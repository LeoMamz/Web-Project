<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/8/28
 * Time: 19:56
 */
echo "<script src=\"javascript/jquery.js\"></script>
<script src=\"javascript/plug-ins/customScrollbar.min.js\"></script>
<script src=\"javascript/plug-ins/echarts.min.js\"></script>
<script src=\"javascript/plug-ins/layerUi/layer.js\"></script>
<script src=\"editor/ueditor.config.js\"></script>
<script src=\"editor/ueditor.all.js\"></script>
<script src=\"javascript/plug-ins/pagination.js\"></script>
<script src=\"javascript/public.js\"></script>
	<script src=\"javascript/pages/login.js\"></script>";
session_start();
header("Cache-control:private");
if ($_SERVER["REQUEST_METHOD"] == "GET" ) {
    $filled = 0;
    if($_GET["itemname"] != ""){
        $filled++;
    }else {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"请选择项目!\");\r\n";
        echo "location.href='signup.php';";
        echo "</script>";
        exit;
    }
    if($_GET["conname"] != ""){
        $filled++;
    }else {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"请填写姓名!\");\r\n";
        echo "location.href='signup.php';";
        echo "</script>";
        exit;
    }
    if($_GET["conid"] != ""){
        $length = mb_strlen($_GET["conid"]);
        if($length != 10){
            echo "<script language=\"JavaScript\">\r\n";
            echo " alert(\"请填写正确的学号!\");\r\n";
            echo "location.href='signup.php';";
            echo "</script>";
            exit;
        }else $filled++;
    }else {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"请填写学号!\");\r\n";
        echo "location.href='signup.php';";
        echo "</script>";
        exit;
    }
    if($_GET["conunit"] != "") {
        $filled++;
    }else {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"请选择学院!\");\r\n";
        echo "location.href='signup.php';";
        echo "</script>";
        exit;
    }
    if($filled == 4) {//验证过项目编码而且都填完了才可以报名//验证展示去掉
        $itemname = $_GET["itemname"];
        $conname = $_GET["conname"];
        $conid = $_GET["conid"];
        $conunit = $_GET["conunit"];
        if ($_GET["consex"] == "2") {
            $consex = "男";

        } else if ($_GET["consex"] == "1") $consex = "女";
//        $groupid = $_SESSION["groupid"];
//        $itemid = $_SESSION["itemid"];
//        $itemname = $_SESSION["itemname"];
        $con = new mysqli("localhost", "root", "mamz", "d027");
        $con->query("set names 'UTF8'");
        if ($con->connect_error) {
            die('连接失败: ' . $con->connect_error);
        } else {
            $sql1 = "select * from item where item_name = '$itemname'";
            $re = $con->query($sql1);
            if ($re->num_rows > 0){
                //有查到相关记录
                $row = mysqli_fetch_assoc($re);
                $itemid = $row["item_id"];
                $groupid = $row["group_id"];
            }else{
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"项目不存在!\");\r\n";
                echo "location.href='signup.php';";
                echo "</script>";
                exit;
            }
            $sql2 = "select con_id from program where item_id = '$itemid'";
            $re_con_id = $con->query($sql2);
            $flag_con = 0;
            if ($re_con_id->num_rows > 0){
                //有查到相关记录
                while($row = $re_con_id->fetch_assoc()) {
                    if($conid == $row["con_id"]) {
                        $flag_con = 1;
                    }
                }
                if($flag_con == 1){
                    echo "<script language=\"JavaScript\">\r\n";
                    echo " alert(\"项目已报，不必重复报名!\");\r\n";
                    echo "location.href='signup.php';";
                    echo "</script>";
                    exit;
                }
            }
            if($flag_con == 0){
                $sql1 = "insert into program (group_id, item_id, con_id, con_name, con_sex, con_unit) values ($groupid, '$itemid', '$conid', '$conname', '$consex', '$conunit')";
                if(!$con->query($sql1)){
                    echo "<script language=\"JavaScript\">\r\n";
                    echo " alert(\"报名失败!\");\r\n";
                    echo "location.href='signup.php';";
                    echo "</script>";
                    exit;
                }else{
                    echo "<script language=\"JavaScript\">";
                    echo "alert(\"报名成功！可在下方通过学号搜索查看报名信息。\");";
                    echo "location.href='signup.php';";
                    echo "</script>";
//                    echo "<script language=\"JavaScript\">\r\n";
//                    echo " alert(\"报名成功！可在下方通过学号搜索查看报名信息。\");\r\n";
//                    echo " history.back();\r\n";
//                    echo "</script>";
//                    echo "<script language=\"JavaScript\"> location.href='signup.php';</script>";
                    exit;

//                    echo "<script  language=\"JavaScript\">
//layer.confirm('报名成功！可在下方通过学号搜索查看报名信息。', {
//                title:'系统提示',
//                btn: ['确定','取消']
//            }, function(){
//                location.href = 'signup.php';
//            });
//</script>";
                }
            }
        }
        $con->close();
        unset($_SESSION["verified"]);

    }
}
header("Location:signup.php");