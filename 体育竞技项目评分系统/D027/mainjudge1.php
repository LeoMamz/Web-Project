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
if(!isset($_COOKIE["user"]) || $_COOKIE["userid"] != "000"){
    session_unset();
    header("Location:index.php");
    exit();
}
$random_condition = "输入任意条件";
if(!isset($_SESSION["status"])) $_SESSION["status"] = "present";
if(!isset($_SESSION["present"]) || !isset($_SESSION["present_order"])) {
    $_SESSION["present"] = 2;
    $con = new mysqli("localhost", "root", "mamz", "d027");
    $con->query("set names 'UTF8'");
    if ($con->connect_error)
    {
        die('连接失败: ' . $con->connect_error);
    }else{
        $sql = "select mark_num from mark where id = 1";
        $re = $con->query($sql);
        if($re->num_rows > 0) {
            while ($row = $re->fetch_assoc()) {
                $_SESSION["present"] = $row["mark_num"] + 1;
                $_SESSION["present_order"] = $row["mark_num"];
            }
        }
    }
}
if(!isset($_SESSION["con_unit"])) $_SESSION["con_unit"] = "所有学院";
if(!isset($_SESSION["item_name"])) $_SESSION["item_name"] = "所有项目";
if(!isset($_SESSION["sql_main_judge"])) $_SESSION["sql_main_judge"] = "SELECT * FROM program NATURAL JOIN item ORDER BY item_id, group_id,program_id";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["post_type"]) && $_POST["post_type"] == "页内切换"){
        if(isset($_POST["status"])) {
            $status = $_POST["status"];
            if($status == "出场管理")$_SESSION["status"] = "present";
            else if($status == "分数审核")$_SESSION["status"] = "check";
        }
    }else{
        $b = $_POST["review_type"];
        $c = $_POST["program_id"];
        $con = new mysqli("localhost", "root", "mamz", "d027");
        $con->query("set names 'UTF8'");
        if ($con->connect_error)
        {
            die('连接失败: ' . $con->connect_error);
        }else{
            if($b == 2){//直接修改了总分
                $final = $_POST["final_grade"];
                $sql1 = "update program set final_grade = $final, present = 1 where program_id = $c";
                $re = $con->query($sql1);
                if(!$re){
                    echo "<script>
layer.confirm('审核分数提交失败！', {
                title:'系统提示',
                btn: ['确定','取消']
            }, function(){
                location.href = 'mainjudge1.php';
            });
</script>";
                }
            }else if($b == 1){ //修改裁判的评分
                $sql1 = "select grade1, grade2, grade3, grade4, grade5 from program where program_id = $c";
                $re = $con->query($sql1);
                if($re->num_rows > 0) {
                    while ($row = $re->fetch_assoc()) {
                        $new_grade = array($row["grade1"] , $row["grade2"],$row["grade3"] ,$row["grade4"] ,$row["grade5"]);
                    }
                }
                if($_POST["grade1"] != "" && $_POST["grade1"] <= 10 && $_POST["grade1"] >= 0) $new_grade[0] = $_POST["grade1"];
                if($_POST["grade2"] != "" && $_POST["grade2"] <= 10 && $_POST["grade2"] >= 0) $new_grade[1] = $_POST["grade2"];
                if($_POST["grade3"] != "" && $_POST["grade3"] <= 10 && $_POST["grade3"] >= 0) $new_grade[2] = $_POST["grade3"];
                if($_POST["grade4"] != "" && $_POST["grade4"] <= 10 && $_POST["grade4"] >= 0) $new_grade[3] = $_POST["grade4"];
                if($_POST["grade5"] != "" && $_POST["grade5"] <= 10 && $_POST["grade5"] >= 0) $new_grade[4] = $_POST["grade5"];
                sort($new_grade);
                $final_grade = ($new_grade[1] + $new_grade[2] + $new_grade[3]) / 3.0;
                $sql2 = "update program set final_grade = $final_grade, grade1 = $new_grade[0], grade2 = $new_grade[1], grade3 = $new_grade[2], grade4 = $new_grade[3], grade5 = $new_grade[4], present = 1 where program_id = $c";
                $re1 = $con->query($sql2);
                if(!$re1){
                    echo "<script>
layer.confirm('审核分数提交失败！', {
                title:'系统提示',
                btn: ['确定','取消']
            }, function(){
                location.href = 'mainjudge1.php';
            });
</script>";
                }
            }
        }
        $con->close();
    }
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
                <div class="panel panel-default">
                    <!--<div class="panel-hd">按钮</div>-->
                    <div class="panel-bd">
                        <div class="card">
                            <div class="card-header">
                                <ul class="tab-nav">
                                    <form action="mainjudge1.php" method="post">
                                        <input name="post_type" type="hidden" value="页内切换" />
                                        <li <?php if($_SESSION["status"]=="check") echo "class=\"active\"";?>><input name="status" type="submit" class="btn btn-danger-outline" value="分数审核" /></li>
                                        <li <?php if($_SESSION["status"]=="present") echo "class=\"active\"";?>><input name="status" type="submit" class="btn btn-danger-outline" value="出场管理" /></li>
                                    </form>
                                </ul>
                            </div>
                            <div class="tab-cont"  <?php if($_SESSION["status"]=="check") echo "style=\"display: block;\"";?>>
                <table class="table table-bordered  mb-15">
                    <thead>
                    <tr>
