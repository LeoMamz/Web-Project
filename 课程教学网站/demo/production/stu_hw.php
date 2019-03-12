<!DOCTYPE html>
<?php
error_reporting( E_ALL&~E_NOTICE );
session_start();
if(!isset($_SESSION['user'])||$_SESSION['user']!="s"){
    echo "<script>alert(\"您还未登录！\");window.location=\"login.php\";</script>";
}
$cid="0100"; //整合时改为session
$uid=$_SESSION['uid'];
$uname=$_SESSION['uname'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])){
    $temp = explode(".", $_FILES["file"]["name"]);
    echo $_FILES["file"]["size"];
    $extension = end($temp);     // 获取文件后缀名
    if ($_FILES["file"]["size"] < 204800000)
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "<script language=\"JavaScript\">\r\n";
            echo " alert(\"错误：: " . $_FILES["file"]["error"] . "\");\r\n";
            echo "location.href='stu_hw.php';";
            echo "</script>";
            exit;
        }
        else
        {
            $file_name = iconv("UTF-8","gb2312", $_FILES["file"]["name"]);
            // 判断当期目录下的 upload 目录是否存在该文件
            // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
            if (file_exists("hw_sub/" . $file_name))
            {
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"" . $_FILES["file"]["name"] . "作业文件已经存在，可修改文件名后再次提交。\");\r\n";
                echo "location.href='stu_hw.php';";
                echo "</script>";
                exit;
//            echo $_FILES["file"]["name"] . " 文件已经存在。 ";
            }
            else
            {
                // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                $file_name_utf8 = $_FILES["file"]["name"];
                $file_name = iconv("UTF-8","gb2312", $_FILES["file"]["name"]);
                move_uploaded_file($_FILES["file"]["tmp_name"], "hw_sub/" . $file_name);
                $cid = "0100";
                $file_path = "hw_sub/" . $file_name;
                $file_path_utf8 = "hw_sub/" . $file_name_utf8;
                $t=time();
                $time=date("Y-m-d H:i:s",$t);
                $hw_id = $_POST["hw_id"];
                if(isset($_SESSION["uname"]))$uploader = $_SESSION["uname"];
                else $uploader = "";
                $arr=array(
                    'time'=>$time,
                    'file_name'=>$file_name_utf8,
                    'file_path'=>$file_path_utf8,
                    'uploader'=>$uploader,
                );
                $sub_info = urlencode(json_encode($arr,JSON_UNESCAPED_UNICODE));
                $con = mysqli_connect("localhost","root","mamz","seweb");
                if (!$con){
                    die('Could not connect: ' . mysqli_error());
                }
                mysqli_query($con , "set names utf8");
                $query0 = "select * from offline_work_sub where hw_id = $hw_id and uid = $uid";
                $res = mysqli_query($con,$query0);
                $re = 0;
                if($res) {
                    if (mysqli_num_rows($res) == 0) {
                        $query="insert into offline_work_sub (uid, hw_id, sub_info) VALUES(\"$uid\",\"$hw_id\", '".$sub_info."')";
//                echo $query;
                        $re = mysqli_query($con,$query);
                    }
                }
                if($re) {
                    echo "<script language=\"JavaScript\">\r\n";
                    echo " alert(\" 作业提交成功！\");\r\n";
                    echo "</script>";
                    echo "<script language=\"JavaScript\">\r\n";
                    echo " alert(\"
                    附件名称: " . $_FILES["file"]["name"] . "<br>
                    附件类型: " . $_FILES["file"]["type"] . "<br>
                    附件大小: " . ($_FILES["file"]["size"] / 1024 /1024) . " MB<br>\");\r\n";
                    echo "</script>";
                }else{
                    echo "<script language=\"JavaScript\">\r\n";
                    echo " alert(\" 作业提交失败！\");\r\n";
                    echo "</script>";
                }
                $con->close();
            }
        }
    }
    else
    {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\" 非法的文件格式\");\r\n";
        echo "location.href='stu_hw.php';";
        echo "</script>";
        exit;
//    echo "非法的文件格式";
    }
}

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

    <title>软件工程教学网站-学生</title>

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
                <h2><?=$uname?> 学生</h2>
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
                      <li><a href="stu_course.php">课程介绍</a></li>
                      <li><a href="stu_teacher.php">教师介绍</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-download"></i> 资料下载 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="stu_ppt.php">课件</a></li>
                      <li><a href="stu_model.php">模板</a></li>
                      <li><a href="stu_info.php">参考资料</a></li>
                      <li><a href="stu_goodHw.php">以往优秀作业</a></li>
                      <li><a href="stu_video.php">教学视频</a></li>
                      <li><a href="stu_audio.php">教学音频</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> 课堂作业 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="stu_hw.php">作业提交</a></li>
                      <li><a href="stu_hwUpload.php">上传列表</a></li>
                      <li><a href="stu_hwGrades.php">作业成绩</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> 信息通知 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="stu_comm.php">交流心得</a></li>
                      <li><a href="stu_shortNotice.php">临时通知</a></li>
                      <li><a href="stu_longNotice.php">永久通知</a></li>
                    </ul>
                  </li>
                  <li><a href="stu_help.php"><i class="fa fa-info-circle"></i> 网站使用指南 </a>
                  </li>
                  <li><a href="stu_relativeLinks.php"><i class="fa fa-map-marker"></i> 友情链接 </a>
                  </li>
                  <li><a href="stu_forum.php"><i class="fa fa-edit"></i> 小组论坛 </a>
                  </li>
                  <li><a href="stu_notepad.php"><i class="fa fa-book"></i> 留言板 </a>
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
                    <li><a href="stu_help.php">帮助</a></li>
                    <li><a href="login.php"><i class="fa fa-sign-out pull-right"></i> 登出</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                      <?php
                      $conn1=mysqli_connect("localhost","root","mamz","seweb");
                      if(!$conn1){
                          die("连接错误：".mysqli_connect_error());
                      }
                      mysqli_query($conn1,"set names utf8");
                      $note_sql="select author,title,create_time,state from notice 
							where state='1' or state='2' order by create_time desc limit 5";
                      $note_res=mysqli_query($conn1,$note_sql);
                      $count=mysqli_num_rows($note_res);
                      echo "
								<span class='badge bg-green'>".$count."</span>
							  </a>
							  <ul id='menu1' class='dropdown-menu list-unstyled msg_list' role='menu'>";
                      if($count>0){
                          while($row=mysqli_fetch_assoc($note_res)){
                              if($row['state']==1){
                                  echo "<li>
											  <a href='stu_shortNotice.php#notice'>
												<span class='image'><img src='images/img.jpg' alt='Profile Image' /></span>";
                                  echo "<span><span>".$row['author']."</span>
											<span class='time'>".$row['create_time']."</span></span>
												<span class='message'>".$row['title']."</span></a></li>";
                              }
                              else{
                                  echo "<li>
											  <a href='stu_longNotice.php#notice'>
												<span class='image'><img src='images/img.jpg' alt='Profile Image' /></span>";
                                  echo "<span><span>".$row['author']."</span>
											<span class='time'>".$row['create_time']."</span></span>
												<span class='message'>".$row['title']."</span>";
                              }
                          }
                      }
                      echo "</a></li></ul>";
                      ?>
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
                <h3>作业提交 </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="输入想要搜索的内容...">
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
                              if($onlineRow["ddl"] > date("Y-m-d")){
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
                                <div class=\"x_content collapse\">
                            <form id=\"demo-form3\" data-parsley-validate class=\"form-horizontal form-label-left\" method=\"post\">";
                                  while($selectquestionRow = $selectquestionRes->fetch_assoc()){
                                      $questionCount++;
                                      echo "
                            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                                <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"padding:20px;min-height: 50px\">
                                    题目".$questionCount.": ".$selectquestionRow["content"]."
                                </div>                                
                                <div class=\"form-group\" name=\"option".$questionCount."\">
                                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                       <div class=\"radio\" >
                                        <label>
                                          <input type=\"radio\" value=\"A\" id=\"option1\" name=\"option".$questionCount."\">
                                            ".$selectquestionRow["optiona"]."
                                        </label>
                                      </div>
                                      <div class=\"radio\">
                                        <label>
                                          <input type=\"radio\" value=\"B\" id=\"option2\" name=\"option".$questionCount."\">
                                           ".$selectquestionRow["optionb"]."
                                        </label>
                                      </div>
                                      <div class=\"radio\">
                                        <label>
                                          <input type=\"radio\" value=\"C\" id=\"option1\" name=\"option".$questionCount."\">
                                          ".$selectquestionRow["optionc"]."
                                        </label>
                                      </div>
                                      <div class=\"radio\">
                                        <label>
                                          <input type=\"radio\" value=\"D\" id=\"option4\" name=\"option".$questionCount."\">
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
                                <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                    <textarea id=\"textans".$questionCount."\" name=\"textans".$questionCount."\" style=\"width: 100%;min-height: 150px\"></textarea>
                                </div>
                                <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"height:5px;background: #CCCCCC\"></div>
                            </div>";
                                  }
                                  echo"
                        <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"padding:20px;min-height: 50px\" align=\"center\">
                            <button type=\"submit\" class=\"btn btn-primary\" name=\"onlinebutton".$onlineCount."\">提交</button>                        
                         </div>
                         </form>                 
                        <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"height:10px\"></div>
                                </div>
                            </div>
                          </div>
                        </div>
                    ";
                                  if($_SERVER["REQUEST_METHOD"] == "POST"){
                                      if (isset($_POST["onlinebutton".$onlineCount])){
                                          $selectAnsSql="select ans from selectquestion where chap='".$onlineRow["chap"]."'order by qno asc;";
                                          $selectAnsRes = $conn->query($selectAnsSql);
                                          $textAnsSql="select ans from textquestion where chap='".$onlineRow["chap"]."'order by qno asc;";
                                          $textAnsRes = $conn->query($textAnsSql);
                                          $mark=0;
                                          $i=0;
                                          while($selectAnsRow = $selectAnsRes->fetch_assoc()){
                                              $i++;
                                              if($selectAnsRow['ans']== $_POST["option".$i]) $mark+=2;
                                          }
                                          while($textAnsRow = $textAnsRes->fetch_assoc()){
                                              $i++;
                                              if($textAnsRow['ans']== $_POST["textans".$i]) $mark+=2;
                                          }
                                          $time=date("Y-m-d");
                                          $insert = "insert into onlinehwgrades values ('".$onlineRow["hwno"]."','".$uid."','".$time."','".$mark."')";
                                          if ($conn->query($insert) === TRUE) {
                                              echo "<script>alert('作业提交成功');</script>";
                                          } else {
//                                              echo "Error: " . $sql . "<br>" . $conn->error;
                                              echo "<script>alert('您已提交过这份作业，请勿重复提交！');</script>";
                                          }
                                      }
                                  }
                              }
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
                                      <form action='stu_hw.php' method='post'  enctype='multipart/form-data'>                                      
                                        <input type=\"file\" name=\"file\" id=\"File\" class=\"dropzone\">
                                        <input type=\"hidden\" name=\"hw_id\" id=\"hw_id\" value='".$row["hw_id"]."'>
                                        <button type=\"submit\" class=\"btn btn-success\">提交作业</button>
                                      </form>                                 
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