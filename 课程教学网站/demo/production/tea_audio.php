<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>软件工程教学网站-教师</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Dropzone.js -->
    <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>
  <?php
  session_start();
  if(!isset($_SESSION['user'])||$_SESSION['user']!="t"){
      echo "<script>alert(\"您还未登录！\");window.location=\"login.php\";</script>";
  }
  header("Content-Type: text/html;charset=utf-8");
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
      $file_id = $_GET["id"];
      $con = mysqli_connect("localhost","root","mamz","seweb");
      if (!$con){
          die('Could not connect: ' . mysqli_error());
      }
      mysqli_query($con , "set names utf8");
      $query="update coursefile set delete_type = 1 where file_id = $file_id";
      $re = mysqli_query($con,$query);
      if($re){
          echo "<script language=\"JavaScript\">\r\n";
          echo " alert(\"删除文件成功！\");\r\n";
          echo "location.href='tea_audio.php';";
          echo "</script>";
      }else {
          echo "<script language=\"JavaScript\">\r\n";
          echo " alert(\"删除文件失败！\");\r\n";
          echo "location.href='tea_audio.php';";
          echo "</script>";
      }
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_POST["file"])){
      $allowedExts = array("pdf", "ppt","doc");
      $temp = explode(".", $_FILES["file"]["name"]);
      echo $_FILES["file"]["size"];
      $extension = end($temp);     // 获取文件后缀名
      if (!strcmp($extension,"mp3")
          || !strcmp($extension,"wma")
          || !strcmp($extension,"mmf")
          || !strcmp($extension,"amr")
          || !strcmp($extension,"wav"))
      {
          if ($_FILES["file"]["error"] > 0)
          {
              var_dump($_FILES["file"]["error"]) ;
              echo "<script language=\"JavaScript\">\r\n";
              echo " alert(\"错误：: " . $_FILES["file"]["error"] . "\");\r\n";
              echo "location.href='tea_audio.php';";
              echo "</script>";
              exit;
          }
          else
          {
              echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
              echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
              echo "文件大小: " . ($_FILES["file"]["size"] / 1024 /1024) . " MB<br>";
              echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
              $file_name = iconv("UTF-8","gb2312", $_FILES["file"]["name"]);
              // 判断当期目录下的 upload 目录是否存在该文件
              // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
              if (file_exists("audios/" . $file_name))
              {
                  echo "<script language=\"JavaScript\">\r\n";
                  echo " alert(\"" . $_FILES["file"]["name"] . "文件已经存在。\");\r\n";
                  echo "location.href='tea_audio.php';";
                  echo "</script>";
                  exit;
//            echo $_FILES["file"]["name"] . " 文件已经存在。 ";
              }
              else
              {
                  // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                  $file_name_utf8 = $_FILES["file"]["name"];
                  $file_name = iconv("UTF-8","gb2312", $_FILES["file"]["name"]);
                  move_uploaded_file($_FILES["file"]["tmp_name"], "audios/" . $file_name);

                  $cid = "0100";
                  $file_path = "audios/" . $file_name;
                  $file_path_utf8 = "audios/" . $file_name_utf8;
                  $t=time();
                  $time=date("Y-m-d H:i:s",$t);
                  $state = "s";
                  $type = "yp";
                  if(isset($_SESSION["uname"]))$uploader = $_SESSION["uname"];
                  else $uploader = "";
                  $con = mysqli_connect("localhost","root","mamz","seweb");
                  if (!$con){
                      die('Could not connect: ' . mysqli_error());
                  }
                  mysqli_query($con , "set names utf8");
                  $query="insert into coursefile (cid, file_path, file_name, upload_time, state,type, uploader) VALUES(\"$cid\",\"$file_path_utf8\",\"$file_name_utf8\",\"$time\",\"$state\",\"$type\",\"$uploader\")";
                  mysqli_query($con,$query);

                  echo "<script language=\"JavaScript\">";
                  echo " alert(\" 文件存储在: " . $_FILES["file"]["name"] . "\");\r\n";
                  echo "location.href='tea_audio.php';";
                  echo "</script>";
//            echo "文件存储在: " . "kejian/" . $_FILES["file"]["name"];
              }
          }
      }
      else
      {
          echo "<script language=\"JavaScript\">\r\n";
          echo " alert(\" 非法的文件格式\");\r\n";
          echo "location.href='tea_audio.php';";
          echo "</script>";
          exit;
//    echo "非法的文件格式";
      }
  }
  ?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
                <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-cloud"></i> <span>软件工程教学</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/black_glasses.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>欢迎,</span>
                  <?php
                  header("Content-type: text/html; charset=utf8");
                  $uname=$_SESSION['uname'];
                  echo "<h2>".$uname." 老师</h2>";
                  ?>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>教学目录</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> 课程信息 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tea_course.php">课程介绍</a></li>
                      <li><a href="tea_teacher.php">教师介绍</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-download"></i> 资料发布 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tea_ppt.php">课件</a></li>
                      <li><a href="tea_model.php">模板</a></li>
                      <li><a href="tea_info.php">参考资料</a></li>
                      <li><a href="tea_goodHw.php">以往优秀作业</a></li>
                      <li><a href="tea_video.php">教学视频</a></li>
                      <li><a href="tea_audio.php">教学音频</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> 课堂作业 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tea_hw.php">作业发布</a></li>
                      <li><a href="tea_hwCorrect.php">作业批改和点评</a></li>
                      <li><a href="tea_hwPosted.php">已发布的作业</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> 信息通知 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tea_notice.php">通知发布</a></li>
                      <li><a>已发布的通知<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="tea_comm.php">交流心得</a>
                            </li>
                            <li><a href="tea_shortNotice.php">临时通知</a>
                            </li>
                            <li><a href="tea_longNotice.php">永久通知</a>
                            </li>
                          </ul>
                      </li>
                    </ul>
                  </li>
                  <li><a href="tea_help.php"><i class="fa fa-info-circle"></i> 网站使用指南 </a>
                  </li>
                  <li><a href="tea_relativeLinks.php"><i class="fa fa-map-marker"></i> 友情链接 </a>
                  </li>
                  <li><a href="tea_notepad.php"><i class="fa fa-book"></i> 留言板 </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/black_glasses.jpg" alt=""><?=$uname?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="tea_help.php">帮助</a></li>
                    <li><a href="login.php"><i class="fa fa-sign-out pull-right"></i> 登出</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>教学音频发布</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="输入你想搜索的内容...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">搜索</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>音频发布</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                        <?php
                        $con = mysqli_connect("localhost","root","mamz","seweb");
                        if (!$con){
                            die('Could not connect: ' . mysqli_error());
                        }
                        mysqli_query($con , "set names utf8");
                        $query="SELECT file_path, file_name, upload_time, file_id, uploader FROM coursefile WHERE cid=\"0100\" AND state!=\"t\" AND TYPE=\"yp\" AND delete_type=0";
                        $res=mysqli_query($con,$query);
                        if($res) {
                            if (mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $file_id = $row["file_id"];
                                    $file_name = $row["file_name"];
                                    $houzhui = substr(strrchr($file_name, '.'), 1);
                                    $file_name_front = basename($file_name,".".$houzhui);
                                    echo "
                                    <div class=\"col-md-55\">
                        <div class=\"thumbnail\" style=\"height:200px\">
                          <div class=\"image view view-first\">
                            <img style=\"width: 100%; display: block;\" src=\"images/video.png\" alt=\"image\" />
                            <div class=\"mask no-caption\">
                              <div class=\"tools tools-bottom\">
                                <a href=\"tea_audio1_play.php?id=".$row["file_id"]."\"><i class=\"fa fa-play-circle-o\"></i></a>
                                <a href=\"".$row["file_path"]."\"><i class=\"fa fa-download\"></i></a>
                                <a href=\"tea_audio.php?id=".$row["file_id"]."\"><i class=\"glyphicon glyphicon-trash\"></i></a>                                
                              </div>
                            </div>
                          </div>
                          <div class=\"caption\">
                            <p><strong>$file_name_front</strong>
                            </p>
                            <p><i class=\"fa fa-user\"></i> ".$row["uploader"]."</p>
                            <p><i class=\"glyphicon glyphicon-time\"></i> ".$row["upload_time"]."</p>
                          </div>
                        </div>
                      </div>
                                    ";
                                }
                            }
                        }
                        ?>
                    </div>
                    <p>将文件拖入提交框中或点击提交框上传文件，上传完毕后请点击“提交”按钮。</p>
                    <form action="tea_audio.php" class="dropzone" id="form_hw3">
                        <input type="hidden" name="file" id="file" >
                    </form>
                    <br />
                      <button type="submit" form="form_hw3" class="btn btn-primary">发布</button>
                    <br />
                    <br />
                    <br />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            浙江大学软件工程教学网站
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Dropzone.js -->
    <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

  </body>
</html>