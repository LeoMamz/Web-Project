<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>交易客户端-密码修改</title>
<meta name="keywords"  content="设置关键词..." />
<meta name="description" content="设置描述..." />
<meta name="author" content="DeathGhost" />
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<link rel="icon" href="images/icon/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="javascript/jquery.js"></script>
<script src="javascript/plug-ins/customScrollbar.min.js"></script>
<script src="javascript/plug-ins/echarts.min.js"></script>
<script src="javascript/plug-ins/layerUi/layer.js"></script>
<script src="editor/ueditor.config.js"></script>
<script src="editor/ueditor.all.js"></script>
<script src="javascript/plug-ins/pagination.js"></script>
<script src="javascript/public.js"></script>
	<script src="javascript/pages/login.js"></script>
</head>
<body>
	<div class="side-nav">
		<div class="side-logo">
			<div class="logo">
				<span class="logo-ico">
					<i class="i-l-1"></i>
					<i class="i-l-2"></i>
					<i class="i-l-3"></i>
				</span>
                <strong>D027客户端</strong>
            </div>
        </div>

        <nav class="side-menu content mCustomScrollbar" data-mcs-theme="minimal-dark">
            <h2>
                <a href="index.php" class="InitialPage"><i class="icon-dashboard"></i>首页</a>
            </h2>
            <ul>
                <li>
                    <dl>
                        <dt>
                            <i class="icon-columns"></i>报名系统<i class="icon-angle-right"></i>
                        </dt>
                        <dd>
                            <a href="signup.php">个人报名</a>
                        </dd>
                        <dd>
                            <a href="signupstatistics.php">报名统计</a>
                        </dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>
                            <i class="icon-columns"></i>检录系统<i class="icon-angle-right"></i>
                        </dt>
                        <dd>
                            <a href="checkbefore.php">集体项目检录</a>
                        </dd>
                        <dd>
                            <a href="checkin.php">赛中检录</a>
                        </dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>
                            <i class="icon-star"></i>裁判评分<i class="icon-angle-right"></i>
                        </dt>
                        <dd>
                            <a href="grade1.php">演练评分</a>
                        </dd>
                        <dd>
                            <a href="grade2.php">难度评分</a>
                        </dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>
                            <i class="icon-fighter-jet"></i>裁判长检查系统<i class="icon-angle-right"></i>
                        </dt>
                        <dd>
                            <a href="mainjudge1.php">裁判长审核</a>
                        </dd>
                    </dl>
                </li>
            </ul>
        </nav>
		
		<footer class="side-footer">欢迎使用交易客户端，祝您生活愉快</footer>
		
	</div>
	<script>
        function quitUI()
        {
            layer.confirm('确定登出管理中心？', {
                title:'系统提示',
                btn: ['确定','取消']
            }, function(){
                location.href = 'quitdeal.php';
            });
        }
    </script>
	<form class="content-wrap" method="post" action="http://localhost/stock/updatepwddeal.php" >
		<header class="top-hd">
			<div class="hd-lt">
				<a class="icon-reorder"></a>
			</div>
			<div class="hd-rt">
				<ul>
					<li>
						<a><i class="icon-user"></i>用户:<em><?php
                                if(!isset($_COOKIE['user'])) echo '';
                                else echo $_COOKIE['user'];
                                ?></em></a>
					</li>
				
					<li>
						<a><i class="icon-random"></i>修改密码</a>
					</li>
					<li>
						<a onclick="quitUI() "><i class="icon-signout"></i>安全退出</a>
					</li>
				</ul>
			</div>
		</header>
		<main class="main-cont content mCustomScrollbar">
			<div class="page-wrap">
				<!--开始::内容-->
				<section class="page-hd">
					<header>
						<h2 class="title">密码修改</h2>

					</header>
					<hr>
				</section>

					<tr>
							原&#12288;密&#12288;码：<input type="password" name="oldPwd" id="PwdOld" /><br><br>
							新&#12288;密&#12288;码：<input type="password" name="newPwd1" id="PwdNew1" />*密码应为6~18位<br><br>
							确认新密码：<input type="password" name="newPwd2" id="PwdNew2" /><br><br>
					</tr>


				<div class="form-group-col-2">
					<div class="form-label"></div>
					<div class="form-cont">
						<input type="submit" id="updatePwd1" class="btn btn-primary" value="确认修改" />

					</div>
				</div>
				<!--开始::结束-->
			</div>
		</main>
	</form>
<div class="mask"></div>
<div class="dialog">
	<div class="dialog-hd">
		<strong class="lt-title">标题</strong>
		<a class="rt-operate icon-remove JclosePanel" title="关闭"></a>
	</div>
	<div class="dialog-bd">
		<!--start::-->
		<p>这里是基础弹窗,可以定义文本信息，HTML信息这里是基础弹窗,可以定义文本信息，HTML信息。</p>
		<!--end::-->
	</div>
	<div class="dialog-ft">
		<button class="btn btn-info JyesBtn">确认</button>
		<button class="btn btn-secondary JnoBtn">关闭</button>
	</div>
</div>
</body>
</html>
