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
    <meta http-equiv="refresh" content="30">
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
    header("Location:login.html");
    exit();
}
$random_condition = "输入任意条件";
if(!isset($_SESSION["con_unit"])) $_SESSION["con_unit"] = "所有学院";
if(!isset($_SESSION["item_name"])) $_SESSION["item_name"] = "所有项目";
if(!isset($_SESSION["sql_checkin"])) $_SESSION["sql_checkin"] = "SELECT * FROM program NATURAL JOIN item ORDER BY item_id, group_id,program_id";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["program_id"])) {
    $c = $_GET["program_id"];
    $con = new mysqli("localhost", "root", "mamz", "d027");
    $con->query("set names 'UTF8'");
    if ($con->connect_error) {
        die('连接失败: ' . $con->connect_error);
    } else {
//        $sql0 = "select check_status2 from program where progarm_id = $c";
//        $re0 = $con->query($sql0);
//        $d = 0;
//        if(isset($re0->num_rows) && $re0->num_rows > 0) {
//            while ($row0 = $re0->fetch_assoc()) {
//                $d = $row0["check_status2"];
//            }
//        }
        if($c >= 0) $sql1 = "update program set check_status2 = 1 where program_id = $c";
        else if($c < 0) {
            $c = -$c;
            $sql1 = "update program set check_status2 = 0 where program_id = $c";
        }
        $re = $con->query($sql1);
        if(!$re){
            echo "<script>
layer.confirm('检录失败！', {
                title:'系统提示',
                btn: ['确定','取消']
            }, function(){
                location.href = 'checkin.php';
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
                        <h2 class="title">赛中检录</h2>
                        <p class="title-description">
                            此界面用于比赛开始后的检录。
                        </p>
                    </header>
                    <hr>
                </section>
                <div>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $type = $_POST["type1"];
                        if($type == 1){
                            $a1 =  $_POST['itemname'];
                            $a2 = $_POST["conunit"];
                            if($a1 == "所有项目"){
                                $a1 = "!= ''";
                                $_SESSION["item_name"] = "所有项目";
                            }else {
                                $_SESSION["item_name"] = $a1;
                                $a1 = "= '$a1'";
                            }
                            if($a2 == "所有学院"){
                                $a2 = "!= ''";
                                $_SESSION["con_unit"] = "所有学院";
                            }else {
                                $_SESSION["con_unit"] = $a2;
                                $a2 = "= '$a2'";
                            }
                            $_SESSION["sql_checkin"] = "SELECT * FROM program NATURAL JOIN item where item_name $a1 and con_unit $a2 ORDER BY item_id,group_id,program_id";
                        }else if($type == 2){
                            $a1 =  $_POST['condition'];
                            $random_condition = $a1;
                            $_SESSION["sql_checkin"] = "SELECT * FROM program NATURAL JOIN item where group_id = '$a1' or item_id = '$a1' or item_name = '$a1' or program_id = '$a1' or con_id = '$a1' or con_name = '$a1' or con_sex = '$a1' or con_unit = '$a1'  ORDER BY item_id, group_id,program_id";
                        }
                    }
                    ?>

                    <form action="checkin.php" method="post" class="fl">
                        <div class="fl">
                            <div class="form-cont">
                                <select name="itemname" style="width:auto;" >
                                    <option <?php if($_SESSION["con_unit"] == "所有项目") echo"selected";?>>所有项目</option>
                                    <?php
                                    $con = new mysqli("localhost", "root", "mamz", "d027");
                                    $con->query("set names 'UTF8'");
                                    if ($con->connect_error)
                                    {
                                        die('连接失败: ' . $con->connect_error);
                                    }else {
                                        $sql1 = "SELECT item_name FROM item WHERE item_id >= \"01\" AND item_id <= \"10\" ORDER BY item_id";
                                        $re = $con->query($sql1);
                                        if ($re->num_rows > 0) {
                                            //有查到相关记录
                                            while ($row = $re->fetch_assoc()) {
                                                $row["item_name"];
                                                if($_SESSION["item_name"] == $row['item_name']) echo "<option selected>".$row['item_name']."</option>";
                                                else echo "<option>".$row['item_name']."</option>";
                                            }
                                        }
                                    }

                                    ?>
                                </select>

                            </div>
                        </div>
                        <div class="fl">
                            <div class="form-cont">
                                <select name="conunit" style="width:auto;">
                                    <option <?php if($_SESSION["con_unit"] == "所有学院") echo"selected";?>>所有学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "紫云碧峰学园") echo"selected";?>>紫云碧峰学园</option>
                                    <option <?php if($_SESSION["con_unit"] == "蓝田学园") echo"selected";?>>蓝田学园</option>
                                    <option <?php if($_SESSION["con_unit"] == "丹青学园") echo"selected";?>>丹青学园</option>
                                    <option <?php if($_SESSION["con_unit"] == "竺可桢学院") echo"selected";?>>竺可桢学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "人文学院") echo"selected";?>>人文学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "外国语言文化与国际交流学院") echo"selected";?>>外国语言文化与国际交流学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "传媒与国际文化学院") echo"selected";?>>传媒与国际文化学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "经济学院") echo"selected";?>>经济学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "光华法学院") echo"selected";?>>光华法学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "教育学院") echo"selected";?>>教育学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "管理学院") echo"selected";?>>管理学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "公共管理学院") echo"selected";?>>公共管理学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "马克思主义学院") echo"selected";?>>马克思主义学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "数学科学学院") echo"selected";?>>数学科学学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "物理学系") echo"selected";?>>物理学系</option>
                                    <option <?php if($_SESSION["con_unit"] == "化学学系") echo"selected";?>>化学学系</option>
                                    <option <?php if($_SESSION["con_unit"] == "地球科学学院") echo"selected";?>>地球科学学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "心理与行为科学系") echo"selected";?>>心理与行为科学系</option>
                                    <option <?php if($_SESSION["con_unit"] == "机械工程学院") echo"selected";?>>机械工程学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "材料科学与工程学院") echo"selected";?>>材料科学与工程学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "能源工程学院") echo"selected";?>>能源工程学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "电气工程学院") echo"selected";?>>电气工程学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "建筑工程学院") echo"selected";?>>建筑工程学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "化学工程与生物工程学院") echo"selected";?>>化学工程与生物工程学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "海洋学院") echo"selected";?>>海洋学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "航空航天学院") echo"selected";?>>航空航天学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "高分子科学与工程学系") echo"selected";?>>高分子科学与工程学系</option>
                                    <option <?php if($_SESSION["con_unit"] == "光电科学与工程学院") echo"selected";?>>光电科学与工程学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "信息与电子工程学院") echo"selected";?>>信息与电子工程学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "控制科学与工程学院") echo"selected";?>>控制科学与工程学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "计算机科学与技术学院") echo"selected";?>>计算机科学与技术学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "生物医学工程与仪器科学学院") echo"selected";?>>生物医学工程与仪器科学学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "生命科学学院") echo"selected";?>>生命科学学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "生物系统工程与食品科学学院") echo"selected";?>>生物系统工程与食品科学学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "环境与资源学院") echo"selected";?>>环境与资源学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "农业与生物技术学院") echo"selected";?>>农业与生物技术学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "动物科学学院") echo"selected";?>>动物科学学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "医学院") echo"selected";?>>医学院</option>
                                    <option <?php if($_SESSION["con_unit"] == "药学院") echo"selected";?>>药学院</option>
                                </select>

                            </div>
                        </div>
                        <input name="type1" type='hidden' value=1>
                        <input type="submit" class="btn btn-danger radius" value="确定" />
                    </form>

                    <form action="checkin.php" method="post" class="fr input-group">
                        <div class="fr input-group">
                            <input type="text" name="condition" class="form-control" placeholder="<?php echo $random_condition;?>" style="width:290px;"/>
                            <input name="type1" type='hidden' value=2>
                            <input type="submit" class="btn btn-primary radius" value="搜索" />
                        </div>
                    </form>
                </div>
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
                        <th>检录状态</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql_grade = $_SESSION["sql_checkin"] ;
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
                                    $a = $row_grade["program_id"];
                                    $b = $row_grade["check_status2"];
                                    echo "<tr class=\"cen\">";
                                    echo "<td>".$row_grade["program_id"]."</td>";
                                    echo "<td>".$row_grade["group_id"]."</td>";
                                    echo "<td>".$row_grade["item_id"]."</td>";
                                    echo "<td>".$row_grade["item_name"]."</td>";
                                    echo "<td>".$row_grade["con_name"]."</td>";
                                    echo "<td>".$row_grade["con_id"]."</td>";
                                    echo "<td>".$row_grade["con_unit"]."</td>";
                                    if($b == 1){
                                        echo "<td>";
                                        echo "<form action=\"checkindeal.php\" method=\"post\">";
                                        $a = -$a;
                                        echo "<input name=\"check_type\" type='hidden' value=2 />";
                                        echo "<input name=\"program_id\" type='hidden' value=\"$a\" />";
                                        echo "<input type='submit' class=\"btn btn-secondary-outline\" value=\"已检录\" />";
                                        echo "</form>";
                                        echo "</td>";
                                    }else if ($b == 0){
                                        echo "<td>";
                                        echo "<form action=\"checkindeal.php\" method=\"get\">";
                                        echo "<input name=\"check_type\" type='hidden' value=2 />";
                                        echo "<input name=\"program_id\" type='hidden' value=\"$a\" />";
                                        echo "<input type='submit' class=\"btn btn-primary radius\" value=\"检录\" />";
                                        echo "</form>";
                                        echo "</td>";
                                    }
                                    echo "</tr>";
                                }
                            }
                        }
                    }
                    $con_grade->close();

                    ?>

                    </tbody>
                </table>

            </div>
        </main>

    </div>
</div>
</body>
</html>

