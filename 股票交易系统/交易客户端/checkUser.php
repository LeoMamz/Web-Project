<?php
$postData = file_get_contents('php://input');
$re = json_decode($postData);
//传过来的数据是这样的：$data = json_encode(array('type'=>$postType, 'userID'=>$user, 'userPWD'=>$pwd));
if($re->userID == '123') {//这里是我自己测试的，可以删掉
    $a = json_encode(array('type'=>true));
    echo $a;
}
/*所有返回的数据放在json格式的$return中,去表中查找所有的提醒的信息存在二维数组$rem中：
$rem = array(
    array('001', 11, 12, 13, 14),
    array('002', 16, 15, 14, 13),
    array('002', 16, 15, 14, 13),
    array('002', 16, 15, 14, 13)
);
首先，检测账户是否正确：
if  不正确： echo ：$return = json_encode(array('type'=>false));
if  正确：   echo : $return = json_encode(array('type'=>true, 're'=>$rem));
*/

