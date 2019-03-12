<?php
$user = $_POST["UID"];
$uname = $_POST["UNAME"];
$email = $_POST["MAIL"];
$phone = $_POST["PHONE"];
$h233 = $_POST["h233"];
$h233 = $_POST["h234"];
$psw = $_POST["PW"];

$conn = new mysqli("localhost","root","123456");//数据库帐号密码为安装数据库时设置
if(mysqli_errno($conn)){
    echo mysqli_errno($conn);
    exit;
}
mysqli_select_db($conn,"share_exchange");
mysqli_set_charset($conn,'utf8');
$sql = "select User_ID,Password from accounts where User_ID = '$user' and Password = '$psw'";
$result = mysqli_query($conn,$sql);
if (!$result){
}
$num = mysqli_num_rows($result);
if($num){
$sql= "update accounts set User_name='$uname' where User_ID = '$user'";
$result = mysqli_query($conn,$sql);
if(!$result){
    echo "<script>alert('更新失败');history.back();</script>";
}
$sql= "update accounts set Email='$email' where User_ID = '$user'";
$result = mysqli_query($conn,$sql);
if(!$result){
    echo "<script>alert('更新失败');history.back();</script>";
}
$sql= "update accounts set Phone='$phone' where User_ID = '$user'";
$result = mysqli_query($conn,$sql);
if(!$result){
    echo "<script>alert('更新失败');history.back();</script>";
}
echo "<script>alert('更改信息成功');window.location.href='pages-profile.php';</script>";
}

else{
    echo "<script>alert('密码错误');history.back();</script>";
}



?>