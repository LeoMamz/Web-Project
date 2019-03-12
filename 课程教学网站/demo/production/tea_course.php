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
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>
  <?php
  session_start();
  if(!isset($_SESSION['user'])||$_SESSION['user']!="t"){
      echo "<script>alert(\"您还未登录！\");window.location=\"login.php\";</script>";
  }
  $con = mysqli_connect("localhost","root","mamz","seweb");
  if (!$con){
      die('Could not connect: ' . mysqli_error());
  }
  mysqli_query($con , "set names utf8");
  $query="select cid, cname, introduction from course where cid=\"0100\" ";
  $res=mysqli_query($con,$query);
  if($res){
      if(mysqli_num_rows($res)>0) {
          while ($row = mysqli_fetch_assoc($res)) {
              $course_info=json_decode($row["introduction"],JSON_UNESCAPED_UNICODE);
          }
      }
  }
  $con->close();
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
              <a href="tea_course.php" class="site_title"><i class="fa fa-cloud"></i> <span>软件工程教学</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/black_glasses.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>欢迎,</span>
                <h2><?=$uname?> 老师</h2>
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
                    <img src="images/black_glasses.jpg" alt=""><?=$uname?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="tea_help.php">帮助</a></li>
                    <li><a href="loginout.php"><i class="fa fa-sign-out pull-right"></i> 登出</a></li>
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
                    <br />
                    <form id="course_form" data-parsley-validate class="form-horizontal form-label-left" action="tea_course.php" method="post">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="course_name">课程名 <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" name="course_name" class="form-control col-md-7 col-xs-12" readonly="true" placeholder="<?=$cname?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="course_number" >课程号 <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" name="course_number" class="form-control col-md-7 col-xs-12" readonly="true" placeholder="<?=$cid?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="teacher">授课教师 <span class="required" >*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" name="teacher" required="required" class="form-control col-md-7 col-xs-12" value="<?php if(isset($course_info["teacher"])) echo $course_info["teacher"]; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="time">课时安排 <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" name="time" required="required" class="form-control col-md-7 col-xs-12" value="<?php if(isset($course_info["time"])) echo $course_info["time"]; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="place">上课地点 <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" name="place" required="required" class="form-control col-md-7 col-xs-12" value="<?php if(isset($course_info["place"])) echo $course_info["place"]; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textbook">使用教材
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" name="textbook" class="form-control col-md-7 col-xs-12" value="<?php if(isset($course_info["textbook"])) echo $course_info["textbook"]; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pre_knowledge">选课预备知识
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" name="pre_knowledge" class="form-control col-md-7 col-xs-12" value="<?php if(isset($course_info["pre_knowledge"])) echo $course_info["pre_knowledge"]; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="introduction">课程简介 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="introduction" style="width: 100%" ><?php if(isset($course_info["introduction"])) echo $course_info["introduction"];?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="standard" >考核标准
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="standard" class="form-control col-md-7 col-xs-12" value="<?php if(isset($course_info["standard"])) echo $course_info["standard"]; ?>">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button class="btn btn-primary" type="reset">清除</button>
                          <button type="submit" name="submitCourse" class="btn btn-success">提交</button>
                        </div>
                      </div>
                    </form>
                    <?php
                    	$con = mysqli_connect("localhost","root","mamz","seweb");
						          if (!$con){
					               die('Could not connect: ' . mysqli_error());
				              }
                      mysqli_query($con , "set names utf8");
                      if (isset($_POST['submitCourse'])){
                        $arr=array(
                          'teacher'=>$_POST["teacher"],
                          'time'=>$_POST["time"],
                          'place'=>$_POST["place"],
                          'textbook'=>$_POST["textbook"],
                          'pre_knowledge'=>$_POST["pre_knowledge"],
                          'introduction'=>$_POST["introduction"],
                          'standard'=>$_POST["standard"],
                        );
                        $course_info=json_encode($arr,JSON_UNESCAPED_UNICODE);
                        $query="UPDATE course SET introduction='".$course_info."' where cid='".$cid."'";
                        mysqli_query($con,$query);
                      }
                    ?>
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


	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="jquery.serializejson.js"></script>
     <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

  </body>
</html>