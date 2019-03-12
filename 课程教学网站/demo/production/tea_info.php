<!DOCTYPE html>
<?php
session_start();
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
<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/1/8
 * Time: 12:29
 */
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
        echo "location.href='tea_info.php';";
        echo "</script>";
    }else {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\"删除文件失败！\");\r\n";
        echo "location.href='tea_info.php';";
        echo "</script>";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_POST["file"])){
//      echo "<script>if(confirm('你确定要删除该文章吗？')){location:tea_ppt.php;}</script>";
//      echo "<script language=\"JavaScript\">\r\n";
//      echo " alert(\"错误：: \");\r\n";
//      echo "location.href='tea_upload_file_deal.php';";
//      echo "</script>";
//    $allowedExts = array("pdf", "ppt","doc");
    $temp = explode(".", $_FILES["file"]["name"]);
    echo $_FILES["file"]["size"];
    $extension = end($temp);     // 获取文件后缀名
    if (($_FILES["file"]["size"] < 204800000))// 小于 20000 kb
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "<script language=\"JavaScript\">\r\n";
            echo " alert(\"错误：: " . $_FILES["file"]["error"] . "\");\r\n";
            echo "location.href='tea_info.php';";
            echo "</script>";
            exit;
//        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
        }
        else
        {
//              echo "<script language=\"JavaScript\">\r\n";
//        echo " alert(\"上传文件名: " . $_FILES["file"]["name"] . "<br>\");\r\n";
//        echo "location.href='tea_ppt.php';";
//        echo "</script>";
//        exit;
            echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
            echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
            echo "文件大小: " . ($_FILES["file"]["size"] / 1024 /1024) . " MB<br>";
            echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
            $file_name = iconv("UTF-8","gb2312", $_FILES["file"]["name"]);
            // 判断当期目录下的 upload 目录是否存在该文件
            // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
            if (file_exists("cankaoziliao/" . $file_name))
            {
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"" . $_FILES["file"]["name"] . "文件已经存在。\");\r\n";
                echo "location.href='tea_info.php';";
                echo "</script>";
                exit;
//            echo $_FILES["file"]["name"] . " 文件已经存在。 ";
            }
            else
            {
                // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                $file_name_utf8 = $_FILES["file"]["name"];
                $file_name = iconv("UTF-8","gb2312", $_FILES["file"]["name"]);
                move_uploaded_file($_FILES["file"]["tmp_name"], "cankaoziliao/" . $file_name);

                $cid = "0100";
                $file_path = "cankaoziliao/" . $file_name;
                $file_path_utf8 = "cankaoziliao/" . $file_name_utf8;
                $t=time();
                $time=date("Y-m-d H:i:s",$t);
                $state = "s";
                $type = "zl";
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
                echo "location.href='tea_info.php';";
                echo "</script>";
//            echo "文件存储在: " . "cankaoziliao/" . $_FILES["file"]["name"];
            }
        }
    }
    else
    {
        echo "<script language=\"JavaScript\">\r\n";
        echo " alert(\" 非法的文件格式\");\r\n";
        echo "location.href='tea_info.php';";
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
                        <h3>参考资料发布</h3>
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
                                <h2>参考资料发布</h2>
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
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="online-tab">
                                    <?php
                                    $con = mysqli_connect("localhost","root","mamz","seweb");
                                    if (!$con){
                                        die('Could not connect: ' . mysqli_error());
                                    }
                                    mysqli_query($con , "set names utf8");
                                    $query="SELECT file_path, file_name, upload_time, file_id FROM coursefile WHERE cid=\"0100\" AND state!=\"t\" AND TYPE=\"zl\" AND delete_type=0";
                                    $res=mysqli_query($con,$query);
                                    if($res) {
                                        if (mysqli_num_rows($res) > 0) {
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                $file_id = $row["file_id"];
                                                echo "
                    <div class=\"row\" id=\"hw\">
                      <div class=\"col-md-12 col-sm-12 col-xs-12\">
                        <div class=\"x_panel\">
                          <div class=\"x_title\">
                            <h2>" . $row["file_name"] . "</h2>
                            <ul class=\"nav navbar-right panel_toolbox\">
                              <li><a class=\"collapse-link\"><i class=\"fa fa-chevron-down\"></i></a>
                              </li>
                            </ul>
                            <div class=\"clearfix\"></div>
                          </div>                 
                            <div class=\"x_content collapse\">";
                                                echo "
                              <div class=\"bs-example\" data-example-id=\"simple-jumbotron\">
                                <div style=\"height: 80px;border-radius: 10px;background: #edb7b7;line-height: 80px;padding-left:20px;font-size: 20px;color: #712424;\">
                                  <p><small>上传时间：</small><strong>" . $row["upload_time"] . "</strong></p>
                                </div>
                              </div>
                              <br />
                              <p><a href=\"" . $row["file_path"] . "\"><i class=\"fa fa-download\"></i><strong> 下载</strong></a></p>                         
                              <input type=\"hidden\" name=\"type\" value='1'>
                              <p><a href=\"tea_info.php?id=$file_id\" name='delete_file'><i class=\"glyphicon glyphicon-trash\" id='delete_file' ></i><strong> 删除</strong></a></p>
                                  ";
                                                echo "
                            <br />
                            </div>
                            <div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"height:10px\"></div>
                            </div>
                        </div>
                      </div>
                    </div>
                ";
                                            }
                                        }
                                    }
                                    $con->close();
                                    ?>
                                    <form action="tea_info.php" class="dropzone" id="form_hw3" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="file" id="file" >
                                    </form>
                                    <br />
                                    <button type="submit" form="form_hw3" class="btn btn-primary">发布</button>
                                    <br />
                                    <br />
                                    <br />
                                </div>

                                <!--                    <p><a href=""><i class="fa fa-download"></i><strong> 第一章课件</strong></a></p>-->
                                <!--                    <p><a href=""><i class="fa fa-download"></i><strong> 第二章课件</strong></a></p>-->
                                <!--                    <p><a href=""><i class="fa fa-download"></i><strong> 第三章课件</strong></a></p>-->
                                <!--                    <p><a href=""><i class="fa fa-download"></i><strong> 第四章课件</strong></a></p>-->
                                <!--                    <p>将文件拖入提交框中或点击提交框上传文件，上传完毕后请点击“提交”按钮。</p>-->

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