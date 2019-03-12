<?php
/*-------------------从交易客户端获取信息--------------------*/
	$TCpostData = file_get_contents('php://input');
	$TCdata = json_decode($TCpostData,TRUE);
	$TCtype = $TCdata['type'];
	// 0-出售 1-购买 2-撤回出售 3-撤回购买 4-请求用户出售股票 5-请求用户购买股票 6-请求用户交易记录股票
	if(($TCtype ==4)||($TCtype ==5)||($TCtype ==6)){
		$TCuser_id = $TCdata['user_id'];
	}
	else{
	$TCstock_id = $TCdata['stock_id'];
	$TCstock_price = $TCdata['stock_price'];
	$TCstock_number = $TCdata['stock_number'];
	$TCuser_id = $TCdata['user_id'];
	$TCdate = $TCdata['date'];
	$TCtype = $TCdata['type'];// 0 出售 1 购买

	$TCtimestamp= time();
	}
?>