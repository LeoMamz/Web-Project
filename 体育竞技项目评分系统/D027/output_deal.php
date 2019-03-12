<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/11/24
 * Time: 14:24
 */
if ($_SERVER["REQUEST_METHOD"] == "GET" ) {
    if(isset($_GET["post_type"])){
        $con = new mysqli("localhost", "root", "mamz", "d027");
        $con->query("set names 'UTF8'");
        if ($con->connect_error)
        {
            die('连接失败: ' . $con->connect_error);
        }else {
            $time = date("Y_m_d_h_i_sa");
            if($_GET["post_type"] == 2) {
                $sql = "select program_id, item_id, item_name, con_id, con_name, con_unit, grade1, grade2, grade3, grade4, grade5, final_grade from program natural join item into outfile 'D:/wamp64/tmp/grade_$time.csv' fields terminated by ',' optionally enclosed by '\"' lines terminated by '\n';";
            }
            else if($_GET["post_type"] == 1) $sql = "select program_id, item_id, item_name, con_id, con_name, con_unit from program natural join item into outfile 'D:/wamp64/tmp/signup_$time.csv' fields terminated by ',' optionally enclosed by '\"' lines terminated by '\n';";

            $time = date("Y_m_d_h_i_sa");
            $re = $con->query($sql);
            if(!$re){
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"导出数据失败！\");\r\n";
                if($_GET["post_type"] == 1) echo "location.href='signupstatistics.php';";
                else if($_GET["post_type"] == 2) echo "location.href='index.php';";
                echo "</script>";
                exit;

            }else{
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"导出数据成功！\");\r\n";
                if($_GET["post_type"] == 1) echo "location.href='signupstatistics.php';";
                else if($_GET["post_type"] == 2) echo "location.href='index.php';";
                echo "</script>";
                exit;
            }
        }
    }
}
header("Location:index.php");
