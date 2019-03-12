<!DOCTYPE html>
<?php
error_reporting( E_ALL&~E_NOTICE );
session_start();
if(!isset($_SESSION['user'])||$_SESSION['user']!="t"){
    echo "<script>alert(\"您还未登录！\");window.location=\"login.php\";</script>";
}
$cid="0100"; //整合时改为session
$uid=$_SESSION['uid'];
$uname=$_SESSION['uname'];
$conn = mysqli_connect("localhost","root","mamz","seweb");
if (!$conn){
    die('Could not connect: ' . mysqli_error());
}
mysqli_query($conn , "set names utf8");
?>
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
                <h3>已发布的作业</h3>
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
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content1" id="online-tab" role="tab" data-toggle="tab" aria-expanded="true">在线作业</a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content2" role="tab" id="offline-tab" data-toggle="tab" aria-expanded="false">离线作业</a>
                      </li>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="online-tab">
                          <?php
                          $onlineSql="select * from onlinehw order by hwno asc;";
                          $onlineRes = $conn->query($onlineSql);
                          $onlineCount=0;
                          while($onlineRow = $onlineRes->fetch_assoc()){
                              $onlineCount++;
                              $selectquestionSql="select * from selectquestion where chap='".$onlineRow["chap"]."'order by qno asc;";
                              $selectquestionRes = $conn->query($selectquestionSql);
                              $textquestionSql="select * from textquestion where chap='".$onlineRow["chap"]."'order by qno asc;";
                              $textquestionRes = $conn->query($textquestionSql);
                              $questionCount=0;
                              echo "
                        <div class=\"row\" id=\"hw\">
                          <div class=\"col-md-12 col-sm-12 col-xs-12\">
                            <div class=\"x_panel\">
                              <div class=\"x_title\">
                                <h2>在线作业".$onlineCount.": ".$onlineRow["hwname"]."</h2>
                                <ul class=\"nav navbar-right panel_toolbox\">
                                  <h2>ddl: ".$onlineRow["ddl"]."  </h2>
                                  <li><a class=\"collapse-link\"><i class=\"fa fa-chevron-down\"></i></a>
                                  </li>
                                </ul>
                                <div class=\"clearfix\"></div>
                              </div>                 
                                <div class=\"x_content collapse\">";
                              while($selectquestionRow = $selectquestionRes->fetch_assoc()){
                                  $questionCount++;
                                  echo "
                            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                                <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"padding:20px;min-height: 50px\">
                                    题目".$questionCount.": ".$selectquestionRow["content"]."
                                </div>
                                <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"padding:20px;min-height: 50px\">
                                    正确答案：".$selectquestionRow["ans"]."
                                </div>
                                <div class=\"form-group\" name=\"option".$questionCount."\">
                                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                       <div class=\"radio\" >
                                        <label>
                                          <input type=\"radio\" value=\"option1\" id=\"option1\" name=\"option".$questionCount."\">
                                            ".$selectquestionRow["optiona"]."
                                        </label>
                                      </div>
                                      <div class=\"radio\">
                                        <label>
                                          <input type=\"radio\" value=\"option2\" id=\"option2\" name=\"option".$questionCount."\">
                                           ".$selectquestionRow["optionb"]."
                                        </label>
                                      </div>
                                      <div class=\"radio\">
                                        <label>
                                          <input type=\"radio\" value=\"options3\" id=\"option1\" name=\"option".$questionCount."\">
                                          ".$selectquestionRow["optionc"]."
                                        </label>
                                      </div>
                                      <div class=\"radio\">
                                        <label>
                                          <input type=\"radio\" value=\"option4\" id=\"option4\" name=\"option".$questionCount."\">
                                           ".$selectquestionRow["optiond"]."
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"height:5px;background: #CCCCCC\"></div>
                            </div>";
                              }
                              while($textquestionRow = $textquestionRes->fetch_assoc()){
                                  $questionCount++;
                                  echo "
                            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                                <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"padding:20px;min-height: 50px\">
                                    题目".$questionCount.". ".$textquestionRow["content"]."                        
                                </div>
                                <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"padding:20px;min-height: 50px\">
                                    正确答案：".$textquestionRow["ans"]."                        
                                </div>
                                <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"height:5px;background: #CCCCCC\"></div>
                            </div>";
                              }
                              echo"                  
                        <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"height:10px\"></div>
                                </div>
                            </div>
                          </div>
                        </div>
                    ";
                          }
                          ?>
                      </div>
                      <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="offline-tab">
                          <?php
                          $con = mysqli_connect("localhost","root","mamz","seweb");
                          if (!$con){
                              die('Could not connect: ' . mysqli_error());
                          }
                          mysqli_query($con , "set names utf8");
                          $t=time();
                          $time=date("Y-m-d H:i:s",$t);
                          $query="SELECT info, ddl,hw_id FROM offline_work WHERE cid=\"0100\" AND ddl > $t";
                          $res=mysqli_query($con,$query);
                          if($res) {
                              if (mysqli_num_rows($res) > 0) {
                                  while ($row = mysqli_fetch_assoc($res)) {
                                      $info = urldecode($row["info"]);
                                      $info = json_decode($info,JSON_UNESCAPED_UNICODE);
//                                      var_dump($row["info"]);
//                                      $a = json_decode($row["info"]);
//                                      var_dump($a);
                                      $file_path = $info["file_path"];
                                      echo "
                          <div class=\"row\" id=\"hw1\">
                              <div class=\"col-md-12 col-sm-12 col-xs-12\">
                                  <div class=\"x_panel\">
                                      <div class=\"x_title\">
                                        <h2>".$info["title"]."</h2>
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
                                      <div class=\"x_content\">
                                        <p>作业描述：</p>
                                        <p>".$info["desc"]."</p>
                                      <p>提交截止时间：".$row["ddl"]." </p>
                                      <p><u><a href=\"".$info["file_path"]."\" >作业附件下载</a></u></p>                                                                
                                      </div>
                                  </div>
                              </div>
                          </div>
                          ";
                                  }
                              }
                          }


                          ?>
                          
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