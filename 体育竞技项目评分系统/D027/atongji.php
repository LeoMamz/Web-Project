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
            <div class="page-wrap">
                <!--开始::内容-->
                <section class="page-hd">
                    <header>
                        <h2 class="title">报名统计</h2>
                        <p class="title-description">
                            此界面展示了所有报名选手的信息和一些统计信息。
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
                                    <li >数据总览</li>
                                    <li class="active">统计图表</li>
                                </ul>
                            </div>
                            <div class="tab-cont">
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
                                    $_SESSION["start"] = 1;//方便裁判长控制评分起始
                                    if($_SESSION["start"] == 1){
                                        $con_grade = new mysqli("localhost", "root", "mamz", "d027");
                                        $con_grade->query("set names 'UTF8'");

                                        if ($con_grade->connect_error)
                                        {
                                            die('连接失败: ' . $con_grade->connect_error);

                                        }else {
                                            $sql_grade = "SELECT * FROM program NATURAL JOIN item ORDER BY group_id, con_unit,program_id";
                                            $re_grade = $con_grade->query($sql_grade);
                                            if($re_grade->num_rows > 0){
                                                //记录各个学院男女生和各个年级的学生数量
                                                $unit_list = array("紫云碧峰学园","蓝田学园","丹青学园","竺可桢学院","人文学院","外国语言文化与国际交流学院","医学院","传媒与国际文化学院","经济学院","光华法学院","教育学院","管理学院","公共管理学院","马克思主义学院","数学科学学院","物理学系","化学学系","地球科学学院","心理与行为科学系","机械工程学院","材料科学与工程学院","能源工程学院","电气工程学院","建筑工程学院","化学工程与生物工程学院","海洋学院","航空航天学院","高分子科学与工程学系","光电科学与工程学院","信息与电子工程学院","控制科学与工程学院","计算机科学与技术学院","生物医学工程与仪器科学学院","生命科学学院","生物系统工程与食品科学学院","环境与资源学院","农业与生物技术学院","动物科学学院","药学院");
                                                $a1 = array(0,0,0,0,0,0);$a2 = array(0,0,0,0,0,0);
                                                $a3 = array(0,0,0,0,0,0);$a4 = array(0,0,0,0,0,0);
                                                $a5 = array(0,0,0,0,0,0);$a6 = array(0,0,0,0,0,0);
                                                $a7 = array(0,0,0,0,0,0);$a8 = array(0,0,0,0,0,0);
                                                $a9 = array(0,0,0,0,0,0);$a10 = array(0,0,0,0,0,0);
                                                $a11 = array(0,0,0,0,0,0);$a12 = array(0,0,0,0,0,0);
                                                $a13 = array(0,0,0,0,0,0);$a14 = array(0,0,0,0,0,0);
                                                $a15 = array(0,0,0,0,0,0);$a16 = array(0,0,0,0,0,0);
                                                $a17 = array(0,0,0,0,0,0);$a18 = array(0,0,0,0,0,0);
                                                $a19 = array(0,0,0,0,0,0);$a20 = array(0,0,0,0,0,0);
                                                $a21 = array(0,0,0,0,0,0);$a22 = array(0,0,0,0,0,0);
                                                $a23 = array(0,0,0,0,0,0);$a24 = array(0,0,0,0,0,0);
                                                $a25 = array(0,0,0,0,0,0);$a26 = array(0,0,0,0,0,0);
                                                $a27 = array(0,0,0,0,0,0);$a28 = array(0,0,0,0,0,0);
                                                $a29 = array(0,0,0,0,0,0);$a30 = array(0,0,0,0,0,0);
                                                $a31 = array(0,0,0,0,0,0);$a32 = array(0,0,0,0,0,0);
                                                $a33 = array(0,0,0,0,0,0);$a34 = array(0,0,0,0,0,0);
                                                $a35 = array(0,0,0,0,0,0);$a36 = array(0,0,0,0,0,0);
                                                $a37 = array(0,0,0,0,0,0);$a38 = array(0,0,0,0,0,0);
                                                $a39 = array(0,0,0,0,0,0);
                                                $total = array($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14, $a15, $a16, $a17, $a18, $a19, $a20, $a21, $a22, $a23, $a24, $a25, $a26, $a27, $a28, $a29, $a30, $a31, $a32, $a33, $a34, $a35, $a36, $a37, $a38, $a39);
                                                while($row_grade = $re_grade->fetch_assoc()){
                                                    $a = $row_grade["program_id"];
                                                    echo "<tr class=\"cen\">";
                                                    echo "<td>".$row_grade["program_id"]."</td>";
                                                    echo "<td>".$row_grade["group_id"]."</td>";
                                                    echo "<td>".$row_grade["item_id"]."</td>";
                                                    echo "<td>".$row_grade["item_name"]."</td>";
                                                    echo "<td>".$row_grade["con_name"]."</td>";
                                                    echo "<td>".$row_grade["con_id"]."</td>";
                                                    echo "<td>".$row_grade["con_unit"]."</td>";
                                                    echo "</tr>";
                                                    $i = 0;
                                                    for($i = 0; $i < 39; $i++){
                                                        if($row_grade["con_unit"] == $unit_list[$i]){
                                                            if($row_grade["con_sex"] == "男"){
                                                                $total[$i][0]++;
                                                            }else if($row_grade["con_sex"] == "女"){
                                                                $total[$i][1]++;
                                                            }
                                                            if($row_grade["con_id"] >= "3180100000" && $row_grade["con_id"] <= "3180109999"){
                                                                $total[$i][2]++;
                                                            }else if($row_grade["con_id"] >= "3170100000" && $row_grade["con_id"] <= "3170109999"){
                                                                $total[$i][3]++;
                                                            }else if($row_grade["con_id"] >= "3160100000" && $row_grade["con_id"] <= "3160109999"){
                                                                $total[$i][4]++;
                                                            }else if($row_grade["con_id"] >= "3150100000" && $row_grade["con_id"] <= "3150109999"){
                                                                $total[$i][5]++;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-cont" style="display: block;">
                                <div class="panel panel-default">
                                    <div class="panel-hd">统计图表样式一</div>
                                    <div class="panel-bd">
                                        <div id="tongji1" style="height:500px"></div>
                                        <script type="text/javascript">
                                            var dom = document.getElementById("tongji1");
                                            var myChart = echarts.init(dom);
                                            var app = {};
                                            option = null;
                                            app.title = '堆叠条形图';

                                            option = {
                                                tooltip : {
                                                    trigger: 'axis',
                                                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                                                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                                                    }
                                                },
                                                legend: {
                                                    data: ['紫云碧峰学园','蓝田学园','丹青学园','竺可桢学院','文科类学院','社科类学院','理科类学院','工科类学院','农学类学院','医学类学院']
                                                },
                                                grid: {
                                                    left: '3%',
                                                    right: '4%',
                                                    bottom: '3%',
                                                    containLabel: true
                                                },
                                                xAxis:  {
                                                    type: 'value'
                                                },
                                                yAxis: {
                                                    type: 'category',
                                                    data: ['男生','女生', '大一','大二','大三','大四']
                                                },
                                                series: [
                                                    {
                                                        name: '<?php echo $unit_list[0]; ?>',
                                                        type: 'bar',
                                                        stack: '总量',
                                                        label: {
                                                            normal: {
                                                                show: true,
                                                                position: 'insideRight'
                                                            }
                                                        },
                                                        data: [<?php echo $total[0][0]; ?>, <?php echo $total[0][1]; ?>, <?php echo $total[0][2]; ?>, <?php echo $total[0][3]; ?>, <?php echo $total[0][4]; ?>,<?php echo $total[0][5]; ?>]
                                                    }
                                                    <?php
                                                    for($i = 1; $i < 10; $i++) {
                                                        $q1 = $q2 = $q3 = $q4 = $q5 = $q6 =0;
                                                        if($i == 4){
                                                            $unit = "文科类学院";
                                                            for($j = 4; $j < 7; $j++){
                                                                $q1 = $q1+$total[$j][0];
                                                                $q2 = $q2+$total[$j][1];
                                                                $q3 = $q3+$total[$j][2];
                                                                $q4 = $q4+$total[$j][3];
                                                                $q5 = $q5+$total[$j][4];
                                                                $q6 = $q6+$total[$j][5];
                                                            }
                                                        }else if($i == 5){
                                                            $unit = "社科类学院";
                                                            for($j = 7; $j < 13; $j++){
                                                                $q1 = $q1+$total[$j][0];
                                                                $q2 = $q2+$total[$j][1];
                                                                $q3 = $q3+$total[$j][2];
                                                                $q4 = $q4+$total[$j][3];
                                                                $q5 = $q5+$total[$j][4];
                                                                $q6 = $q6+$total[$j][5];
                                                            }
                                                        }else if($i == 6){
                                                            $unit = "理科类学院";
                                                            for($j = 13; $j < 18; $j++){
                                                                $q1 = $q1+$total[$j][0];
                                                                $q2 = $q2+$total[$j][1];
                                                                $q3 = $q3+$total[$j][2];
                                                                $q4 = $q4+$total[$j][3];
                                                                $q5 = $q5+$total[$j][4];
                                                                $q6 = $q6+$total[$j][5];
                                                            }
                                                        }else if($i == 7){
                                                            $unit = "工科类学院";
                                                            for($j = 18; $j < 32; $j++){
                                                                $q1 = $q1+$total[$j][0];
                                                                $q2 = $q2+$total[$j][1];
                                                                $q3 = $q3+$total[$j][2];
                                                                $q4 = $q4+$total[$j][3];
                                                                $q5 = $q5+$total[$j][4];
                                                                $q6 = $q6+$total[$j][5];
                                                            }
                                                        }else if($i == 8){
                                                            $unit = "农学类学院";
                                                            for($j = 32; $j < 37; $j++){
                                                                $q1 = $q1+$total[$j][0];
                                                                $q2 = $q2+$total[$j][1];
                                                                $q3 = $q3+$total[$j][2];
                                                                $q4 = $q4+$total[$j][3];
                                                                $q5 = $q5+$total[$j][4];
                                                                $q6 = $q6+$total[$j][5];
                                                            }
                                                        }else if($i == 9){
                                                            $unit = "医学类学院";
                                                            for($j = 37; $j < 39; $j++){
                                                                $q1 = $q1+$total[$j][0];
                                                                $q2 = $q2+$total[$j][1];
                                                                $q3 = $q3+$total[$j][2];
                                                                $q4 = $q4+$total[$j][3];
                                                                $q5 = $q5+$total[$j][4];
                                                                $q6 = $q6+$total[$j][5];
                                                            }
                                                        }else {
                                                            $unit = $unit_list[$i];
                                                            $q1 = $total[$i][0];
                                                            $q2 = $total[$i][1];
                                                            $q3 = $total[$i][2];
                                                            $q4 = $total[$i][3];
                                                            $q5 = $total[$i][4];
                                                            $q6 = $total[$i][5];
                                                        }
                                                        echo ",";
                                                        echo "{";
                                                        echo "name: '$unit',";
                                                        echo "type: 'bar',";
                                                        echo "stack: '总量',";
                                                        echo "label: {
                                                            normal: {
                                                                show: true,
                                                                position: 'insideRight'
                                                            }
                                                        },";
                                                        echo "data:[ ";

                                                        echo $q1;
                                                        echo ",";
                                                        echo $q2;
                                                        echo ",";
                                                        echo $q3;
                                                        echo ",";
                                                        echo $q4;
                                                        echo ",";
                                                        echo $q5;
                                                        echo ",";
                                                        echo $q6;
                                                        echo "]";
                                                        echo "}";
                                                    }

                                                    ?>
                                                    // ,{name: '蓝田学园',type: 'bar',stack: '总量',label: { normal: { show: true, position: 'insideRight' } },data:[ 3,2,4,0,0,1]},
                                                    // {name: '丹青学园',type: 'bar',stack: '总量',label: { normal: { show: true, position: 'insideRight' } },data:[ 4,1,2,2,0,1]},
                                                    // {name: '竺可桢学院',type: 'bar',stack: '总量',label: { normal: { show: true, position: 'insideRight' } },data:[ 1,5,1,2,2,1]}
                                                    // ,{name: '文科类学院',type: 'bar',stack: '总量',label: { normal: { show: true, position: 'insideRight' } },data:[ 6,11,3,8,3,3]},
                                                    // {name: '社科类学院',type: 'bar',stack: '总量',label: { normal: { show: true, position: 'insideRight' } },data:[  11,14,6,7,7,5]},
                                                    // {name: '理科类学院',type: 'bar',stack: '总量',label: { normal: { show: true, position: 'insideRight' } },data:[16,14,9,9,7,5]},
                                                    // {name: '工科类学院',type: 'bar',stack: '总量',label: { normal: { show: true, position: 'insideRight' } },data:[ 38,32,15,20,17,18]},
                                                    // {name: '农学类学院',type: 'bar',stack: '总量',label: { normal: { show: true, position: 'insideRight' } },data:[ 15,9,5,6,4,9]},
                                                    // {name: '医学类学院',type: 'bar',stack: '总量',label: { normal: { show: true, position: 'insideRight' } },data:[ 7,4,6,0,1,4]}
                                                    ]
                                            };;
                                            if (option && typeof option === "object") {
                                                myChart.setOption(option, true);
                                            }
                                        </script>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-hd">统计图表样式二</div>
                                    <div class="panel-bd">
                                        <div id="tongji2" style="height:400px"></div>
                                        <script type="text/javascript">
                                            var dom = document.getElementById("tongji2");
                                            var myChart = echarts.init(dom);
                                            var app = {};
                                            option = null;
                                            app.title = '正负条形图';

                                            option = {
                                                tooltip : {
                                                    trigger: 'axis',
                                                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                                                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                                                    }
                                                },
                                                legend: {
                                                    data:['利润', '支出', '收入']
                                                },
                                                grid: {
                                                    left: '3%',
                                                    right: '4%',
                                                    bottom: '3%',
                                                    containLabel: true
                                                },
                                                xAxis : [
                                                    {
                                                        type : 'value'
                                                    }
                                                ],
                                                yAxis : [
                                                    {
                                                        type : 'category',
                                                        axisTick : {show: false},
                                                        data : ['周一','周二','周三','周四','周五','周六','周日']
                                                    }
                                                ],
                                                series : [
                                                    {
                                                        name:'利润',
                                                        type:'bar',
                                                        label: {
                                                            normal: {
                                                                show: true,
                                                                position: 'inside'
                                                            }
                                                        },
                                                        data:[200, 170, 240, 244, 200, 220, 210]
                                                    },
                                                    {
                                                        name:'收入',
                                                        type:'bar',
                                                        stack: '总量',
                                                        label: {
                                                            normal: {
                                                                show: true
                                                            }
                                                        },
                                                        data:[320, 302, 341, 374, 390, 450, 420]
                                                    },
                                                    {
                                                        name:'支出',
                                                        type:'bar',
                                                        stack: '总量',
                                                        label: {
                                                            normal: {
                                                                show: true,
                                                                position: 'left'
                                                            }
                                                        },
                                                        data:[-120, -132, -101, -134, -190, -230, -210]
                                                    }
                                                ]
                                            };
                                            ;
                                            if (option && typeof option === "object") {
                                                myChart.setOption(option, true);
                                            }
                                        </script>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-hd">统计图表样式三</div>
                                    <div class="panel-bd">
                                        <div id="tongji3" style="height:400px"></div>
                                        <script type="text/javascript">
                                            var dom = document.getElementById("tongji3");
                                            var myChart = echarts.init(dom);
                                            var app = {};
                                            option = null;
                                            option = {
                                                title : {
                                                    text: '测试',
                                                    subtext: '更多查看echarts',
                                                    x:'center'
                                                },
                                                tooltip : {
                                                    trigger: 'item',
                                                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                                                },
                                                legend: {
                                                    x : 'center',
                                                    y : 'bottom',
                                                    data:['rose1','rose2','rose3','rose4','rose5','rose6','rose7','rose8']
                                                },
                                                toolbox: {
                                                    show : true,
                                                    feature : {
                                                        mark : {show: true},
                                                        dataView : {show: true, readOnly: false},
                                                        magicType : {
                                                            show: true,
                                                            type: ['pie', 'funnel']
                                                        },
                                                        restore : {show: true},
                                                        saveAsImage : {show: true}
                                                    }
                                                },
                                                calculable : true,
                                                series : [
                                                    {
                                                        name:'半径模式',
                                                        type:'pie',
                                                        radius : [20, 110],
                                                        center : ['25%', '50%'],
                                                        roseType : 'radius',
                                                        label: {
                                                            normal: {
                                                                show: false
                                                            },
                                                            emphasis: {
                                                                show: true
                                                            }
                                                        },
                                                        lableLine: {
                                                            normal: {
                                                                show: false
                                                            },
                                                            emphasis: {
                                                                show: true
                                                            }
                                                        },
                                                        data:[
                                                            {value:10, name:'rose1'},
                                                            {value:5, name:'rose2'},
                                                            {value:15, name:'rose3'},
                                                            {value:25, name:'rose4'},
                                                            {value:20, name:'rose5'},
                                                            {value:35, name:'rose6'},
                                                            {value:30, name:'rose7'},
                                                            {value:40, name:'rose8'}
                                                        ]
                                                    },
                                                    {
                                                        name:'面积模式',
                                                        type:'pie',
                                                        radius : [30, 110],
                                                        center : ['75%', '50%'],
                                                        roseType : 'area',
                                                        data:[
                                                            {value:10, name:'rose1'},
                                                            {value:5, name:'rose2'},
                                                            {value:15, name:'rose3'},
                                                            {value:25, name:'rose4'},
                                                            {value:20, name:'rose5'},
                                                            {value:35, name:'rose6'},
                                                            {value:30, name:'rose7'},
                                                            {value:40, name:'rose8'}
                                                        ]
                                                    }
                                                ]
                                            };
                                            ;
                                            if (option && typeof option === "object") {
                                                myChart.setOption(option, true);
                                            }
                                        </script>
                                    </div>
                                </div>

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

