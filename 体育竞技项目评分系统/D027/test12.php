<?php
//发送 用户id  返回可用资金


$postData = file_get_contents('php://input');
$re = json_decode($postData);
if($re !=''){
    //搜索数据库 返回持有股票数量
      ;
    $backmoney = array('money'=> 5000);
    $backmoney2 = json_encode($backmoney);
    echo  $backmoney2;

}
