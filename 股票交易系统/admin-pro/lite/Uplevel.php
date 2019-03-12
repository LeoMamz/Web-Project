<?php
session_start();
$id=$_SESSION['user'];
$upgrademonth=$_POST["month"];
$money=30*(int)$upgrademonth;
echo "<script> alert('您确认支付 $money 吗？');</script>";
$con=mysql_connect("localhost", "root", "123456");
if(!$con){
	die('Could not connect:'.mysql_error());
}
mysql_select_db("share_exchange");
$sql="update accounts set type='2' where User_ID='$id'";

mysql_query($sql);
$res=mysql_affected_rows();

if($res) echo "<script> alert('支付成功！恭喜您成为高级用户');window.location.href='index.html';</script>";
else echo "<script> alert('支付失败！');window.location.href='pages-blank.html'</script>";
?>