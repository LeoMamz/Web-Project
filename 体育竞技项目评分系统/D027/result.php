<?php
if (!session_id()) session_start();
//检测是否登录，若没登录则转向登录界面
/*if(!isset($_COOKIE["user"])){
echo "<script language=\"JavaScript\">\r\n";
echo " alert(\"用户未登陆\");\r\n";
echo " location.replace(\"login.html\");\r\n"; // 自己修改网址
echo "</script>";
exit;}

include "index.html";
*/
function post_data($url, $data_string)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($data_string))
    );

    $return_content = curl_exec($ch);

    curl_close($ch);

    return $return_content;

}

$url ="http://localhost/mytest/center_transaction_2.php";
$type_sell=4;
$sell_request=json_encode(array('user_id'=>$_COOKIE['user'],'type'=>$type_sell));

//DEBUG TODO
//$sell_request=json_encode(array('user_id'=>123,'type'=>$type_sell));
//DEBUG
$dataFromCT = post_data($url,$sell_request);
$sell=json_decode($dataFromCT, true);
$type_buy=5;
$buy_request=json_encode(array('user_id'=>$_COOKIE['user'],'type'=>$type_buy));

//DEBUG TODO
//$buy_request=json_encode(array('user_id'=>123,'type'=>$type_buy));
//DEBUG

$buy=json_decode(post_data($url,$buy_request) , true);
$type_result=6;
$result_request=json_encode(array('user_id'=>$_COOKIE['user'],'type'=>$type_result));
//TODO:
//$result_request=json_encode(array('user_id'=>123,'type'=>$type_result));
//END DBG
$result_data_Ct =  post_data($url,$result_request);
$result=json_decode($result_data_Ct, true);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>交易客户端-交易结果</title>
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
    <div class="page-wrap">
        <!--开始::内容-->
        <section class="page-hd">
            <header>
                <h2 class="title">交易结果</h2>
                <p class="title-description">
                    在这里查看您的历史交易。
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
                            <li class="active">出售中</li>
                            <li>购买中</li>
                            <li>交易完成</li>
                        </ul>
                    </div>
                    <div class="tab-cont" style="display: block;">
                        <?php
                            echo'<table class="table table-bordered table-striped table-hover">
                                <thead><tr>
                                <th>出售时间</th><th>股票名称</th><th>出售单价</th><th>出售数量</th><th>出售总额</th><th>操作</th>
                                </tr></thead><tbody>';
                            $count=0;
                            $count_sell=count($sell);
                            for(;$count<$count_sell;$count++){
                                $sell_sum=$sell[$count][1]*$sell[$count][2];
                                    echo '<form action="undo.php" method="post">';
                                    echo'<tr class="cen">';
                                    echo'<td>'.$sell[$count][3].'</td>';
                                    echo'<td>'.$sell[$count][0].'</td>';
                                    echo'<td>'.$sell[$count][1].'</td>';
                                    echo'<td>'.$sell[$count][2].'</td>';
                                    echo'<td>'.$sell_sum.'</td>';
                                $size = '';
                                $size .= chr(ord('Z') - $count-1);
                                $_SESSION[$size][0] = $sell[$count][0];
                                $_SESSION[$size][1] = $sell[$count][1];
                                $_SESSION[$size][2] = $sell[$count][2];
                                $_SESSION[$size][3] = $sell[$count][3];

                                    echo'<td><button name="sell" title="撤回" class="mr-5" type="submit" value='.$count.'>撤回</button></td></tr>';
                                    echo '</form>';
                                }
                                echo'</tbody></table>';
                         ?>
							</div>
							<div class="tab-cont">
                                <?php
                                echo'<table class="table table-bordered table-striped table-hover">
                                <thead><tr>
                                <th>购买时间</th><th>股票名称</th><th>购买单价</th><th>购买数量</th><th>购买总额</th><th>操作</th>
                                </tr></thead><tbody>';
                                $count=0;
                                $count_buy=count($buy);
                                for(;$count<$count_buy;$count++){
                                    $buy_sum=$buy[$count][1]*$buy[$count][2];
                                    echo '<form action="undo.php" method="post">';
                                    echo'<tr class="cen">';
                                    echo'<td>'.$buy[$count][3].'</td>';
                                    echo'<td>'.$buy[$count][0].'</td>';
                                    echo'<td>'.$buy[$count][1].'</td>';
                                    echo'<td>'.$buy[$count][2].'</td>';
                                    echo'<td>'.$buy_sum.'</td>';
                                    if (!session_id()) session_start();
                                    $size = '';
                                    $size .= chr(ord('Z') - $count-1);
                                    $_SESSION[$size][0] = $buy[$count][0];
                                    $_SESSION[$size][1] = $buy[$count][1];
                                    $_SESSION[$size][2] = $buy[$count][2];
                                    $_SESSION[$size][3] = $buy[$count][3];
                                    echo'<td><button name="buy" title="撤回" class="mr-5" type="submit" value='.$count.'>撤回</button></td></tr>';
                                    echo '</form>';
                                }
                                echo'</tbody></table>';
                                ?>
                            </div>
							<div class="tab-cont">
                                <?php
                                echo'<table class="table table-bordered table-striped table-hover">
                                <thead><tr>
                                <th>成交时间</th><th>交易类型</th><th>股票名称</th><th>成交单价</th><th>成交数量</th><th>成交总额</th>
                                </tr></thead><tbody>';
                                $count=0;
                                $count_result=count($result);
                                for(;$count<$count_result;$count++){
                                    $result_sum=$result[$count][1]*$result[$count][2];
                                    if(0==$result[$count][4]){
                                        $result_type='购买';
                                    }
                                    else $result_type='出售';
                                    echo'<tr class="cen">';
                                    echo'<td>'.$result[$count][3].'</td>';
                                    echo'<td>'.$result_type.'</td>';
                                    echo'<td>'.$result[$count][0].'</td>';
                                    echo'<td>'.$result[$count][1].'</td>';
                                    echo'<td>'.$result[$count][2].'</td>';
                                    echo'<td>'.$result_sum.'</td>';
                                }
                                echo'</tbody></table>';
                                ?>
                            </div>
						</div>
					</div>
				</div>
				<!--开始::结束-->
			</div>
		</main>
	
	</div>
</div>
</body>
</html>