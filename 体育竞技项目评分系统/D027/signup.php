<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>D027打分系统-主界面</title>
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
<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/6/19
 * Time: 13:42
 */

session_start();
header("Content-Type: text/html;charset=utf-8");
?>
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

        <footer class="side-footer">欢迎使用D027客户端，祝您生活愉快</footer>
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
                                if(!isset($_COOKIE['user'])) echo '游客';
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
                        <h2 class="title">个人报名</h2>
                        <p class="title-description">
                            填入项目编码以确认项目名称。
                            填入相应的必填信息。
                        </p>
                    </header>
                    <hr>
                </section>


<!--                    <div class="form-group-col-2">-->
<!--                        <div class="form-label">项目编码</div>-->
<!--                        <div class="form-cont">-->
<!--                            <form action="signup.php" method="post">-->
<!--                            <input name="itemid" type="text" placeholder="--><?php //echo $itemid;?><!--" class="form-control form-boxed" style="width:300px;">-->
<!--                                <span class>*</span>-->
<!--                            <input type="submit" class="btn btn-primary" value="验证" />-->
<!--                            </form>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
                <form action="signupdeal1.php" method="get">
                    <div class="form-group-col-2">
                        <div class="form-label">项目名称</div>
                        <div class="form-cont">
<!--                            <a name="itemname" type="text"  class="form-control form-boxed" style="width:300px;">--><?php //echo $itemname;?><!--</a>-->
                            <select name="itemname" style="width:auto;">
                                <option>集体-太极八法五步</option>
                                <option>集体-二十四式太极拳</option>
                                <option>个人-太极八法五步</option>
                                <option>个人-二十四式太极拳</option>
                                <option>个人-其他太极拳</option>
                                <option>个人-其他太极器械</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group-col-2">
                        <div class="form-label">姓名</div>
                        <div class="form-cont">
                            <input name="conname" type="text" placeholder="" class="form-control form-boxed" style="width:300px;">
                            <span class>*</span>
                        </div>
                    </div>
                    <div class="form-group-col-2">
                        <div class="form-label">学号</div>
                        <div class="form-cont">
                            <input name="conid" type="text" placeholder="" class="form-control form-boxed" style="width:300px;">
                            <span class>*</span>
                        </div>
                    </div>
<!--                    <div class="form-group-col-2">-->
<!--                        <div class="form-label">学院</div>-->
<!--                        <div class="form-cont">-->
<!--                            <input name="conunit" type="text" placeholder="" class="form-control form-boxed" style="width:300px;">-->
<!--                            <span class>*请填写正确的学院全称</span>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="form-group-col-2">
                        <div class="form-label">学院</div>
                        <div class="form-cont">
                            <select name="conunit" style="width:auto;">
                                <option>紫云碧峰学园</option>
                                <option>蓝田学园</option>
                                <option>丹青学园</option>
                                <option>竺可桢学院</option>
                                <option>人文学院</option>
                                <option>外国语言文化与国际交流学院</option>
                                <option>传媒与国际文化学院</option>
                                <option>经济学院</option>
                                <option>光华法学院</option>
                                <option>教育学院</option>
                                <option>管理学院</option>
                                <option>公共管理学院</option>
                                <option>马克思主义学院</option>
                                <option>数学科学学院</option>
                                <option>物理学系</option>
                                <option>化学学系</option>
                                <option>地球科学学院</option>
                                <option>心理与行为科学系</option>
                                <option>机械工程学院</option>
                                <option>材料科学与工程学院</option>
                                <option>能源工程学院</option>
                                <option>电气工程学院</option>
                                <option>建筑工程学院</option>
                                <option>化学工程与生物工程学院</option>
                                <option>海洋学院</option>
                                <option>航空航天学院</option>
                                <option>高分子科学与工程学系</option>
                                <option>光电科学与工程学院</option>
                                <option>信息与电子工程学院</option>
                                <option>控制科学与工程学院</option>
                                <option>计算机科学与技术学院</option>
                                <option>生物医学工程与仪器科学学院</option>
                                <option>生命科学学院</option>
                                <option>生物系统工程与食品科学学院</option>
                                <option>环境与资源学院</option>
                                <option>农业与生物技术学院</option>
                                <option>动物科学学院</option>
                                <option>医学院</option>
                                <option>药学院</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group-col-2">
                        <div class="form-label">性别</div>
                        <div class="form-cont">
                            <label class="radio">
                                <input type="radio" name="consex" value="2"/>
                                <span>男士</span>
                            </label>
                            <label class="radio">
                                <input type="radio" name="consex" value="1" checked="checked"/>
                                <span>女士</span>
                            </label>

                        </div>

                    </div>


                    <div class="form-group-col-2">
                        <div class="form-label"></div>
                        <div class="form-cont">
                            <input type="submit" class="btn btn-primary" value="提交报名" />
                            <input type="reset" class="btn btn-disabled" value="重置" />
                        </div>
                    </div>
                </form>
                    <div class="form-group-col-2">
                        <div class="form-label">报名信息查看</div>
                        <div class="form-cont">
                            <form action="signup.php" method="post">
                                <input name="con_id" type="text" placeholder="请输入学号" class="form-control form-boxed" style="width:300px;">
                                <input name="type" type="hidden" value="2">
                                <input type="submit" class="btn btn-primary" value="搜索" />
                                <table class="table table-bordered  mb-15">
                                    <thead>
                                    <tr>
                                        <th>序号</th>
                                        <th>组别</th>
                                        <th>项目编码</th>
                                        <th>项目名称</th>
                                        <th>参赛选手</th>
                                        <th>学号</th>
                                        <th>学院</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    function test_input($sql_str) {
                                        $check = preg_match("/select | or | and | not | no | insert | update | delete | '| union | into | load_file | outfile /", $sql_str);
                                        if ($check) {
                                            echo "<script>
layer.confirm('我正在看着你、看着你，目不转睛！请慎独！！', {
                title:'系统提示',
                btn: ['确定','取消']
            }, function(){
                location.href = 'signup.php';
            });
</script>";
                                        }else return $sql_str;
                                    }
                                    $sql_grade = "";
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $a = test_input($_POST['con_id']);
                                        $sql_grade = "SELECT * FROM program NATURAL JOIN item where con_id = $a ORDER BY group_id,program_id";
                                    }
                                    $con_grade = new mysqli("localhost", "root", "mamz", "d027");
                                    $con_grade->query("set names 'UTF8'");
                                    if ($con_grade->connect_error)
                                    {
                                        die('连接失败: ' . $con_grade->connect_error);
                                    }else {
                                        if($sql_grade != ""){
                                            $re_grade = $con_grade->query($sql_grade);
                                            if(isset($re_grade->num_rows) && $re_grade->num_rows > 0){
                                                while($row_grade = $re_grade->fetch_assoc()){
                                                    echo "<tr class=\"cen\">";
                                                    echo "<td>".$row_grade["program_id"]."</td>";
                                                    echo "<td>".$row_grade["group_id"]."</td>";
                                                    echo "<td>".$row_grade["item_id"]."</td>";
                                                    echo "<td>".$row_grade["item_name"]."</td>";
                                                    echo "<td>".$row_grade["con_name"]."</td>";
                                                    echo "<td>".$row_grade["con_id"]."</td>";
                                                    echo "<td>".$row_grade["con_unit"]."</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                    }
                                    $con_grade->close();

                                    ?>

                                    </tbody>
                                </table>
                            </form>
                        </div>

                    </div>
            </div>
        </main>

    </div>
</div>
</body>
</html>

