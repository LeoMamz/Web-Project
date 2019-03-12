<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/1/8
 * Time: 12:29
 */
// 允许上传的图片后缀
//echo "<script language=\"JavaScript\">\r\n";
//echo " alert(\"错误：: " . "\");\r\n";
//echo "location.href='tea_ppt.php';";
//echo "</script>";
//exit;
header("Content-Type: text/html;charset=utf-8");
$con = mysqli_connect("localhost","root","mamz","seweb");
if (!$con){
    die('Could not connect: ' . mysqli_error());
}
mysqli_query($con , "set names utf8");
$t=time();
$time=date("Y-m-d H:i:s",$t);

$query="SELECT COUNT(DISTINCT hw_id) as hw_count FROM offline_work_sub";
$res=mysqli_query($con,$query);
if($res) {
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $count = $row["hw_count"];
        }
    }
}
echo $count . "sdfasfdsadf ";
$query="SELECT info, ddl FROM offline_work WHERE cid=\"0100\" AND ddl > $t";
$res=mysqli_query($con,$query);
if($res) {
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $info = htmlspecialchars_decode($row["info"]);
            var_dump($info);
            $info = json_decode($info, JSON_UNESCAPED_UNICODE);
            var_dump($row["info"]);
            $a = json_decode($row["info"]);
            var_dump(json_decode($row["info"],true));
            json_last_error();
            $file_path = $info["file_path"];
        }
    }
}

$json = '{"title":"是开发建设的立法","desc":"看见分厘卡圣诞节分开了说的fs sadf 的sdf s地方士大夫","time":"2019-01-09 18:45:11","state":"s","file_path":"hw/5.pdf","uploader":"琼琼"}';

var_dump(json_decode($json));
var_dump(json_decode($json, true));

$path = "/testweb/home.php";

$filename = "hw/a.test.vid";
$houzhui = substr(strrchr($filename, '.'), 1);
$result = basename($filename,".".$houzhui);
//显示带有文件扩展名的文件名
$a = basename($path);

//显示不带有文件扩展名的文件名
$b = basename($path,".php");
echo $a ."   ";
echo $b ."   ";
echo $result ."   ";
$t=time();
$time=date("Y-m-d H:i:s",$t);
echo $time;
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    var_dump($_GET);
    var_dump($_POST);
    echo "123132";
}

exit;
$allowedExts = array("pdf", "pptx", "ppt");
$temp = explode(".", $_FILES["file"]["name"]);
echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "application/pdf")
        || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint"))
    && ($_FILES["file"]["size"] < 20480000)   // 小于 20000 kb
    && in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"错误：: " . $_FILES["file"]["error"] . "\");\r\n";
        echo "location.href='tea_ppt.php';";
        echo "</script>";
        exit;
//        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        echo "<script language=\"JavaScript\">\r\n";
//        echo " alert(\"上传文件名: " . $_FILES["file"]["name"] . "<br>\");\r\n";
//        echo "location.href='tea_ppt.php';";
//        echo "</script>";
//        exit;
        echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
        echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
        echo "文件大小: " . ($_FILES["file"]["size"] / 1024 /1024) . " MB<br>";
        echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";

        // 判断当期目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("upload/" . $_FILES["file"]["name"]))
        {
            echo "location.href='tea_upload_file_deal.php';";
            echo " alert(\" " . $_FILES["file"]["name"] . "文件已经存在。\");\r\n";
//            echo $_FILES["file"]["name"] . " 文件已经存在。 ";
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            $file_name = iconv("UTF-8","gb2312", $_FILES["file"]["name"]);
            move_uploaded_file($_FILES["file"]["tmp_name"], "kejian/" . $file_name);
            echo " alert(\" 文件存储在: " . $_FILES["file"]["name"] . "\");\r\n";
//            echo "文件存储在: " . "kejian/" . $_FILES["file"]["name"];
        }
    }
}
else
{
    echo " alert(\" 非法的文件格式\");\r\n";
//    echo "非法的文件格式";
}
?>