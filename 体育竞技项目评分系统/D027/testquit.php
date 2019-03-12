<?php
$postData = file_get_contents('php://input');
$return = json_decode($postData);
/*$return->user是用户id
 * $return->re[][]是一个二位数组,形式如下：按顺序为股票id、涨价、跌价、日涨幅、日跌幅、5min涨幅、5min跌幅
array(
    array('001', 11, 12, 13, 14),
    array('002', 16, 15, 14, 13),
    array('002', 16, 15, 14, 1),
    array('002', 16, 15, 14, 13)
);
用count($re)可以知道我发了价格股票给你
*/
$size = count($re);
//在这里把我发给你的信息更新到数据库，不用返回任何值




