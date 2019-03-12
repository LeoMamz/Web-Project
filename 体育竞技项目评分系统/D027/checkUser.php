<?php
header("Content-Type: text/html;charset=utf-8");
$postData = file_get_contents('php://input');
$re1 = json_decode($postData);
//传过来的数据是这样的：$data = json_encode(array('type'=>$postType, 'userID'=>$user, 'userPWD'=>$pwd));
//if($re->userID == '123') {//这里是我自己测试的，可以删掉
//    $a = json_encode(array('type'=>true));
//    echo $a;
//}
$con = new mysqli("localhost", "root", "mamz", "d027");
$con->query("set names 'UTF8'");
$name = "";
$id = "";
if ($con->connect_error)
{
    die('连接失败: ' . $con->connect_error);
}else{
    $sql1 = "select judge_id, judge_name, judge_password from judge";

    $re = $con->query($sql1);
    if ($re->num_rows > 0){
        //有查到相关记录
        $flag = 0;
        while($row = $re->fetch_assoc()) {
            $id = $row["judge_id"];
            $pw = $row["judge_password"];
            if(($id == $re1->userID && $pw == $re1->userPWD)) {
                $flag = 1;
                $name = $row["judge_name"];
//                var_dump($row["judge_name"]);
            }
        }
    }

    }

if($flag == 1 && $re1->type == 1) {
    $a = json_encode(array('type'=>true, 'name'=>$name, 'id'=>$re1->userID));
    echo $a;

} else if ($flag == 0 && $re1->type == 1){
    $a = json_encode(array('type'=>false));
    echo $a;
}else if($flag == 1 && $re1->type == 2) {
    $a = json_encode(array('result'=>0));
    echo $a;
}else if($flag == 0 && $re1->type == 2) {
    $a = json_encode(array('result'=>1));
    echo $a;
}

