<!DOCTYPE html>
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

    <link href="css/tiezi.css" rel="stylesheet">
</head>
<?php
    session_start();
    header("Content-Type: text/html;charset=utf-8");
    if(!isset($_SESSION['user'])||$_SESSION['user']!="s"){
        echo "<script>alert(\"您还未登录！\");window.location=\"login.php\";</script>";
    }
    $cid="0100";
    $cname="软件工程杂烩";
    $postid = $_GET["postid"];
    $uid=$_SESSION['uid'];
    $uname=$_SESSION['uname'];

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
                                $conn=mysqli_connect("localhost","root","mamz","seweb");
                                if(!$conn){
                                    die("连接错误：".mysqli_connect_error());
                                }
                                mysqli_query($conn,"set names utf8");
                                $note_sql="select author,title,create_time,state from notice 
							where state='1' or state='2' order by create_time desc limit 5";
                                $note_res=mysqli_query($conn,$note_sql);
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
                        <h3>小组论坛</h3>
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

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>帖子交流区</h2>
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
                            <?php
                                // connect to MySql Port:3306 Name:root Password: database:seweb

                                $con = mysqli_connect("localhost","root","mamz","seweb");
                                // handle connect error
                                if (!$con){
                                    die('Could not connect: ' . mysqli_error());
                                }
                                mysqli_query($con , "set names utf8");
                                $query_author = "SELECT * FROM forum WHERE post_id = '" . $postid . "'";
                                $result = mysqli_query($con, $query_author);
                                $row = mysqli_fetch_assoc($result);
                                $author = $row["author"];
                                $posttitle = $row["post_title"];
                                $query_post = "SELECT * FROM post WHERE post_id = '" . $postid ."' AND state = 't' ORDER BY reply_index ASC";

                                $result = mysqli_query($con, $query_post);
                                if(mysqli_num_rows($result) > 0){
                                    $row = mysqli_fetch_assoc($result);
                                    echo "<div class=\"x_content\" id=\"floor1\">";
                                    echo "<div class=\"col-md-2 col-sm-2 col-xs-12 profile_left\">";
                                    echo "<div class=\"profile_img\">";
                                    echo "<div id=\"crop-avatar\"><img class=\"img-responsive avatar-view\" src=\"images/user.png\" alt=\"Avatar\"></div>";
                                    echo "</div>";
                                    $query_name = "SELECT * FROM myuser WHERE uid = '" . $row["reply_author"] . "'";
                                    $result_name = mysqli_query($con, $query_name);
                                    $row_name = mysqli_fetch_assoc($result_name);
                                    echo "<h4>" . $row_name["uname"] . "</h4><span class=\"label label-warning\"><i class=\"fa fa-user\"></i> 楼主</span>";
                                    echo "</div>";
                                    echo "<div class=\"col-md-10 col-sm-10 col-xs-12\">";
                                    echo "<div class=\"profile_title\"><div class=\"col-md-12\"><h2>" . $posttitle . "</h2></div></div>";
                                    echo "<div class=\"firstfloor\"><p>" . $row["reply"] . "</p></div>";
                                    echo "</div>";
                                    echo "<div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"text-align: right;\">" . $row["reply_index"] . "楼 ". $row["reply_time"] . "</div>";
                                    echo "<div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"height:10px;\"></div><div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"height:5px;background: #CCCCCC\"></div>";
                                    echo "</div>";
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "<div class=\"x_content\" id=\"floor2\">";
                                        echo "<div class=\"col-md-2 col-sm-2 col-xs-12 profile_left\">";
                                        echo "<div class=\"profile_img\"><div id=\"crop-avatar\"><img class=\"img-responsive avatar-view\" src=\"images/user.png\" alt=\"Avatar\"></div></div>";
                                        $query_name = "SELECT * FROM myuser WHERE uid = '" . $row["reply_author"] . "'";
                                        $result_name = mysqli_query($con, $query_name);
                                        $row_name = mysqli_fetch_assoc($result_name);
                                        echo "<h4>" . $row_name["uname"] . "</h4><span class=\"label label-primary\"><i class=\"fa fa-user\"></i> " . $row["reply_index"] . "楼</span>";
                                        echo "</div>";
                                        echo "<div class=\"col-md-10 col-sm-10 col-xs-12\"><div class=\"floor\"><p>" . $row["reply"] . "</p></div></div>";
                                        echo "<div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"text-align: right;\">" . $row["reply_index"] . "楼" . $row["reply_time"] . "</div>";
                                        echo "<div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"height:10px;\"></div><div class=\"col-md-12 col-sm-12 col-xs-12\" style=\"height:5px;background: #CCCCCC\"></div>";
                                        echo "</div>";
                                    }
                                }
                                if(isset($_POST["release_note"])){
                                    if(empty($_POST["contents"])){

                                    }else{

                                        $query_max_mid = "SELECT * FROM post WHERE post_id = '" . $postid . "' ORDER BY reply_index DESC";
                                        $result_max_mid = mysqli_query($con, $query_max_mid);
                                        if(mysqli_num_rows($result_max_mid) > 0){
                                            $row = mysqli_fetch_assoc($result_max_mid);
                                            $max_mid = $row["reply_index"] + 1;
                                        }else{
                                            $max_mid = 1;
                                        }
                                        $query_update_tiezi = "UPDATE forum SET recent_reply_time = '" .date("Y-m-d H:i:s") . "', reply_num = " . $max_mid . " WHERE post_id = '" . $postid . "'";
                                        $query_create_reply = "INSERT INTO post (post_id, reply, reply_author, reply_time, reply_index, state) VALUES ('" . $postid . "', '" . $_POST["contents"] . "', '" . $uid . "', '" .date("Y-m-d H:i:s") . "', " . $max_mid . ", 't')";
                                        $_POST["contents"] = "";
                                        //echo "<script>alert(\"" . $query_create_reply . "\")</script>";
                                        //echo "<script>alert(\"" . $query_update_tiezi . "\")</script>";
                                        mysqli_query($con, $query_update_tiezi);
                                        mysqli_query($con, $query_create_reply);
                                        echo "<script>location.href='stu_forum_tiezi.php?postid=" . $postid . "'</script>";
                                }

                            }

                            ?>

                            <div class="x_title" id="reply_post">
                                <h2>我要回复</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content" id="">
                                <?php
                                echo "<form class=\"form-horizontal form-label-left input_mask\" id=\"forum_post\" method=\"post\" action=\"stu_forum_tiezi.php?postid=" . $postid . "\">";
                                ?>
                                    <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                                        <div class="btn-group">
                                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                            </ul>
                                        </div>

                                        <div class="btn-group">
                                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a data-edit="fontSize 5">
                                                        <p style="font-size:17px">Huge</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-edit="fontSize 3">
                                                        <p style="font-size:14px">Normal</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-edit="fontSize 1">
                                                        <p style="font-size:11px">Small</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="btn-group">
                                            <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                                            <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                                            <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                                            <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                                        </div>

                                        <div class="btn-group">
                                            <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                                            <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                                            <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                                            <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                                        </div>

                                        <div class="btn-group">
                                            <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                                            <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                                            <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                                            <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                                        </div>

                                        <div class="btn-group">
                                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                                            <div class="dropdown-menu input-append">
                                                <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                                                <button class="btn" type="button">Add</button>
                                            </div>
                                            <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                                        </div>

                                        <div class="btn-group">
                                            <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                                        </div>

                                        <div class="btn-group">
                                            <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                                            <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                                        </div>
                                    </div>

                                    <textarea name="contents" id="editor-one" rows="10" cols="80" style="width:1175px; height:100px" class="editor-wrapper"></textarea>
                                    <br />
                                    <div>
                                        <button type="submit" class="btn btn-primary" name="release_note">发布</button>
                                    </div>
                                </form>
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

<script type="text/javascript">
    function reply_in_floor(divID){
        var rep=document.getElementById(divID);
        if(rep.style.display=="none"){
            rep.style.display="block";
        }
        else {
            rep.style.display="none";
        }
    }
</script>

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