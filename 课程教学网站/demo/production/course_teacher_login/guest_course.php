<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>软件工程教学网站</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>
  <?php
    session_start();
    if(!isset($_SESSION['user'])||$_SESSION['user']!="g"){
      echo "<script>alert(\"您还未登录！\");window.location=\"login.php\";</script>";
    }
    $cid="0100";
    $cname="软件工程杂烩";
    $uid=$_SESSION['uid'];
    $uname=$_SESSION['uname'];
  ?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="guest_course.php" class="site_title"><i class="fa fa-cloud"></i> <span>软件工程教学</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>欢迎,</span>
                <h2><?=$uname?> 游客</h2>
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
                      <li><a href="guest_course.php">课程介绍</a></li>
                      <li><a href="guest_teacher.php">教师介绍</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-download"></i> 资料下载 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="guest_ppt.php">课件</a></li>
                      <li><a href="guest_model.php">模板</a></li>
                      <li><a href="guest_info.php">参考资料</a></li>
                      <li><a href="guest_goodHw.php">以往优秀作业</a></li>
                      <li><a href="guest_video.php">教学视频</a></li>
                      <li><a href="guest_audio.php">教学音频</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> 信息通知 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="guest_comm.php">交流心得</a></li>
                      <li><a href="guest_shortNotice.php">临时通知</a></li>
                      <li><a href="guest_longNotice.php">永久通知</a></li>
                    </ul>
                  </li>
                  <li><a href="guest_help.php"><i class="fa fa-info-circle"></i> 网站使用指南 </a>
                  </li>
                  <li><a href="guest_relativeLinks.php"><i class="fa fa-map-marker"></i> 友情链接 </a>
                  </li>
                  <li><a href="guest_notepad.php"><i class="fa fa-book"></i> 留言板 </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="loginout.php">
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
                    <img src="images/user.png" alt=""><?=$uname?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="guest_help.php">帮助</a></li>
                    <li><a href="loginout.php"><i class="fa fa-sign-out pull-right"></i> 登出</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    <span class="badge bg-green">4</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a href="guest_shortNotice.php#notice2">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>茅则冬</span>
                          <span class="time">7天前</span>
                        </span>
                        <span class="message">
                          冬第三周停课通知
                        </span>
                      </a>
                    </li>
                    <li>
                      <a href="guest_shortNotice.php#notice1">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>茅则冬</span>
                          <span class="time">1个月前</span>
                        </span>
                        <span class="message">
                          秋第八周停课通知
                        </span>
                      </a>
                    </li>
                    <li>
                      <a href="guest_longNotice.php#notice2">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>茅则冬</span>
                          <span class="time">3个月前</span>
                        </span>
                        <span class="message">
                          还是永久通知
                        </span>
                      </a>
                    </li>
                    <li>
                      <a href="guest_longNotice.php#notice1">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>茅则冬</span>
                          <span class="time">4个月前</span>
                        </span>
                        <span class="message">
                          永久通知
                        </span>
                      </a>
                    </li>
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
                <h3>课程基本信息</h3>
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
                    <h2>课程信息</h2>
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
                    <?php
                      $con = mysqli_connect("localhost:3306","root","mamz","SEWeb");
                      if (!$con){
                         die('Could not connect: ' . mysqli_error());
                      }
                      mysqli_query($con , "set names utf8");
                      $query="SELECT * FROM course where cid='".$cid."'";
                      $result_course=mysqli_query($con,$query);   //查询记录
                      $course=mysqli_fetch_array($result_course);
                      $course_json=$course['introduction'];
                      $course_info=json_decode($course_json,1);   //编译json字符串

                      //提取数据
                      $teacher=$course_info['teacher'];
                      $time=$course_info['time'];
                      $place=$course_info['place'];
                      $textbook=$course_info['textbook'];
                      $pre_knowledge=$course_info['pre_knowledge'];
                      $introduction=$course_info['introduction'];
                      $standard=$course_info['standard'];

                    ?>
                    <table id="datatable" class="table table-striped table-bordered">
                      <tbody>
                        <tr>
                          <td>课程名</td>
                          <td><?=$cname?></td>
                        </tr>
                        <tr>
                          <td>课程号</td>
                          <td><?=$cid?></td>
                        </tr>
                        <tr>
                          <td>授课教师</td>
                          <td><?=$teacher?></td>
                        </tr>
                        <tr>
                          <td>课时安排</td>
                          <td><?=$time?></td>
                        </tr>
                        <tr>
                          <td>上课地点</td>
                          <td><?=$place?></td>
                        </tr>
                        <tr>
                          <td>使用教材</td>
                          <td><?=$textbook?></td>
                        </tr>
                        <tr>
                          <td><?=$pre_knowledge?></td>
                          <td>无</td>
                        </tr>
                        <tr>
                          <td>课程简介</td>
                          <td><?=$introduction?></td>
                        </tr>
                        <tr>
                          <td>考核标准</td>
                          <td><?=$standard?></td>
                        </tr>
                      </tbody>
                    </table>
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
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

  </body>
</html>