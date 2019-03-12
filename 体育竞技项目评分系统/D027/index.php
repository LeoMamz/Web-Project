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
if(!isset($_SESSION["condition"])) $_SESSION["condition"] = "present_order desc";
if(!isset($sql_grade)) $sql_grade = "SELECT * FROM program NATURAL JOIN item where present = 1 ORDER BY present_order desc, group_id,program_id, con_unit";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $condition = $_POST["condition"];
    if($condition == "序号"){
        if($_SESSION["condition"] == "program_id desc") $_SESSION["condition"] = "program_id";
        else $_SESSION["condition"] = "program_id desc";
    }
    else if($condition == "出场顺序"){
        if($_SESSION["condition"] == "present_order desc") $_SESSION["condition"] = "present_order";
        else $_SESSION["condition"] = "present_order desc";
    }
    else if($condition == "最后得分"){
        if($_SESSION["condition"] == "final_grade desc") $_SESSION["condition"] = "final_grade";
        else $_SESSION["condition"] = "final_grade desc";
    }
    else if($condition == "项目名称"){
        if($_SESSION["condition"] == "item_name desc") $_SESSION["condition"] = "item_name";
        else  $_SESSION["condition"] = "item_name desc";
    }
    else if($condition == "参赛选手"){
        if($_SESSION["condition"] == "con_name desc") $_SESSION["condition"] = "con_name";
        else $_SESSION["condition"] = "con_name desc";
    }
    else if($condition == "学号"){
        if($_SESSION["condition"] == "con_id desc") $_SESSION["condition"] = "con_id";
        else  $_SESSION["condition"] = "con_id desc";
    }
    else if($condition == "学院"){
        if($_SESSION["condition"] == "con_unit desc") $_SESSION["condition"] = "con_unit";
        else  $_SESSION["condition"] = "con_unit desc";
    }else if($condition == "组内排名"){
        if($_SESSION["condition"] == "rank desc") $_SESSION["condition"] = "rank";
        else  $_SESSION["condition"] = "rank desc";
    }
    $condition = $_SESSION["condition"];
    $sql_grade = "SELECT * FROM program NATURAL JOIN item where present = 1 ORDER BY $condition, group_id, item_id, con_sex,program_id, con_unit";
}

