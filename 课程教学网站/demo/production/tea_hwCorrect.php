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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["grade"])){
    $sub_id = $_POST["sub_id"];
    $t=time();
    $time=date("Y-m-d H:i:s",$t);
    $arr=array(
        'grade'=>$_POST["grade"],
        'comment'=>$_POST["comment"],
        'time'=>$time,
    );
    $grade_info = urlencode(json_encode($arr,JSON_UNESCAPED_UNICODE));
    $con = mysqli_connect("localhost","root","mamz","seweb");
    if (!$con){
        die('Could not connect: ' . mysqli_error());
    }
    mysqli_query($con , "set names utf8");
    $query="UPDATE offline_work_sub SET grade_info = \"$grade_info\", state = 1 WHERE sub_id = $sub_id";
    $re = mysqli_query($con,$query);
    if($re) {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\" 作业批改成功！\");\r\n";
        echo "</script>";
    }
    $con->close();

}

$con = mysqli_connect("localhost","root","mamz","seweb");
if (!$con){
    die('Could not connect: ' . mysqli_error());
}
mysqli_query($con , "set names utf8");

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
                <h3>作业批改和点评</h3>
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
              <?php
              $query="SELECT DISTINCT hw_id FROM offline_work_sub order by hw_id";
              $res=mysqli_query($con,$query);
              if($res) {
                  if (mysqli_num_rows($res) > 0) {
                      $i = 0;
                      while ($row = mysqli_fetch_assoc($res)) {
                          $hw_id = $row["hw_id"];$i++;
                            $query0="SELECT info FROM offline_work where hw_id = $hw_id";
                            $res0=mysqli_query($con,$query0);
                            if($res0) {
                                    if (mysqli_num_rows($res0) > 0) {
                                         while ($row0 = mysqli_fetch_assoc($res0)) {
                                             $info = urldecode($row0["info"]);
                                             $info = json_decode($info,JSON_UNESCAPED_UNICODE);
                                             echo "
                          <div class=\"row\" id=\"hw1\">
              <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                  <div class=\"x_title\">
                    <h2>作业：".$info["title"]."</h2>
                    <ul class=\"nav navbar-right panel_toolbox\">
                      <li><a class=\"collapse-link\"><i class=\"fa fa-chevron-up\"></i></a>
                      </li>
                      <li class=\"dropdown\">
                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"><i class=\"fa fa-wrench\"></i></a>
                        <ul class=\"dropdown-menu\" role=\"menu\">
                          <li><a href=\"#\">Settings 1</a>
                          </li>
                          <li><a href=\"#\">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class=\"close-link\"><i class=\"fa fa-close\"></i></a>
                      </li>
                    </ul>
                    <div class=\"clearfix\"></div>
                  </div>                 
                          ";
                                             if($i == 1) echo "
                                             <div class=\"x_content\" style=\"display: block\">
                                             ";
                                             else echo "
                                             <div class=\"x_content\" style=\"display: none\">
                                             ";
                                             $query1="SELECT *,(SELECT COUNT(uid) FROM offline_work_sub NATURAL JOIN myuser WHERE hw_id = $hw_id) AS hw_count 
                              FROM offline_work_sub NATURAL JOIN myuser WHERE hw_id = $hw_id AND state = 0 GROUP BY sub_id ORDER BY sub_id";
//                           $query1="SELECT *,  FROM offline_work_sub where hw_id = $hw_id order by sub_id";
                                             $res1=mysqli_query($con,$query1);
                                             if($res1) {
                                                 if (mysqli_num_rows($res1) > 0) {
                                                     while ($row1 = mysqli_fetch_assoc($res1)) {
                                                         $sub_info = urldecode($row1["sub_info"]);
                                                         $sub_info = json_decode($sub_info,JSON_UNESCAPED_UNICODE);

                                                         echo "
                                      <form id=\"demo-form2\" data-parsley-validate class=\"form-horizontal form-label-left\" action='tea_hwCorrect.php' method='post'>
                      <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"padding:5px\">
                        <div class=\"col-md-3 col-sm-3 col-xs-12\"></div>
                        <div class=\"col-md-3 col-sm-3 col-xs-12\" >共提交<strong> ".$row1["hw_count"]." </strong>份
                        </div>
                      </div>
                      <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"padding:5px\">
                        <div class=\"col-md-3 col-sm-3 col-xs-12\"></div>
                        <div class=\"col-md-3 col-sm-3 col-xs-12\" >学生：".$row1["uname"]."
                        </div>
                      </div>
                      <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"padding:5px\">
                        <div class=\"col-md-3 col-sm-3 col-xs-12\"></div>
                        <div class=\"col-md-3 col-sm-3 col-xs-12\" >学号：".$row1["uid"]."
                        </div>
                      </div>
                      <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"padding:5px\">
                        <div class=\"col-md-3 col-sm-3 col-xs-12\"></div>
                        <div class=\"col-md-3 col-sm-3 col-xs-12\" >提交时间：".$sub_info["time"]."
                        </div>
                      </div>
                      <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"padding:5px\">
                        <div class=\"col-md-3 col-sm-3 col-xs-12\"></div>
                        <div class=\"col-md-3 col-sm-3 col-xs-12\" ><a href=\"".$sub_info["file_path"]."\"><u>提交作业下载</u></a>
                        </div>
                      </div>
                      <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"padding:5px\">
                      </div>
                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"grade\">成绩：
                        </label>
                        <div class=\"col-md-3 col-sm-3 col-xs-12\">
                          <input type=\"text\" id=\"grade\" name='grade' class=\"form-control col-md-7 col-xs-12\">
                        </div>
                      </div>
                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"comment\">评语：
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <textarea id=\"comment\" name='comment' placeholder=\"请输入评语...\" style=\"width: 100%;min-height: 200px\"></textarea>
                        </div>
                      </div>

                      <div class=\"ln_solid\"></div>
                      <div class=\"form-group\">
                        <div class=\"col-md-6 col-sm-6 col-xs-12 col-md-offset-3\">
                        <input type='hidden' name='sub_id' value='".$row1["sub_id"]."'>
              <button class=\"btn btn-primary\" type=\"reset\">清除</button>
                          <button type=\"submit\" class=\"btn btn-success\">确认</button>
                        </div>
                      </div>

                    </form>
</div>
                      </div>
</div>

                                      ";
                                                     }
                                                 }
                                             }
                                         }
                                    }
                            }

                      }
                  }
              }

              ?>

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