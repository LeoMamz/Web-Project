<?php
//发送股票id 用户id  返回持有该股票数量

$postData = file_get_contents('php://input');
$re = json_decode($postData);
if($re  != ''){
    //搜索数据库 返回持有股票数量
    $bool1 = 1;
    $data=json_encode(array('re2'=>$bool1));
    echo $data;
}