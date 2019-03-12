<?php
$user = $_POST["UID"];
    $psw = $_POST["UPW"];
	session_start();
	$_SESSION['user']=$user;
    if(empty($user)||empty($psw))
    {
        //用户名或者密码其中之一为空，则弹出对话框，确定后返回当前页的上一页
        echo "<script>alert('请输入用户名及密码');history.back()</script>";
    }
    else
    { //确认用户名密码不为空，则连接数据库
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
        if($num)
        {
            
   
            echo "<script>alert('登陆成功');sessionStorage.setItem('usr', '$user');window.location.href='pages-profile.php';</script>";
        }
        else
        {
            echo "<script>alert('用户名或密码错误');history.back();</script>";
        }
    }
?>