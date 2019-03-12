<?php
$ID = (string)($_POST["UID"]);
$NAME = (string)($_POST["UNAME"]);
$PW1 = (string)($_POST["PW1"]);
$PW2 = (string)($_POST["PW2"]);
$PHONE = (string)($_POST["PH"]);
$EMAIL = (string)($_POST["EMAIL"]);
$TYPE = 1;

$conn = new mysqli("localhost","root","123456");//数据库帐号密码为安装数据库时设置
if(mysqli_errno($conn)){
    echo mysqli_errno($conn);
    exit;
}
mysqli_select_db($conn,"share_exchange");
mysqli_set_charset($conn,'utf8');


$sql = "select * from accounts where User_ID ='$ID'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('ID已存在');window.location.href='pages-register.html';</script>";
}else if($PW1!=$PW2){
    echo "<script>alert('两次输入的密码不同，请确认');window.location.href='pages-register.html';</script>";
}else {
    $sql = "insert into accounts values('$ID','$NAME','$PW1','$PHONE','$EMAIL','$TYPE')";
    $test = mysqli_query($conn, $sql);
    if ($test) echo "<script>alert('注册成功');window.location.href='pages-profile.php';</script>";
    else echo "<script>alert('注册失败');window.location.href='pages-register.html';</script>";
}
?>