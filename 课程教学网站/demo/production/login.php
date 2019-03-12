<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>软件工程教学网站-登录</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
    body {
    background-image: url(images/login.jpg);
    background-repeat: no-repeat;
	background-size:100%; 
}
    </style>
  </head>

  <body>
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form" style="background: rgba(255,255,255,0.8);padding:20px;">
          <section class="login_content">
            <form id="login_post" method="post">
              <h1>用户登录</h1>
              <div>
                <input type="text" name="uid" class="form-control" placeholder="学号/工号" required="" />
              </div>
              <div>
                <input type="password" name="pwd" class="form-control" placeholder="浙大通行证密码" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default" name="login">登录</button>
                <a href="https://zuinfo.zju.edu.cn/securitycenter/findPwd/index.zf">找回密码</a>
              </div>
              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <p>©2016 All Rights Reserved. </p>
                </div>
              </div>
            </form>
            <?php
              $con = mysqli_connect("localhost","root","mamz","seweb");
              if (!$con){
                die('Could not connect: ' . mysqli_error());
              }
              mysqli_query($con , "set names utf8");
              if (isset($_POST['login'])){
                echo "yes";
                $uid=$_POST['uid'];
                $pwd=$_POST['pwd'];
                $query="SELECT * FROM myuser where uid='".$uid."'";
                $result_user=mysqli_query($con,$query);
                if(!mysqli_num_rows($result_user))                //如果没有这个用户
                  echo "<script>alert(\"您输入的学号或工号不正确！\")</script>";
                else{
                  $user=mysqli_fetch_array($result_user);
                  if(password_verify($pwd,password_hash($user['password'], PASSWORD_DEFAULT))){    //密码验证通过
                    session_start();
                    $_SESSION['uname']=$user['uname'];            //记录用户名
                    $_SESSION['uid']=$user['uid'];
                    if($user['type']=='t'){                       //如果是老师
                      $_SESSION['user']="t";
                      header("location: tea_course.php");         //跳转到老师页面
                    }
                    else{     //如果是学生
                      $query="SELECT * FROM coursestudent where uid='".$_POST['uid']."'";
                      $result_user=mysqli_query($con,$query);
                      if(!mysqli_num_rows($result_user)){         //如果不是这个课程的学生
                        $_SESSION['user']="g";
                        header("location: guest_course.php");
                      }
                      else{     //如果是这个课的学生
                        $_SESSION['user']="s";
                        header("location: stu_course.php");
                      }
                    }
                  }
                  else{     //密码验证不通过
                    echo "<script>alert(\"您输入的密码不正确！\")</script>";
                  }
                }
              }
            ?>
          </section>
        </div>
      </div>
  </div>
  <script type="text/javascript">
  	function check_login(){
  		var id=document.getElementsByName("identity");
  		if(id[0].checked){
  			window.location.href="stu_course.php";
  		}
  		else if(id[1].checked){
  			window.location.href="tea_course.php";
  		}
      else{
        window.location.href="guest_course.php"
      }
  	}
  </script>
</body>
</html>
