<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/6/19
 * Time: 13:42
 */
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_COOKIE["user"])){
    header("Location:login.html");
    exit();
}
//include "index.html";

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>交易管理系统-主界面</title>
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
                            <a href="http://localhost/admin-pro/lite/table-basic.html">股票查询</a>
                        </dd>
                        <dd>
                            <a href="result.php">交易结果</a>
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
                        <a onclick="quitUI() "><i class="icon-signout"></i>安全退出</a>
                    </li>
                </ul>
            </div>
        </header>
        <main class="main-cont content mCustomScrollbar">
            <!--开始::内容-->
            <div class="page-wrap">
                <section class="page-hd">
                    <header>
                        <h2 class="title"><i class="icon-home"></i>交易客户端</h2>
                    </header>
                    <hr>
                </section>
                <div class="panel panel-default">
                    <div class="panel-bd capitalize">
                        点击侧边栏，开始使用股票交易系统。
                    </div>
                </div>
                <!--开始::结束-->
            </div>
        </main>

    </div>
</div>
</body>
</html>

