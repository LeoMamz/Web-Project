<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>股票交易系统-信息发布平台</title>
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/colors/default-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header card-no-border fix-sidebar">
   <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo text -->
                        <span>
                            <h2>&nbsp;&nbsp;信息发布平台</h2>
                        </span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item hidden-xs-down search-box"> <a class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                            <li class="nav-item">
                            <a class="nav-link waves-effect waves-dark" href="#"><img src="../assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="index.html" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">高级显示</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="pages-profile.php" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">用户设置</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="table-basic.html" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">搜索</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="pages-blank.html" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">用户升级</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="pages-error-404.html" aria-expanded="false"><i class="mdi mdi-help-circle"></i><span class="hide-menu">404</span></a></li>
                    </ul>
                    <div class="text-center m-t-30">
                    <a href="logout.php" class="btn waves-effect waves-light btn-info hidden-md-down">登出</a>
                    </div>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Search</h3>
                    </div>
                </div>
<div class="row">
<div class="col-lg-10">
    <div class="card">
        <div class="container"><br>
            <div class="row">
                <div class="col-md-6">
                    <form class="input-group" action="searchpage.php" method="post" name="textinput">
                        <input type="text" placeholder="请输入代码或名称" class="form-control form-control-line">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </span>
                    </form>
                </div>
            </div>
        </div><br>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>股票名称</th>
                <th>股票代码</th>
                <th>股票价格</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>


<?php

$TXI= (string)($_POST["textinput"]);
$conn = new mysqli("localhost","root","123456");//数据库帐号密码为安装数据库时设置
if(mysqli_errno($conn)){
    echo mysqli_errno($conn);
    exit;
}
mysqli_select_db($conn,"stock");           //选择数据库
mysqli_set_charset($conn,'utf8');

if ($TXI){
    $sql = "create or replace view new3 as select stock_name,stock_id,stock_price from message where stock_id LIKE '%$TXI%' or stock_name LIKE '%$TXI%'";
    $res = mysqli_query($conn, $sql);
}else{}

$sql = "select * from new3 order by stock_name";
$res = mysqli_query($conn, $sql);
$rows = mysqli_affected_rows($conn);//获取行数
echo "<script>alert('为您查询到 $rows 行结果。')</script>";
$linenum = 1;
while ($row = mysqli_fetch_row($res)) {
echo <<<EOF

<tr class="c-table__row">
<td class="c-table__cell">$linenum</td>
<td class="c-table__cell">$row[0]</td>
<td class="c-table__cell">$row[1]</td>
<td class="c-table__cell">$row[2]</td>
<td class="c-table__cell"><a href="subscribe.php?\$SID=$row[1]" class="btn btn-info">订阅</a></td>
</tr>

EOF;
$linenum = $linenum +1 ;
}

?>		
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                © 2018 软工基
            </footer>
        </div>
    </div>
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <script src="js/waves.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/custom.min.js"></script>
</body>

</html>