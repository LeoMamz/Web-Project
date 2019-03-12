<!DOCTYPE html>
<?php
	Session_Start();
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
                <?php
					header("Content-type: text/html; charset=utf8");
					$uname=$_SESSION['uname'];
					echo "<h2>".$uname." 学生</h2>";
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
                    <img src="images/black_glasses.jpg" alt=""><?php echo $uname;?>
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
                <h3>友情链接</h3>
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
                    <h2>相关链接</h2>
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
						$filename="link.txt";
						$handle=fopen($filename,"r");
						$link=array();
						$i=0;
						//输出文本中所有的行，直到文件结束为止。
						while(!feof($handle)){
							$link[$i]= fgets($handle);//fgets()函数从文件指针中读取一行
							$i++;
						}
						fclose($handle);
						echo "<div class='x_content'>";
						for($j=0; $j<$i; $j=$j+2){
							$k=$j+1;
							echo "<p><a href='$link[$k]'><i class='fa fa-external-link'></i><strong> ".$link[$j]."</strong></a></p>";
						}
						echo "</div>";
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