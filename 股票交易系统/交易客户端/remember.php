<?php session_start(); //session_unset();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>交易客户端-查看提醒</title>
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
</head>
<body>
<div class="main-wrap">
	<div class="side-nav">
		<div class="side-logo">
			<div class="logo">
				<span class="logo-ico">
					<i class="i-l-1"></i>
					<i class="i-l-2"></i>
					<i class="i-l-3"></i>
				</span>
				<strong>股票交易客户端</strong>
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
							<i class="icon-columns"></i>信息查询<i class="icon-angle-right"></i>
						</dt>
						<dd>
							<a href="capital-account.html">资金账户信息</a>
						</dd>
						<dd>
							<a href="securities-account.html">证券账户信息</a>
						</dd>
					</dl>
				</li>
				<li>
					<dl>
						<dt>
							<i class="icon-columns"></i>股票信息<i class="icon-angle-right"></i>
						</dt>
						<dd>
							<a href="searchstock.html">股票查询</a>
						</dd>
						<dd>
							<a href="result.html">交易结果</a>
						</dd>
					</dl>
				</li>
				<li>
					<dl>
						<dt>
							<i class="icon-star"></i>股票交易<i class="icon-angle-right"></i>
						</dt>
						<dd>
							<a href="buystock.php">购买股票</a>
						</dd>
						<dd>
							<a href="sellstock.php">出售股票</a>
						</dd>
					</dl>
				</li>
				<li>
					<dl>
						<dt>
							<i class="icon-fighter-jet"></i>价格提醒<i class="icon-angle-right"></i>
						</dt>
						<dd>
							<a href="remember.php">查看提醒</a>
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
	<div class="content-wrap">
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
						<a href="updatepw.php"><i class="icon-random"></i>修改密码</a>
					</li>
					<li>
						<a onclick="quitUI()"><i class="icon-signout"></i>安全退出</a>
					</li>
				</ul>
			</div>
		</header>
		<main class="main-cont content mCustomScrollbar">
			<div class="page-wrap">
<!--开始::内容-->
				<section class="page-hd">
					<header>
						<h2 class="title">价格提醒</h2>
						<p class="title-description">
							在这里您可以设置并查看您的提醒。
                            查看提醒中红色标识的为达到要求的提醒。
						</p>
					</header>
					<hr>
				</section>

				<div class="panel panel-default">
					<!--<div class="panel-hd">按钮</div>-->
					<div class="panel-bd">
						<div class="card">
							<div class="card-header">
								<ul class="tab-nav">
									<li class="active">我的提醒</li>
									<li>添加提醒</li>
								</ul>
							</div>
                            <div class="tab-cont" style="display: block;">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>股票代码</th>
                                        <th>股票涨至/元</th>
                                        <th>股票跌至/元</th>
                                        <th>日涨幅至/%</th>
                                        <th>日跌幅至/%</th>
                                        <th>提醒方式</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php
                                    include "checkREM.php";
                                    if(!isset($_SESSION['size'])) $daxiao = 0;
                                    else $daxiao = $_SESSION['size'];
                                    //var_dump($_SESSION);
                                   // echo $daxiao;
                                    for($j = $daxiao; $j > 0; $j--){
                                        $size = '';
                                        $size .= chr(ord('a') + $j-1);
                                        if(isset($_SESSION[$size]) && $_SESSION[$size][5] == 0){
                                            $a1 = $_SESSION[$size][0];$a2 = $_SESSION[$size][1];$a3 = $_SESSION[$size][2];$a4 = $_SESSION[$size][3];$a5 = $_SESSION[$size][4];
                                            echo "<form action='updANDdel.php' method='post'>";
                                            echo "<tr class=\'cen\' align='center'>";
                                            echo "<td>" .$a1."</td>";
                                            if(isset($_SESSION[$size][6]) && $_SESSION[$size][6] == 1) echo "<td style='background:#ff2f4c'>" .$a2."</td>";
                                            else echo "<td>" .$a2."</td>";
                                            if(isset($_SESSION[$size][7]) && $_SESSION[$size][7] == 1) echo "<td style='background:#ff2f4c'>" .$a3."</td>";
                                            else echo "<td>" .$a3."</td>";
                                            if(isset($_SESSION[$size][8]) && $_SESSION[$size][8] == 1) echo "<td style='background:#ff2f4c'>" .$a4."</td>";
                                            else echo "<td>" .$a4."</td>";
                                            if(isset($_SESSION[$size][9]) && $_SESSION[$size][9] == 1) echo "<td style='background:#ff2f4c'>" .$a5."</td>";
                                            else echo "<td>" .$a5."</td>";
                                            echo "<td>程序</td>";
                                            echo '<td>';
                                            echo'<button name= "update" type = "submit" title=\"详情\" value=' .$size.'>修改</button> ';
                                            echo '<button name= "delete" type = "submit" title=\"删除\" value=' .$size.'>删除</button>';
                                            echo '</td> </tr> </form>';
                                        }

                                        //onclick=""window.location.href="""
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
							<div class="tab-cont">
<form action="rememberdeal.php" method="post">
<div class="form-group-col-2">
					<div class="form-label">股票代码</div>
	                <div class="form-cont">
		               <input name="ID" type="text" placeholder="" class="form-control form-boxed" style="width:300px;">
					 </div>

				</div>	
                                                                <div class="form-group-col-2">
					<div class="form-label">股价涨至</div>
					<div class="form-cont">
						<input name="priceup" type="number" placeholder="" class="form-control form-boxed" style="width:300px;">
						<span class>元</span>
					</div>
				</div>
				<div class="form-group-col-2">
					<div class="form-label">股价跌至</div>
					<div class="form-cont">
						<input name="pricedown" type="number" placeholder="" class="form-control form-boxed" style="width:300px;">
						<span class>元</span>
					</div>
				</div>
				                                                                <div class="form-group-col-2">
					<div class="form-label">日涨幅至</div>
					<div class="form-cont">
						<input name="dayup" type="number" placeholder="" class="form-control form-boxed" style="width:300px;">
						<span class>%</span>
					</div>
				</div>
                                                                <div class="form-group-col-2">
					<div class="form-label">日跌幅至</div>
					<div class="form-cont">
						<input name="daydown" type="number" placeholder="" class="form-control form-boxed" style="width:300px;">
						<span class>%</span>
					</div>
				</div>


				<div class="form-group-col-2">
					<div class="form-label">提醒方式：</div>
					<div class="form-cont">
						<label class="check-box">
							<input type="checkbox" checked="checked" name="mmm"/>
							<span>程序提醒</span>
						</label>
						<label class="check-box">
							<input type="checkbox" name="mmm"/>
							<span>短信提醒</span>
						</label>
		
					</div>
				</div>
				
				
				<div class="form-group-col-2">
					<div class="form-label"></div>
					<div class="form-cont">
						<input type="submit" class="btn btn-primary" value="生成提醒" />
						<input type="reset" class="btn btn-disabled" value="重置" />
					</div>
				</div>
</form>
							</div>

							
						</div>
					</div>
				</div>
				<!--开始::结束-->
			</div>
		</main>
		<footer class="btm-ft">
			<p class="clear">
				<span class="fl">2018-6-10 <a href="#" title="DeathGhost" target="_blank">19:20</a></span>
				<span class="fr text-info">
<em class="uppercase">
						<i class="icon-user"></i>
						您有一条新的提醒，请打开系统消息查看
					</em>
				</span>
			</p>
		</footer>
	</div>
</div>
</body>
</html>