<!--                        <th>序号</th>-->
                        <th>项目名称</th>
                        <th>参赛选手</th>
                        <th>学号</th>
                        <th>学院</th>
                        <th>审核各裁判评分</th>
                        <th>审核总分</th>
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
//                                    echo "<td>".$row_grade["program_id"]."</td>";
                                    echo "<td>".$row_grade["item_name"]."</td>";
                                    echo "<td>".$row_grade["con_name"]."</td>";
                                    echo "<td>".$row_grade["con_id"]."</td>";
                                    echo "<td>".$row_grade["con_unit"]."</td>";
                                    $grade = array($row_grade["grade1"] , $row_grade["grade2"],$row_grade["grade3"] ,$row_grade["grade4"] ,$row_grade["grade5"]);
                                    echo "<td>";
                                    echo "<form action=\"mainjudge1.php\" method=\"post\">";
                                    echo "<input name=\"program_id\" type='hidden' value=$a>";
                                    echo "<input name=\"grade1\" type=\"text\" placeholder=$grade[0] class=\"form-control form-boxed\" style=\"width:100px;\">";
                                    echo "<input name=\"grade2\" type=\"text\" placeholder=$grade[1] class=\"form-control form-boxed\" style=\"width:100px;\">";
                                    echo "<input name=\"grade3\" type=\"text\" placeholder=$grade[2] class=\"form-control form-boxed\" style=\"width:100px;\">";
                                    echo "<input name=\"grade4\" type=\"text\" placeholder=$grade[3] class=\"form-control form-boxed\" style=\"width:100px;\">";
                                    echo "<input name=\"grade5\" type=\"text\" placeholder=$grade[4] class=\"form-control form-boxed\" style=\"width:100px;\">";
                                    echo "<input name=\"review_type\" type='hidden' value=1>";
                                    echo "<input type=\"submit\" class=\"btn btn-info radius\" value=\"通过\" />";
                                    echo "</form>";
                                    echo "</td>";
                                    sort($grade);
                                    $final_grade = ($grade[1] + $grade[2] + $grade[3]) / 3.0;
                                    echo "<td>";
                                    echo "<form action=\"mainjudge1.php\" method=\"post\">";
                                    echo "<input name=\"final_grade\" type=\"text\" placeholder=$final_grade class=\"form-control form-boxed\" style=\"width:100px;\">";
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
                            <div class="tab-cont" <?php if($_SESSION["status"]=="present") echo "style=\"display: block;\"";?>>
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["type1"])) {
                                    $type = $_GET["type1"];
                                    if($type == 1){
                                        $a1 =  $_GET['itemname'];
                                        $a2 = $_GET["conunit"];
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
                                            //$random_condition = $a1;
                                        }
                                        $_SESSION["sql_main_judge"] = "SELECT * FROM program NATURAL JOIN item where item_name $a1 and con_unit $a2 ORDER BY item_id,group_id,program_id";
                                    }else if($type == 2){
                                        $a1 =  $_GET['condition'];
                                        $_SESSION["sql_main_judge"] = "SELECT * FROM program NATURAL JOIN item where group_id = '$a1' or item_id = '$a1' or item_name = '$a1' or program_id = '$a1' or con_id = '$a1' or con_name = '$a1' or con_sex = '$a1' or con_unit = '$a1'  ORDER BY item_id, group_id,program_id";
                                    }
                                }
                                ?>
                                <div>
                                    <form action="mainjudge1.php" method="get" class="fl">
                                        <div class="fl">
                                            <div class="form-cont">
                                                <select name="itemname" style="width:auto;" >
                                                    <option>所有项目</option>
                                                    <?php
                                                    $con = new mysqli("localhost", "root", "mamz", "d027");
                                                    $con->query("set names 'UTF8'");
                                                    if ($con->connect_error)
                                                    {
                                                        die('连接失败: ' . $con->connect_error);
                                                    }else {
                                                        $sql1 = "select item_name from item  WHERE item_id >= \"01\" AND item_id <= \"05\" order by item_id";
                                                        $re = $con->query($sql1);
                                                        if ($re->num_rows > 0) {
                                                            //有查到相关记录
                                                            while ($row = $re->fetch_assoc()) {
                                                                $row["item_name"];
                                                                if($_SESSION["item_name"] == $row['item_name']) echo "<option selected>".$row['item_name']."</option>";
                                                                else echo "<option>".$row['item_name']."</option>";
                                                            }
                                                        }//else echo "<option>\"meizhaodao dfdsf\"</option>";
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

                                    <form action="mainjudge1.php" method="get" class="fr input-group">
                                        <div class="fr input-group">
                                            <input type="text" name="condition" class="form-control" placeholder="<?php echo $random_condition;?>" style="width:290px;"/>
                                            <input name="type1" type='hidden' value=2>
                                            <input type="submit" class="btn btn-primary radius" value="搜索" />
                                        </div>
                                    </form>
                                </div>

                                <table class="table table-bordered  mb-15">
                                    <form action="mainjudgedeal.php" method="post">
                                    <thead>
                                    <tr>
                                        <th><input type='submit' class="btn btn-primary radius" value="上场" /></th>
                                        <th>检录状态</th>
                                        <th>组别</th>
                                        <th>序号</th>
                                        <th>项目名称</th>
                                        <th>参赛选手</th>
                                        <th>学号/队伍编号</th>
                                        <th>学院</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql_grade = $_SESSION["sql_main_judge"];
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
                                                    $present = $row_grade["present"];
                                                    $a = $row_grade["program_id"];
                                                    $b = $row_grade["check_status2"];
                                                    $c = $_SESSION["present"];
                                                    echo "<tr class=\"cen\">";
                                                    if($present == 0) echo "<td><input type=\"checkbox\" value=1 name=$a></td>";
                                                    else if($present <= -1)echo "<td><a class=\"btn btn-secondary-outline\" />已评分</a></td>";
                                                    else if($present > 1)echo "<td><a class=\"btn btn-primary radius\" />在场上</a></td>";
                                                    else if($present == 1)echo "<td><a class=\"btn btn-primary radius\" />已出分</a></td>";
                                                    if($b == 1){
                                                        echo "<td>";
                                                        echo "<a class=\"btn btn-secondary-outline\" />已检录</a>";
                                                        echo "</td>";
                                                    }else if ($b == 0){
                                                        echo "<td>";
                                                        echo "<a class=\"btn btn-primary radius\"/>未检录</a>";
                                                        echo "</td>";
                                                    }
                                                    echo "<td>".$row_grade["group_id"]."</td>";
                                                    echo "<td>".$row_grade["program_id"]."</td>";
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
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
</div>
</body>
</html>

