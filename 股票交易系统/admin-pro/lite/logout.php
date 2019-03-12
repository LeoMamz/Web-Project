<?php
session_start();
$_SESSION['user']=0;
echo  "<script>alert('注销成功');window.location.href='pages-login.html';</script>";
?>