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
            echo "location.href='tea_hw.php';";
            echo "</script>";
            exit;
        }
        else
        {
//            echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
//            echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
//            echo "文件大小: " . ($_FILES["file"]["size"] / 1024 /1024) . " MB<br>";
//            echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
            $file_name = iconv("UTF-8","gb2312", $_FILES["file"]["name"]);
            // 判断当期目录下的 upload 目录是否存在该文件
            // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
            if (file_exists("hw/" . $file_name))
            {
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"" . $_FILES["file"]["name"] . "文件已经存在。\");\r\n";
                echo "location.href='tea_hw.php';";
                echo "</script>";
                exit;
//            echo $_FILES["file"]["name"] . " 文件已经存在。 ";
            }
            else
            {
                // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                $file_name_utf8 = $_FILES["file"]["name"];
                $file_name = iconv("UTF-8","gb2312", $_FILES["file"]["name"]);
                move_uploaded_file($_FILES["file"]["tmp_name"], "hw/" . $file_name);
                $cid = "0100";
                $file_path = "hw/" . $file_name;
                $file_path_utf8 = "hw/" . $file_name_utf8;
                $t=time();
                $time=date("Y-m-d H:i:s",$t);
                $ddl = date("Y-m-d H:i:s",strtotime($_POST["ddl"]));
                $state = "s";
                $type = "sp";
                if(isset($_SESSION["uname"]))$uploader = $_SESSION["uname"];
                else $uploader = "";
                $arr=array(
                    'title'=>$_POST["title"],
                    'desc'=>$_POST["desc"],
                    'time'=>$time,
                    'state'=>$state,
                    'file_path'=>$file_path_utf8,
                    'uploader'=>$uploader,
                );
                $info = urlencode(json_encode($arr,JSON_UNESCAPED_UNICODE));
                $con = mysqli_connect("localhost","root","mamz","seweb");
                if (!$con){
                    die('Could not connect: ' . mysqli_error());
                }
                mysqli_query($con , "set names utf8");
                $query="insert into offline_work (cid, info,ddl) VALUES(\"$cid\",'".$info."',\"$ddl\")";
//                echo $query;
                $re = mysqli_query($con,$query);
                if($re) {
                    echo "<script language=\"JavaScript\">\r\n";
                    echo " alert(\" 作业布置成功！\");\r\n";
                    echo "</script>";
                    echo "<script language=\"JavaScript\">\r\n";
                    echo " alert(\"
                    附件名称: " . $_FILES["file"]["name"] . "<br>
                    附件类型: " . $_FILES["file"]["type"] . "<br>
                    附件大小: " . ($_FILES["file"]["size"] / 1024 /1024) . " MB<br>\");\r\n";
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
        echo "location.href='tea_hw.php';";
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
                        <h3>作业发布</h3>
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
                            <div class="row" id="hwtype1">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>在线作业发布</h2>
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
                                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">作业名称：
                                                    </label>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <input type="text" id="title" name="onlinename" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">章节：
                                                    </label>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <select class="form-control" name="onlinechap">
                                                            <option value="chap1">第一章</option>
                                                            <option value="chap2">第二章</option>
                                                            <option value="chap3">第三章</option>
                                                            <option value="chap4">第四章</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ddl">截止时间：
                                                    </label>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <input type="text" id="ddl" name="onlineddl" placeholder="yyyy-mm-dd" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="ln_solid"></div>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                        <button class="btn btn-primary" type="reset">清除</button>
                                                        <button type="submit" class="btn btn-success" name="button1">发布</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="loadhw">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>上传在线作业题库</h2>
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
                                            <form id="demo-form3" data-parsley-validate class="form-horizontal form-label-left" method="post">
                                                <div class="col-xs-3">
                                                    <!-- required for floating -->
                                                    <!-- Nav tabs -->
                                                    <ul class="nav nav-tabs tabs-left">
                                                        <li class="active"><a href="#selectquestion" data-toggle="tab">选择题</a>
                                                        </li>
                                                        <li><a href="#textquestion" data-toggle="tab">填空题</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="col-xs-9">
                                                    <!-- Tab panes -->
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="selectquestion">
                                                            <div class="form-group" >
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">章节：
                                                                </label>
                                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                                    <select class="form-control" name="selectchap">
                                                                        <option value="chap1">第一章</option>
                                                                        <option value="chap2">第二章</option>
                                                                        <option value="chap3">第三章</option>
                                                                        <option value="chap4">第四章</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option">题目：
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <textarea id="selectcontent" name='selectcontent' placeholder="" style="width: 100%;min-height: 150px"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option">选项 A：
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <textarea id="optiona" name="optiona" style="width: 100%;min-height: 100px"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option">选项 B：
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <textarea id="optionb" name="optionb"  style="width: 100%;min-height: 100px"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option">选项 C：
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <textarea id="optionc" name="optionc"  style="width: 100%;min-height: 100px"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option">选项 D：
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <textarea id="optiond" name="optiond"  style="width: 100%;min-height: 100px"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">正确答案：
                                                                </label>
                                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                                    <select class="form-control" name="selectans">
                                                                        <option value="A">A</option>
                                                                        <option value="B">B</option>
                                                                        <option value="C">C</option>
                                                                        <option value="D">D</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="ln_solid"></div>
                                                            <div class="form-group">
                                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                    <button class="btn btn-primary" type="reset">清除</button>
                                                                    <button type="submit" class="btn btn-success" name="button3">提交</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="textquestion">
                                                            <div class="form-group" >
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">章节：
                                                                </label>
                                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                                    <select class="form-control" name="textchap">
                                                                        <option value="chap1">第一章</option>
                                                                        <option value="chap2">第二章</option>
                                                                        <option value="chap3">第三章</option>
                                                                        <option value="chap4">第四章</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option">题目：
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <textarea id="textcontent" name='textcontent' placeholder="" style="width: 100%;min-height: 150px"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option">正确答案：
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <textarea id="textans" name='textans' placeholder="" style="width: 100%;min-height: 150px"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="ln_solid"></div>
                                                            <div class="form-group">
                                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                    <button class="btn btn-primary" type="reset">清除</button>
                                                                    <button type="submit" class="btn btn-success" name="button4">提交</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="offline-tab">
                            <div class="row" id="hwtype2">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>离线作业发布</h2>
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
                                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="tea_hw.php" method="post"  enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">作业题目：
                                                    </label>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <input type="text" name="title" id="title" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">作业描述：
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <textarea name="desc" id="desc" placeholder="请输入描述..." style="width: 100%;min-height: 200px"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ddl">截止时间：
                                                    </label>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <input type="datetime-local" name="ddl" id="ddl" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hwFile">添加附件：
                                                    </label>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <input type="file" name="file" id="hwFile" class="dropzone">
                                                    </div>
                                                </div>

                                                <div class="ln_solid"></div>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                        <button class="btn btn-primary" type="reset">清除</button>
                                                        <button type="submit" class="btn btn-success">提交</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
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
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['button1'])){
        if(empty($_POST['onlinename']) || empty($_POST['onlinechap']) || empty($_POST['onlineddl']) ) {
            echo "<script>alert('您未输入完整数据!');</script>";
            exit;
        }
        $sql = "select * from onlinehw;";
        $result = $conn->query($sql);
        $count = $result -> num_rows + 1;
        $hwno = 'hw'.$count;
//        $cid=$_SESSION["cid"];
        $insert = "insert into onlinehw values ('".$hwno."','".$cid."','".$_POST['onlinename']."','".$_POST['onlinechap']."','".$_POST['onlineddl']."')";
        if ($conn->query($insert) === TRUE) {
            echo "<script>alert('作业发布成功');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    if (isset($_POST['button3'])){
        if(empty($_POST['selectcontent']) || empty($_POST['optiona']) || empty($_POST['optionb']) || empty($_POST['optionc']) || empty($_POST['optiond'])) {
            echo "<script>alert('您未输入完整数据!');</script>";
            exit;
        }
        $sql = "select * from selectquestion;";
        $result = $conn->query($sql);
        $count = $result -> num_rows + 1;
        $qno = 'qno'.$count;
//        $cid=$_SESSION["cid"];
        $insert = "insert into selectquestion values ('".$qno."','".$cid."','".$_POST['selectchap']."','".$_POST['selectcontent']."','".$_POST['optiona'].
            "','".$_POST['optionb']."','".$_POST['optionc']."','".$_POST['optiond']."','".$_POST['selectans']."')";
        if ($conn->query($insert) === TRUE) {
            echo "<script>alert('上传选择题成功');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    if (isset($_POST['button4'])){
        if(empty($_POST['textcontent']) || empty($_POST['textans'])) {
            echo "<script>alert('您未输入完整数据!');</script>";
            exit;
        }
        $sql = "select * from textquestion;";
        $result = $conn->query($sql);
        $count = $result -> num_rows + 1;
        $qno = 'qno'.$count;
//        $cid=$_SESSION["cid"];
        $insert = "insert into textquestion values ('".$qno."','".$cid."','".$_POST['textchap']."','".$_POST['textcontent']."','".$_POST['textans']."')";
        if ($conn->query($insert) === TRUE) {
            echo "<script>alert('上传填空题成功');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>
</html>