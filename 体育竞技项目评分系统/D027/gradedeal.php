<?php
///**
// * Created by PhpStorm.
// * User: Lenovo
// * Date: 2018/8/29
// * Time: 13:37
// */
//$s = $_POST["consex"];
//var_dump($s);
//$a1 =  "所有项目";
//$a2 = $_POST["conunit"];
//if($a1 == "所有项目"){
//    $a1 = "!= ''";
//}else $a1 = "= $a1";
//if($a2 == "所有学院"){
//    $a2 = "!= ''";
//}else $a2 = "= $a2";
//$sql_grade = "SELECT * FROM program NATURAL JOIN item where item_name $a1 and con_unit $a2 ORDER BY group_id,program_id";
//var_dump($sql_grade);
//if ($_SERVER["REQUEST_METHOD"] == "POST"){
//    var_dump($_POST["conunit"]);
//}
//$a = 9.6;
//$b = 9.4;
//$c = 8.6;
//$d = 2.3;
//$e = 5;
//
//$f = array($a , $b , $c , $d ,$e);
//var_dump($f);
//sort($f);
//var_dump($f);
//var_dump($_COOKIE["userid"]);
//var_dump($_COOKIE["user"]);
//echo "<tr class=\"cen\">";
//
//echo "<td>";
//echo "<form action=\"gradedeal.php\" method=\"post\">";
//echo "<input name=\"grade\" type=\"text\" placeholder=\"未上场给-1分\" class=\"form-control form-boxed\" style=\"width:130px;\">";
//echo "<input name=\"program_id\" type='hidden' value=$a>";
//echo "<input type=\"submit\" class=\"btn btn-primary\" value=\"提交\" />";
//echo "</form>";
//echo "</td>";
//echo "</tr>";
//?>
<!--<form action="gradedeal.php" method="post">-->
<!--<div class="form-group-col-2">-->
<!--    <div class="form-label">性别</div>-->
<!--    <div class="form-cont">-->
<!--        <label class="radio">-->
<!--            <input type="radio" name="consex" value="2"/>-->
<!--            <span>男士</span>-->
<!--        </label>-->
<!--        <label class="radio">-->
<!--            <input type="radio" name="consex" value="1" checked="checked"/>-->
<!--            <span>女士</span>-->
<!--        </label>-->
<!---->
<!--    </div>-->
<!---->
<!--</div>-->
<!--</form>-->
<!--<form action="gradedeal.php" method="post">-->
<!--<div class="form-group-col-2">-->
<!--    <div class="form-label">学院</div>-->
<!--    <div class="form-cont">-->
<!--        <select name = conunit style="width:auto;">-->
<!--            <option>紫云碧峰学园</option>-->
<!--            <option>蓝田学园</option>-->
<!--            <option>丹青学园</option>-->
<!--            <option>竺可桢学院</option>-->
<!--            4<option>人文学院</option>-->
<!--            <option>外国语言文化与国际交流学院</option>-->
<!--            <option>传媒与国际文化学院</option>-->
<!--            7<option>经济学院</option>-->
<!--            <option>光华法学院</option>-->
<!--            <option>教育学院</option>-->
<!--            <option>管理学院</option>-->
<!--            <option>公共管理学院</option>-->
<!--            <option>马克思主义学院</option>-->
<!--            13<option>数学科学学院</option>-->
<!--            <option>物理学系</option>-->
<!--            <option>化学学系</option>-->
<!--            <option>地球科学学院</option>-->
<!--            <option>心理与行为科学系</option>-->
<!--            18<option>机械工程学院</option>-->
<!--            <option>材料科学与工程学院</option>-->
<!--            <option>能源工程学院</option>-->
<!--            <option>电气工程学院</option>-->
<!--            <option>建筑工程学院</option>-->
<!--            <option>化学工程与生物工程学院</option>-->
<!--            <option>海洋学院</option>-->
<!--            <option>航空航天学院</option>-->
<!--            <option>高分子科学与工程学系</option>-->
<!--            <option>光电科学与工程学院</option>-->
<!--            <option>信息与电子工程学院</option>-->
<!--            <option>控制科学与工程学院</option>-->
<!--            <option>计算机科学与技术学院</option>-->
<!--            <option>生物医学工程与仪器科学学院</option>-->
<!--            32<option>生命科学学院</option>-->
<!--            <option>生物系统工程与食品科学学院</option>-->
<!--            <option>环境与资源学院</option>-->
<!--            <option>农业与生物技术学院</option>-->
<!--            <option>动物科学学院</option>-->
<!--            37<option>医学院</option>-->
<!--            <option>药学院</option>-->
<!--        </select>-->
<!---->
<!--    </div>-->
<!--</div>-->
<!--    <div class="form-group-col-2">-->
<!--        <div class="form-label"></div>-->
<!--        <div class="form-cont">-->
<!--            <input type="submit" class="btn btn-primary" value="提交报名" />-->
<!--            <input type="reset" class="btn btn-disabled" value="重置" />-->
<!--        </div>-->
<!--    </div>-->
<!--</form>-->

<?php
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
echo "'$unit_list[0]'";
                                                        for($i = 0; $i < 10; $i++){
                                                            echo ",'$unit_list[$i]'";
                                                        }

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
//                echo "<tr class=\"cen\">";
//                echo "<td>".$row_grade["program_id"]."</td>";
//                echo "<td>".$row_grade["group_id"]."</td>";
//                echo "<td>".$row_grade["item_id"]."</td>";
//                echo "<td>".$row_grade["item_name"]."</td>";
//                echo "<td>".$row_grade["con_name"]."</td>";
//                echo "<td>".$row_grade["con_id"]."</td>";
//                echo "<td>".$row_grade["con_unit"]."</td>";
//                echo "</tr>";
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
            var_dump($total);

        }
    }
}

?>