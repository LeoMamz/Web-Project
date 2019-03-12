<?php
//发送股票id 用户id  返回持有该股票数量

$postData = file_get_contents('php://input');
$re = json_decode($postData);
if($re->stock_id!= '' && $re->user_id!=''){
    //搜索数据库 返回持有股票数量
    $num = 10  ;
    $backdata= array('stock_number'=>$num);
    $backdata2=json_encode($backdata);
    echo $backdata2;
}
