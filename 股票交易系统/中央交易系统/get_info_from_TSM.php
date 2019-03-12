<?php
	/*------------------从交易管理系统获取信息------------------*/
	session_start();
	
	$con=mysqli_connect("localhost:3306","root","123456","mysql");//连接数据库
    if(!$con){
      	die("连接错误：".mysqli_connect_error());
	}
	mysqli_query($con,"set character utf8");
    //新建数据库stock
	/*if(!mysqli_query($con,"create database stock")){
		echo"创建数据库错误：".mysqli_connect_error();
	}*/
	$db_name='stock';
	$d=0;
	$flag=0;
	$db_result=mysqli_query($con,"show databases");
	while($row=mysqli_fetch_array($db_result)){
		if($row[$d]=='stock'){
			$flag=1;
			break;
		}
	}
	if($flag==0){
		mysqli_query($con,"create database stock");
		//echo"创建数据库成功!";
		mysqli_select_db($con,"stock");//连接创建的数据库stock
		//总体股票信息
		$table_stock="create table message
		(stock_name varchar(40),
		stock_id char(30),
		stock_price decimal(7,2),
		continue_trans bool default 1,
		up_confine decimal(4,2) default 0.1,
		down_confine decimal(4,2) default 0.1,
		primary key(stock_name))";
		if(mysqli_query($con,$table_stock)){
			echo"创建股票信息表成功!";
		}
		else{
			echo"创建股票信息表错误：".mysqli_error($con);
		}
		/*state状态，1表示未交易，2表示部分交易，3表示完全交易
		price表示该指令最终成交价格
		complete_num表示最终成交股数
		user_id表示用户名
		continue_trans表示交易是否进行，默认值为1*/
		$table_buy="create table buy        
		(buy_no int(11) not null auto_increment,
		stock_id char(10),
		stock_name varchar(40),
		stock_price decimal(7,2),
		stock_num int(11),
		time timestamp default current_timestamp,
		state enum('1','2','3'),            
		price decimal(7,2),                 
		complete_num int(11), 
		user_id int(11),
		primary key(buy_no),
		foreign key(stock_name) references message(stock_name))";
		if(mysqli_query($con,$table_buy)){
			echo"创建买指令表成功!";
		}
		else{
			echo"创建买指令表错误：".mysqli_error($con);
		}
		$table_sell="create table sell     
		(sell_no int(11) not null auto_increment,
		stock_id char(10),
		stock_name varchar(40),
		stock_price decimal(7,2),
		stock_num int(11),
		time timestamp default current_timestamp,
		state enum('1','2','3'),            
		price decimal(7,2),                 
		complete_num int(11),  
        user_id int(11),		
		primary key(sell_no),
		foreign key(stock_name) references message(stock_name))";
		if(mysqli_query($con,$table_sell)){
			echo"创建卖指令表成功!";
		}
		else{
			echo"创建卖指令表错误：".mysqli_error($con);
		}
		/*trans_no交易记录编号
		stock_id交易股票名称
		trans_price单笔交易价格
		trans_stock_num单笔交易股数
		time交易成交时间
		sell_no卖指令编号（外键）
		buy_no买指令编号（外键）*/
		$table_tran="create table tran      
		(trans_no int(11) not null auto_increment,
		stock_id char(10),
		stock_name varchar(40),
		trans_price decimal(7,2),
		trans_stock_num int(11),
		time timestamp default current_timestamp,
		sell_no int(11),
		buy_no int(11),
		primary key(trans_no),
		foreign key(sell_no) references sell(sell_no),
		foreign key(buy_no) references buy(buy_no),
		foreign key(stock_name) references message(stock_name))";
		if(mysqli_query($con,$table_tran)){
			echo"创建交易记录表成功!";
		}
		else{
			echo"创建交易记录表错误：".mysqli_error($con);
		}
	}
	else if($flag==1){
		mysqli_select_db($con,"stock");
	}
	
	
	function http_post_data($url, $data_string) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json; charset=utf-8',
				'Content-Length: ' . strlen($data_string))
		);
		// ob_start();
		$return_content = curl_exec($ch);
		//ob_get_contents();
		//echo $return_content."<br>";
		// ob_end_clean();
		curl_close($ch);
		//  return array($return_code, $return_content);
		return  $return_content;
	}

	
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	header('Content-type:text/json');
	header('Access-Control-Allow-Origin:*');
	$postData = file_get_contents('php://input');
	//echo $postData;
try{	$TSMdata = json_decode($postData,true);
	// echo $TSMdata['action'];
	// echo gettype($TSMdata);
	$TSMaction = $TSMdata['action'];
	
	$confine_flag = 0;
	$start_flag = 0;
	$percent=0.01;
	if($TSMaction == "confine_change"){// 修改涨跌停限制
		$TSMname = $TSMdata['stock_name'];
		$TSMup = $TSMdata['up_confine'];
		$TSMdown = $TSMdata['down_confine'];
		$TSMup=$TSMup*$percent;
		$TSMdown=$TSMdown*$percent;
		mysqli_query($con,"UPDATE message SET up_confine=".$TSMup." WHERE stock_name='".$TSMname."'");
		mysqli_query($con,"UPDATE message SET down_confine=".$TSMdown." WHERE stock_name='".$TSMname."'");
		$confine_flag = 1;
		//echo "IN CONFINE{}";
	}
	if($TSMaction == "start"){ //开始交易
		$TSMid = $TSMdata['stock_id'];
		$start_flag =1;
		mysqli_query($con,"UPDATE message SET continue_trans= 1 WHERE stock_name='".$TSMid."'");
		//echo "IN start{}";
	}
	if($TSMaction == "stop"){ //停止交易
		$TSMid = $TSMdata['stock_id'];
		$start_flag= 2;
		mysqli_query($con,"UPDATE message SET continue_trans= 0 WHERE stock_name='".$TSMid."'");
		//echo "IN stop{}";
	}
	//throw new Exception("llll");
echo '{"result":true}';}
catch (Exception $e){
	echo '{"result":false}';
}
	//echo json_encode($result);
	//echo '<script src="http://code.jquery.com/jquery-latest.js"></script>';
	//echo $postData;
	
	//控制股票能否进行交易
	/*if($start_flag==1){
		$start_stock_id=$TSMid;
		mysqli_query($con,"UPDATE message SET continue_trans= 1 WHERE stock_id='".$start_stock_id."'");
	}
	else if($start_flag==2){
		$stop_stock_id=$TSMid;
		mysqli_query($con,"UPDATE message SET continue_trans= 0 WHERE stock_id='".$stop_stock_id."'");
	}*/
	
	//$settlement=100;
	/*$settlement_result=mysqli_query($con,"SELECT trans_price FROM tran WHERE trans_no=(SELECT max(trans_no) FROM tran WHERE TO_DAYS(NOW())-TO_DAYS(time)=1)");
	$settlement_array=mysqli_fetch_array($settlement_result);
	$settlement=$settlement_array[0];
	if($confine_flag==1){
		$confine_flag=0;
		$limit_up=$settlement+($settlement*$TSMup);
		$limit_down=$settlement-($settlement*$TSMdown);
	}
	
	//$_SESSION['confine_flag']=$confine_flag;
	$_SESSION['limit_up'] = $limit_up;
	$_SESSION['limit_down'] = $limit_down;*/
	
?>