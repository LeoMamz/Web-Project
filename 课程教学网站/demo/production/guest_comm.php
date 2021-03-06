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

    <title>软件工程教学网站</title>

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
                <img src="images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>欢迎,</span>
                <?php
					header("Content-type: text/html; charset=utf8");
					//这里需要session传递用户名
					$uname=$_SESSION['uname'];
					//$uname="阿云嘎";
					echo "<h2>".$uname." 游客</h2>";
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
                    <img src="images/user.png" alt=""><?php echo $uname;?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="guest_help.php">帮助</a></li>
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
											  <a href='guest_shortNotice.php#notice'>
												<span class='image'><img src='images/img.jpg' alt='Profile Image' /></span>";
									echo "<span><span>".$row['author']."</span>
											<span class='time'>".$row['create_time']."</span></span>
												<span class='message'>".$row['title']."</span></a></li>";
								}
								else{
									echo "<li>
											  <a href='guest_longNotice.php#notice'>
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
                <h3>交流心得</h3>
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
			
			<?php
					$conn=mysqli_connect("localhost","root","mamz","seweb");
					if(!$conn){
						die("连接错误：".mysqli_connect_error());
					}
					mysqli_query($conn,"set names utf8");
					$sel_sql="select author,title,create_time,content from notice where state='0' order by create_time desc";
					$res=mysqli_query($conn,$sel_sql);
					if(mysqli_num_rows($res)>0){
						while($row=mysqli_fetch_assoc($res)){
							echo "<div class='row'>
									<div class='col-md-12 col-sm-12 col-xs-12'>
										<div class='x_panel'>
											<div class='x_title'>";
							echo "<h2>".$row['title']."</h2>";
							echo "<ul class='nav navbar-right panel_toolbox'>
									  <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
									  </li>
									  <li class='dropdown'>
										<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'><i class='fa fa-wrench'></i></a>
										<ul class='dropdown-menu' role='menu'>
										  <li><a href='#'>Settings 1</a>
										  </li>
										  <li><a href='#'>Settings 2</a>
										  </li>
										</ul>
									  </li>
									  <li><a class='close-link'><i class='fa fa-close'></i></a>
									  </li>
									</ul>
									<div class='clearfix'></div>
								  </div>";
							echo "<div class='x_content'>发布者：".$row['author']." 时间：".$row['create_time'].
							"<br /><br />
							<div class='col-md-12 col-sm-12 col-xs-12' style='background: #eef7f8;padding:20px'>"
							.$row['content']."</div></div>
							</div>
						  </div>
						</div>";
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