?>
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
    <meta http-equiv="refresh" content="10">
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
            <!--开始::内容-->
            <div class="page-wrap">
                <section class="page-hd">
                    <header>
                        <h2 class="title"><i class="icon-home"></i>D027客户端</h2>
                    </header>
                    <hr>
                </section>
                <div class="panel panel-default">
                    <div class="panel-bd capitalize">
                        点击侧边栏，开始使用D027打分系统。
                        <form action="output_deal.php" method="get" class="fr input-group">
                            <div class="fr input-group">
                                <input name="post_type" type='hidden' value=2>
                                <input type="submit" class="btn btn-danger radius" value="导出" />
                            </div>
                        </form>
                    </div>
                    <div>
                        <table class="table table-bordered  mb-15">
                            <thead>
                            <tr>
                                <form action="index.php" method="post" class="fr input-group">
                                    <th><input name="condition" type="submit" class="btn btn-primary radius size-xl" value="出场顺序" /></th>
                                    <th><input name="condition" type="submit" class="btn btn-primary radius size-xl" value="序号" /></th>
                                    <th><input name="condition" type="submit" class="btn btn-primary radius size-xl" value="项目名称" /></th>
                                    <th><input name="condition" type="submit" class="btn btn-primary radius size-xl" value="参赛选手" /></th>
                                    <th><input name="condition" type="submit" class="btn btn-primary radius size-xl" value="学号/队伍编号" /></th>
                                    <th><input name="condition" type="submit" class="btn btn-primary radius size-xl" value="学院" /></th>
                                    <th><input name="condition" type="submit" class="btn btn-primary radius size-xl" value="最后得分" /></th>
                                    <th><input name="condition" type="submit" class="btn btn-primary radius size-xl" value="组内排名" /></th>
                                </form>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $con_grade = new mysqli("localhost", "root", "mamz", "d027");
                            $con_grade->query("set names 'UTF8'");
                            if ($con_grade->connect_error)
                            {
                                die('连接失败: ' . $con_grade->connect_error);
                            }else {
                                mysqli_autocommit($con_grade, FALSE);
                                try{
                                    $re = $con_grade->query("select final_grade, item_id, con_id, con_sex from program where final_grade != 0 and present = 1");
//                                    $re = $con_grade->query("select item_id from program where final_grade != 0 and present = 1");
                                    if(!$re){
                                        throw new Exception("ERROR_1: 分数信息获取失败！");
                                    }else{
//                                        if($re->num_rows > 0) {
//                                            while ($row = $re->fetch_assoc()) {
//                                                $item = $row["item_id"];
//                                                for($i = 0; $i<=2; $i++){
//                                                    if($i == 0) $j = "1";
//                                                    else if($i == 1) $j = "男";
//                                                    else if($i == 2) $j = "女";
//                                                    $re1 = $con_grade->query("select final_grade from program where final_grade != 0 and present = 1 and item_id = $item and con_sex = $j");
//
//                                                }
//                                                $re1 = $con_grade->query("select final_grade from program where final_grade != 0 and present = 1 and item_id = $item and con_sex = 1");
//                                            }
//                                        }

                                        if($re->num_rows > 0) {
                                            $item = array();
                                            $grade = array();
                                            $i = 0;
                                            while ($row = $re->fetch_assoc()) {
                                                if($row["con_sex"] == "男"){
                                                    $item_id = "1".$row["item_id"];
                                                }else if($row["con_sex"] == "女"){
                                                    $item_id = "2".$row["item_id"];
                                                }else if($row["con_sex"] == "1"){
                                                    $item_id = "0".$row["item_id"];
                                                }
                                                if(!in_array($item_id, $item)){
                                                    $item[$i++] = $item_id;
                                                    $item_id1 = $row["item_id"];
                                                    $grade = array();
                                                    $re1 = $con_grade->query("select final_grade, item_id, con_id, con_sex from program where final_grade != 0 and present = 1 and item_id = $item_id1");
                                                    if(!$re1){
                                                        throw new Exception("ERROR_3: 获取显示信息失败！");
                                                    }else{
                                                        if($re1->num_rows > 0) {
                                                            while ($row1 = $re1->fetch_assoc()) {
                                                                if($row1["con_sex"] == "男"){
                                                                    $item_id = "1".$row1["item_id"];
                                                                }else if($row1["con_sex"] == "女"){
                                                                    $item_id = "2".$row1["item_id"];
                                                                }else if($row1["con_sex"] == "1"){
                                                                    $item_id = "0".$row1["item_id"];
                                                                }
                                                                if(in_array($item_id, $item) && $item[$i-1] == $item_id) {
                                                                    $grade[$row1["con_id"]] = $row1["final_grade"] ;
                                                                }
                                                            }
                                                        }
                                                        arsort($grade);
                                                        $j = 1;
                                                        foreach($grade as $x=>$x_value) {
                                                            $re2 = $con_grade->query("update program set rank = $j where con_id = $x and item_id = $item_id1");
                                                            if(!$re2) throw new Exception("ERROR_2: 分数排序失败！");
                                                            $j++;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        $re_grade = $con_grade->query($sql_grade);
                                        if(!$re_grade){
                                            throw new Exception("ERROR_3: 获取显示信息失败！");
                                        }else{
                                            if($re_grade->num_rows > 0){
                                                while($row_grade = $re_grade->fetch_assoc()){
                                                    $a = $row_grade["program_id"];
                                                    //<font size="6" color="red">".$row_grade["group_id"]."</font>

                                                    echo "<tr class=\"cen\">";
                                                    echo "<td height = '50'><font size=\"4\" color=\"black\">".$row_grade["present_order"]."</font></td>";
                                                    echo "<td height = '50'><font size=\"4\" color=\"black\">".$row_grade["program_id"]."</font></td>";
                                                    if($row_grade["con_sex"] == "男") $item_group = $row_grade["item_name"]."男子组";
                                                    else if($row_grade["con_sex"] == "女") $item_group = $row_grade["item_name"]."女子组";
                                                    else if($row_grade["con_sex"] == "1") $item_group = $row_grade["item_name"];
                                                    echo "<td height = '50'><font size=\"4\" color=\"black\">".$item_group."</font></td>";
                                                    echo "<td height = '50'><font size=\"7\" color=\"black\">".$row_grade["con_name"]."</font></td>";
                                                    echo "<td height = '50'><font size=\"7\" color=\"black\">".$row_grade["con_id"]."</font></td>";
                                                    echo "<td height = '50'><font size=\"4\" color=\"black\">".$row_grade["con_unit"]."</font></td>";
                                                    echo "<td height = '50'><font size=\"7\" color=\"black\">".$row_grade["final_grade"]."</font></td>";
                                                    echo "<td height = '50'><font size=\"7\" color=\"black\">".$row_grade["rank"]."</font></td>";
                                                    echo "</tr>";
                                                    $i = 0;
                                                }
                                            }
                                        }
                                        $con_grade->commit();
                                        mysqli_autocommit($con_grade, true);
                                        $con_grade->close();
                                    }
                                }catch(Exception $e){
                                    $con_grade->rollback();
                                    mysqli_autocommit($con_grade, true);
                                    $message = $e->getMessage();
                                    echo "<script language=\"JavaScript\">\r\n";
                                    echo " alert($message);\r\n";
                                    echo "location.href='index.php';";
                                    echo "</script>";
                                    exit;
                                }

                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--开始::结束-->
            </div>
        </main>

    </div>
</div>
</body>
</html>

