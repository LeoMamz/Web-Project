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
//检测是否登录，若没登录则转向登录界面
if(!isset($_COOKIE["user"])){
    session_unset();
    header("Location:login.html");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $b = $_POST["review_type"];
    $c = $_POST["program_id"];
    $final = $_POST["final_grade"];
    $con = new mysqli("localhost", "root", "mamz", "d027");
    $con->query("set names 'UTF8'");
    if ($con->connect_error)
    {
        die('连接失败: ' . $con->connect_error);
    }else{
        $sql1 = "update program set final_grade = $final where program_id = $c";
        $re = $con->query($sql1);
        if(!$re){
            echo "<script>
layer.confirm('审核分数提交失败！', {
                title:'系统提示',
                btn: ['确定','取消']
            }, function(){
                location.href = 'grade1.php';
            });
</script>";
        }
    }
    $con->close();
}

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
                        <h2 class="title">裁判长审核</h2>
                        <p class="title-description">
                            裁判长对选手获取的分数进行审核，并进行相应的调整。
                        </p>
                    </header>
                    <hr>
                </section>

                <table class="table table-bordered  mb-15">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>组别</th>
                        <th>项目名称</th>
                        <th>参赛选手</th>
                        <th>学号</th>
                        <th>学院</th>
                        <th>得分</th>
                        <th>审核</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $_SESSION["start"] = 1;//方便裁判长控制评分起始
                    if($_SESSION["start"] == 1){
                        $con_grade = new mysqli("localhost", "root", "mamz", "d027");
                        $con_grade->query("set names 'UTF8'");

                        if ($con_grade->connect_error)
                        {
                            die('连接失败: ' . $con_grade->connect_error);

                        }else {
                            $sql_grade = "SELECT * FROM program NATURAL JOIN item WHERE if_grade = 5 and final_grade = 0 ORDER BY group_id ,program_id";
                            $re_grade = $con_grade->query($sql_grade);
                            if($re_grade->num_rows > 0){
                                while($row_grade = $re_grade->fetch_assoc()){
                                    $a = $row_grade["program_id"];
                                    echo "<tr class=\"cen\">";
                                    echo "<td>".$row_grade["program_id"]."</td>";
                                    echo "<td>".$row_grade["group_id"]."</td>";
                                    echo "<td>".$row_grade["item_name"]."</td>";
                                    echo "<td>".$row_grade["con_name"]."</td>";
                                    echo "<td>".$row_grade["con_id"]."</td>";
                                    echo "<td>".$row_grade["con_unit"]."</td>";
                                    $grade = array($row_grade["grade1"] , $row_grade["grade1"],$row_grade["grade1"] ,$row_grade["grade1"] ,$row_grade["grade1"]);
                                    sort($grade);
                                    $final_grade = ($grade[1] + $grade[2] + $grade[3]) / 3.0;
                                    echo "<td>".$final_grade."</td>";
                                    echo "<td>";
                                    echo "<form action=\"mainjudge1.php\" method=\"post\">";
                                    echo "<input name=\"program_id\" type='hidden' value=$a>";
                                    echo "<input name=\"final_grade\" type='hidden' value=$final_grade>";
                                    echo "<input name=\"review_type\" type='hidden' value=1>";
                                    echo "<input type=\"submit\" class=\"btn btn-info radius\" value=\"通过\" />";
                                    echo "</form>";
                                    echo "<t>   或   </t>";
                                    echo "<form action=\"mainjudge1.php\" method=\"post\">";
                                    echo "<input name=\"final_grade\" type=\"text\" placeholder=\"调整分数\" class=\"form-control form-boxed\" style=\"width:100px;\">";
                                    echo "<input name=\"program_id\" type='hidden' value=$a>";
                                    echo "<input name=\"review_type\" type='hidden' value=2>";
                                    echo "<input type=\"submit\" class=\"btn btn-danger radius\" value=\"修改\" />";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                    }

                    ?>

                    </tbody>
                </table>

            </div>
        </main>

    </div>
</div>
</body>
</html>

