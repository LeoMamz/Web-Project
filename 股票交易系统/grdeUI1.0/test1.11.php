<?php
$postData = file_get_contents('php://input');
$re = json_decode($postData);
//var_dump($re);
$size = $re->size;
$p = array();
for($i = 0; $i < $size; $i++){
    $p[$i] = $re->remID[$i]; // 数组$p中存储着需要查询价格变化的股票的ID
}
//你们在这里进行查询,将数据存储在二位数组$rem[][]中，
//其中$rem[i][0]中为股票ID；
//$rem[i][1]到$rem[i][6]中逐个为涨价、跌价、日涨幅、日跌幅、5min涨幅、5min跌幅
//具体的样式参考下面的数组$return
/*$rem = array(
    array('001', 11, 12, 13, 14, 15, 16),
    array('002', 16, 15, 14, 13, 12, 11),
    array('002', 16, 15, 14, 13, 12, 11),
    array('002', 16, 15, 14, 13, 12, 11)
);*/
$r = json_encode($rem);
echo $r;



