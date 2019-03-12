<?php
	//header("Content-type: text/html; charset=utf8");
	header("HTTP/1.1 200 OK");
	include 'get_info_from_TC.php';
	include 'get_info_from_TSM.php';
	
	
/*-----------------------建库建表---------------------*/
	$con=mysqli_connect("localhost:3306","root","123456","mysql");//连接数据库
    if(!$con){
      	die("连接错误：".mysqli_connect_error());
	}
	mysqli_query($con,"set character utf8");
    //新建数据库stock
	/*if(!mysqli_query($con,"create database stock")){
		echo"创建数据库错误：".mysqli_connect_error();
	}*/
	mysqli_query($con,"create database stock");
	$db_name='stock';
	$d=0;
	$flag=0;
	$db_result=mysqli_query($con, "show databases");
	while($row=mysqli_fetch_array($db_result)){
		if($row[$d]=='stock'){
			$flag=1;
			break;
		}
		$d = $d + 1;
	}
	if($flag==0){
		//echo"创建数据库成功!";
		mysqli_select_db($con,"stock");//连接创建的数据库stock
		/*state状态，1表示未交易，2表示部分交易，3表示完全交易
		price表示该指令最终成交价格
		complete_num表示最终成交股数
		user_id表示用户名
		continue_trans表示交易是否进行，默认值为1*/
		$table_buy="create table buy        
		(buy_no int(11) not null auto_increment,
		stock_id int(11),
		stock_price decimal(7,2),
		stock_num int(11),
		time timestamp default current_timestamp,
		state enum('1','2','3'),            
		price decimal(7,2),                 
		complete_num int(11), 
		user_id int(11),
		continue_trans bool default 1,
		primary key(buy_no))";
		if(mysqli_query($con,$table_buy)){
			//echo"创建买指令表成功!";
		}
		else{
			echo"创建买指令表错误：".mysqli_error($con);
		}
		$table_sell="create table sell     
		(sell_no int(11) not null auto_increment,
		stock_id int(11),
		stock_price decimal(7,2),
		stock_num int(11),
		time timestamp default current_timestamp,
		state enum('1','2','3'),            
		price decimal(7,2),                 
		complete_num int(11),  
        user_id int(11),
		continue_trans bool default 1,		
		primary key(sell_no))";
		if(mysqli_query($con,$table_sell)){
			//echo"创建卖指令表成功!";
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
		stock_id int(11),
		trans_price decimal(7,2),
		trans_stock_num int(11),
		time timestamp default current_timestamp,
		sell_no int(11),
		buy_no int(11),
		primary key(trans_no),
		foreign key(sell_no) references table_sell(sell_no),
		foreign key(buy_no) references table_buy(buy_no))";
		if(mysqli_query($con,$table_tran)){
			//echo"创建交易记录表成功!";
		}
		else{
			echo"创建交易记录表错误：".mysqli_error($con);
		}
	}
	
	
/*------------------从交易管理系统获取信息------------------*/

	
	
/*-------------------从交易客户端获取信息--------------------*/

	
	
/*-------------------------指令撮合-----------------------*/
	/*假设price_calc参数顺序是  	Condition:撮合的情况
						 		SellPrice:卖指令的股票价格
						 		BuyPrice:买指令的股票价格
						 		StockNumber:买卖指令的股数
						 		sell_no:卖指令编号
						 		buy_no:买指令编号*/

	/*来自交易客户端的数据		$TCstock_id
								$TCuser_id
	  							$TCstock_price
	  							$TCstock_number
	  							$TCdate
	 							$TCtype  (0 - sell   1 - buy   )
	 							$TCtype1 (0 - normal 1 - cancel)
	  							$TCtimestamp*/

	//排序函数
	function sortByCols($list, $field)
	{  
    	$sort_arr  = array();  
    	$sort_rule = '';  
    	foreach($field as $sort_field => $sort_way)
    	{  
       		foreach($list as $key => $val)
       		{  
            	$sort_arr[$sort_field][$key] = $val[$sort_field];  
        	}  
        	$sort_rule .= '$sort_arr["' . $sort_field . '"],'.$sort_way.',';  
    	}  
    	if(empty($sort_arr) || empty($sort_rule))
    	{ 
    		return $list; 
    	}  
    	eval('array_multisort('.$sort_rule.' $list);');
    	return $list;  
	}    							
	
	//------------获取信息--------------
	while(($TCtype != 4)&&($TCtype != 5)&&($TCtype != 6))
	{  
			//撤销卖指令
			if($TCtype == 2)
			{
				//获取该指令的状态
				$cur_delete_result  = mysqli_query($con, "SELECT state 
														  FROM sell
														  WHERE stock_id 	= ".$TCstock_id."
														  AND   user_id  	= ".$TCuser_id."
														  AND   stock_price	= ".$TCstock_price."
														  AND   stock_num 	= ".$TCstock_number."
														  AND   time 		= '".$TCtimestamp."'");
				$if_can_delete 		= mysqli_fetch_array($cur_delete_result);
				//若未被处理，则撤销
				if($if_can_delete == 1)
				{
					mysqli_query($con, "DELETE FROM sell 
							  WHERE stock_id 	= ".$TCstock_id."
							  AND   user_id  	= ".$TCuser_id."
							  AND   stock_price	= ".$TCstock_price."
							  AND   stock_num 	= ".$TCstock_number."
							  AND   time 		= '".$TCtimestamp."'");
				}
				//否则不做任何变动
				else
				{
					;
				}
			}
			//撤销买指令
			else if($TCtype == 3)
			{
				//获取该指令的状态
				$cur_delete_result  = mysqli_query($con, "SELECT state 
														  FROM buy
														  WHERE stock_id 	= ".$TCstock_id."
														  AND   user_id  	= ".$TCuser_id."
														  AND   stock_price	= ".$TCstock_price."
														  AND   stock_num 	= ".$TCstock_number."
														  AND   time 		= '".$TCtimestamp."'");
				$if_can_delete 		= mysqli_fetch_array($cur_delete_result);
				//若未被处理，则撤销
				if($if_can_delete == 1)
				{
					mysqli_query($con, "DELETE FROM buy 
							  WHERE stock_id 	= ".$TCstock_id."
							  AND   user_id  	= ".$TCuser_id."
							  AND   stock_price	= ".$TCstock_price."
							  AND   stock_num 	= ".$TCstock_number."
							  AND   time 		= '".$TCtimestamp."'");
				}
				//否则不做任何变动
				else
				{
					;
				}
			}
			continue;


		//获取最优先的指令元组（获取所有信息后排序）
		//存放同一支股票的买指令									 			  					   		  
		$buy_stock_result[]  = array();
		//存放同一支股票的卖指令
		$sell_stock_result[] = array();
		//存放当前处理的买指令	
		$cur_buy         	 = array();
		//存放当前处理的卖指令	
		$cur_sell        	 = array();

		//传入指令为卖指令，需匹配买指令
		if($TCtype == 0)
		{
			//从数据库获取该股票所有买指令
			$cur_buy_result  = mysqli_query($con, "SELECT * FROM buy WHERE state <> 3  AND continue_trans = 1 AND stock_id = '".$TCstock_id."'");

			//存入备用数组
			while($row = mysqli_fetch_array($cur_buy_result))
			{
				$buy_stock_result[] = $row;
			}

			//优先级排序（先价格，同价格选最早）
			$buy_stock_result = sortByCols($list, array(
										   'stock_price' => SORT_DESC,  //先按价格降序  
										   'time' 		 => SORT_ASC,  	//再按时间升序
										   ));
			//获取最优先买指令
			$cur_buy = $buy_stock_result[0];

			//-------------指令撮合---------------

			//将该卖指令传入数据库
			mysqli_query($con, "INSERT INTO sell
						  VALUES (NULL, ".$TCstock_id.", ".$TCstock_price.", ".$TCstock_number.", '".$TCtimestamp."', 1, 0, 0, ".$TCuser_id.", 1)");

			//获取该指令的id
			$sell_no_result = mysqli_query($con,"SELECT max(sell_no) FROM sell");
			$sell_no_cur    = mysqli_fetch_array($sell_no_result);

			//此时卖价高于最高买价，撮合失败
			if($TCstock_price > $cur_buy[2]) 
			{
				;
			}

			//此时买卖价格刚好相等，属于最一般情况，直接匹配
			else if($TCstock_price == $cur_buy[2]) 
			{
				//切割指令

				if($TCstock_number > $cur_buy[3]) //此时卖指令股数多于买指令，将卖指令切割
				{
					//按照买指令股数交易这一部分
					price_calc(1, $TCstock_price, $cur_buy[2], $cur_buy[3], $sell_no_cur, $cur_buy[0]);

					//更新该买指令状态为3
					mysqli_query($con, "UPDATE buy SET state = 3
								  WHERE buy_no = ".$cur_buy[0]."");

					$sell_stock_remain = $TCstock_number - $cur_buy[3];

					//卖指令剩下的部分作为新指令返回指令队列
					mysqli_query($con, "UPDATE sell SET state = 2, stock_num = ".$sell_stock_remain."
								  WHERE sell_no = ".$sell_no_cur."");

				}

				else if($TCstock_number == $cur_buy[3]) //此时买卖股数也相等
				{
					//按照买指令股数交易这一部分
					price_calc(1, $TCstock_price, $cur_buy[2], $cur_buy[3], $sell_no_cur, $cur_buy[0]);

					//更新该买指令状态为完全交易
					mysqli_query($con, "UPDATE buy SET state = 3
								  WHERE buy_no = ".$cur_buy[0]."");

					//更新该买指令状态为完全交易
					mysqli_query($con, "UPDATE sell SET state = 3
								  WHERE sell_no = ".$sell_no_cur."");

				
				}

				else //此时买指令股数多于卖指令，将买指令切割
				{
					//按照卖指令股数交易这一部分
					price_calc(1, $TCstock_price, $cur_buy[2], $TCstock_number, $sell_no_cur, $cur_buy[0]);

					//更新该卖指令状态为3
					mysqli_query($con, "UPDATE sell SET state = 3
								  WHERE sell_no = ".$sell_no_cur."");

					$buy_stock_remain = $cur_buy[3] - $TCstock_number;

					//买指令剩下的部分作为新指令返回指令队列
					mysqli_query($con, "UPDATE buy SET state = 2, stock_num = ".$buy_stock_remain."
								  WHERE buy_no = ".$cur_buy[0]."");
				}
			}

			//此时卖价低于最高买价
			else
			{
				//切割指令

				if($TCstock_number > $cur_buy[3]) //此时卖指令股数多于买指令，将卖指令切割
				{
					//按照买指令股数交易这一部分
					price_calc(2, $TCstock_price, $cur_buy[2], $cur_buy[3], $sell_no_cur, $cur_buy[0]);

					//更新该买指令状态为3
					mysqli_query($con, "UPDATE buy SET state = 3
								  WHERE buy_no = ".$cur_buy[0]."");

					$sell_stock_remain = $TCstock_number - $cur_buy[3];

					//卖指令剩下的部分作为新指令返回指令队列
					mysqli_query($con, "UPDATE sell SET state = 2, stock_num = ".$sell_stock_remain."
								  WHERE sell_no = ".$sell_no_cur."");

				}

				else if($TCstock_number == $cur_buy[3]) //此时买卖股数也相等
				{
					//按照买指令股数交易这一部分
					price_calc(2, $TCstock_price, $cur_buy[2], $cur_buy[3], $sell_no_cur, $cur_buy[0]);

					//更新该买指令状态为完全交易
					mysqli_query($con, "UPDATE buy SET state = 3
								  WHERE buy_no = ".$cur_buy[0]."");

					//更新该买指令状态为完全交易
					mysqli_query($con, "UPDATE sell SET state = 3
								  WHERE sell_no = ".$sell_no_cur."");

				
				}

				else //此时买指令股数多于卖指令，将买指令切割
				{
					//按照卖指令股数交易这一部分
					price_calc(2, $TCstock_price, $cur_buy[2], $TCstock_number, $sell_no_cur, $cur_buy[0]);

					//更新该卖指令状态为3
					mysqli_query($con, "UPDATE sell SET state = 3
								  WHERE sell_no = ".$sell_no_cur."");

					$buy_stock_remain = $cur_buy[3] - $TCstock_number;

					//买指令剩下的部分作为新指令返回指令队列
					mysqli_query($con, "UPDATE buy SET state = 2, stock_num = ".$buy_stock_remain."
								  WHERE buy_no = ".$cur_buy[0]."");
				}
			
			}
			
		}	

		//传入指令为买指令，需匹配卖指令
		else if($TCtype == 1)
		{
			//从数据库获取该股票所有卖指令
			$cur_sell_result  = mysqli_query($con, "SELECT * FROM sell WHERE state <> 3  AND continue_trans = 1 AND stock_id = '".$TCstock_id."'");

			//存入备用数组
			while($row = mysqli_fetch_array($cur_sell_result))
			{
				$sell_stock_result[] = $row;
			}

			//优先级排序（先价格，同价格选最早）
			$sell_stock_result = sortByCols($list, array(
										   'stock_price' => SORT_ASC,  //先按价格升序  
										   'time' 		 => SORT_ASC,  	//再按时间升序
										   ));
			//获取最优先卖指令
			$cur_sell = $sell_stock_result[0];

			//-------------指令撮合---------------

			//将该买指令传入数据库
			mysqli_query($con, "INSERT INTO buy
						  VALUES (NULL, ".$TCstock_id.", ".$TCstock_price.", ".$TCstock_number.", '".$TCtimestamp."', 1, 0, 0, ".$TCuser_id.", 1)");

			//获取该指令的id
			$buy_no_result = mysqli_query($con,"SELECT max(buy_no) FROM buy");
			$buy_no_cur    = mysqli_fetch_array($buy_no_result);

			//此时最低卖价高于买价，撮合失败
			if($cur_sell[2] > $TCstock_price) 
			{
				;
			}

			//此时买卖价格刚好相等，属于最一般情况，直接匹配
			else if($TCstock_price == $cur_sell[2]) 
			{
				//切割指令

				if($cur_sell[3] > $TCstock_number) //此时卖指令股数多于买指令，将卖指令切割
				{
					//按照买指令股数交易这一部分
					price_calc(1, $cur_sell[2], $TCstock_price, $TCstock_number, $cur_sell[0], $buy_no_cur);

					//更新该买指令状态为3
					mysqli_query($con, "UPDATE buy SET state = 3
								 WHERE buy_no = ".$buy_no_cur."");

					$sell_stock_remain = $cur_sell[3] - $TCstock_number;

					//卖指令剩下的部分作为新指令返回指令队列
					mysqli_query($con, "UPDATE sell SET state = 2, stock_num = ".$sell_stock_remain."
								 WHERE sell_no = ".$cur_sell[0]."");

				}

				else if($TCstock_number == $cur_sell[3]) //此时买卖股数也相等
				{
					//按照买指令股数交易这一部分
					price_calc(1, $TCstock_price, $cur_sell[2], $TCstock_number, $cur_sell[0], $buy_no_cur);

					//更新该买指令状态为完全交易
					mysqli_query($con, "UPDATE buy SET state = 3
								 WHERE buy_no = ".$buy_no_cur."");

					//更新该买指令状态为完全交易
					mysqli_query($con, "UPDATE sell SET state = 3
								 WHERE sell_no = ".$cur_sell[0]."");

				
				}

				else //此时买指令股数多于卖指令，将买指令切割
				{
					//按照卖指令股数交易这一部分
					price_calc(1, $TCstock_price, $cur_buy[2], $cur_sell[3], $cur_sell[0], $buy_no_cur);

					//更新该卖指令状态为3
					mysqli_query($con, "UPDATE sell SET state = 3
								 WHERE sell_no = ".$sell_no_cur."");

					$buy_stock_remain = $TCstock_number - $cur_sell[3];

					//买指令剩下的部分作为新指令返回指令队列
					mysqli_query($con, "UPDATE buy SET state = 2, stock_num = ".$buy_stock_remain."
								 WHERE buy_no = ".$cur_buy[0]."");
				}
			}

			//此时卖价低于最高买价
			else
			{
				//切割指令

				if($cur_sell[3] > $TCstock_number) //此时卖指令股数多于买指令，将卖指令切割
				{
					//按照买指令股数交易这一部分
					price_calc(2, $cur_sell[2], $TCstock_price, $TCstock_number, $cur_sell[0], $buy_no_cur);

					//更新该买指令状态为3
					mysqli_query($con, "UPDATE buy SET state = 3
								 WHERE buy_no = ".$buy_no_cur."");

					$sell_stock_remain = $cur_sell[3] - $TCstock_number;

					//卖指令剩下的部分作为新指令返回指令队列
					mysqli_query($con, "UPDATE sell SET state = 2, stock_num = ".$sell_stock_remain."
								 WHERE sell_no = ".$cur_sell[0]."");

				}

				else if($TCstock_number == $cur_sell[3]) //此时买卖股数也相等
				{
					//按照买指令股数交易这一部分
					price_calc(2, $TCstock_price, $cur_sell[2], $TCstock_number, $cur_sell[0], $buy_no_cur);

					//更新该买指令状态为完全交易
					mysqli_query($con, "UPDATE buy SET state = 3
								 WHERE buy_no = ".$buy_no_cur."");

					//更新该买指令状态为完全交易
					mysqli_query($con, "UPDATE sell SET state = 3
								 WHERE sell_no = ".$cur_sell[0]."");

				
				}

				else //此时买指令股数多于卖指令，将买指令切割
				{
					//按照卖指令股数交易这一部分
					price_calc(2, $TCstock_price, $cur_buy[2], $cur_sell[3], $cur_sell[0], $buy_no_cur);

					//更新该卖指令状态为3
					mysqli_query($con, "UPDATE sell SET state = 3
								 WHERE sell_no = ".$sell_no_cur."");

					$buy_stock_remain = $TCstock_number - $cur_sell[3];

					//买指令剩下的部分作为新指令返回指令队列
					mysqli_query($con, "UPDATE buy SET state = 2, stock_num = ".$buy_stock_remain."
								 WHERE buy_no = ".$cur_buy[0]."");
				}
			
			}

		}
		
	}
	
	
/*-----------------------价格计算------------------------*/
	/*需要的变量：
		Condition:撮合的情况
		SellPrice:卖指令的股票价格
		BuyPrice:买指令的股票价格
		StockNumber:买卖指令的股数
		sell_no:卖指令编号
		buy_no:买指令编号
		up_confine:涨幅
		down_confine:跌幅
		settlement:昨日收盘价
	*/

	//设置涨跌幅
	

	function price_calc($Condition,$SellPrice,$BuyPrice,$StockNumber,$sell_no,$buy_no){
		global $TSMup, $TSMdown;
		
		$up_confine=$TSMup;
		$down_confine=$TSMdown;
		
		switch ($Condition) {			//撮合情况，1为买卖价格一致，2为中间价格算法
			case 1:
				$Price=$SellPrice;
				break;
			case 2:
				$Price=($SellPrice+$BuyPrice)/2;
				break;
		}

		//涨跌停限制
		if($confine_flag==1){
			$confine_flag=0;
			$limit_up=$settlement+($settlement*$up_confine);
			$limit_down=$settlement+($settlement*$down_confine);
			if($Price<$limit_down){
				$Price=$limit_down;
			}
			else if($Price>$limit_up){
				$Price=$limit_up;
			}
		}

		//单笔交易结果返回
		$stock_id_result=mysqli_query($con,"SELECT stock_id FROM buy where buy_no=".$buy_no."");
		$stock_id=mysqli_fetch_array($stock_id_result);
		$current_time=time();
		mysqli_query($con,"INSERT INTO tran values(NULL,'".$stock_id[0]."',".$Price.",".$StockNumber.",'".$current_time."',".$sell_no.",".$buy_no.")");

		//查询交易结果集中该买指令的买记录，加权平均算法计算已买入的股票总价格
		$P=array();
		$S=array();
		$i=0;
		$buy_P_result=mysqli_query($con,"SELECT trans_price FROM tran where buy_no=".$buy_no."");
		$buy_S_result=mysqli_query($con,"SELECT trans_stock_num FROM tran where buy_no=".$buy_no."");
		$times=mysqli_num_rows($buy_P_result);
		while($row=mysqli_fetch_array($buy_P_result)){
			$P[$i++]=$row[0];
		}
		$i=0;
		while($row=mysqli_fetch_array($buy_S_result)){
			$S[$i++]=$row[0];
		}
		$denominator=0;
		$numerator=0;
		for($i=0;$i<$times;$i++){
			$denominator=$denominator+$S[$i];
			$numerator=$numerator+$P[$i]*$S[$i];
		}
		$BuyFinalPrice=$numerator/$denominator;

		//查询交易结果集中该卖指令的卖记录，加权平均算法计算已卖出的股票总价格
		$P=array();
		$S=array();
		$i=0;
		$sell_P_result=mysqli_query($con,"SELECT trans_price FROM tran where sell_no=".$sell_no."");
		$sell_S_result=mysqli_query($con,"SELECT trans_stock_num FROM tran where sell_no=".$sell_no."");
		$times=mysqli_num_rows($sell_P_result);
		while($row=mysqli_fetch_array($sell_P_result)){
			$P[$i++]=$row[0];
		}
		$i=0;
		while($row=mysqli_fetch_array($sell_S_result)){
			$S[$i++]=$row[0];
		}
		$denominator=0;
		$numerator=0;
		for($i=0;$i<$times;$i++){
			$denominator=$denominator+$S[$i];
			$numerator=$numerator+$P[$i]*$S[$i];
		}
		$SellFinalPrice=$numerator/$denominator;

		//获得已买入数量
		$BuyNumber=0;
		$buy_num_result=mysqli_query($con,"SELECT trans_stock_num FROM tran where buy_no=".$buy_no."");
		while($row=mysqli_fetch_array($buy_num_result)){		
			$BuyNumber=$BuyNumber+$row[0];
		}										

		//获得已卖出数量
		$SellNumber=0;
		$sell_num_result=mysqli_query($con,"SELECT trans_stock_num FROM tran where sell_no=".$sell_no."");
		while($row=mysqli_fetch_array($sell_num_result)){		
			$SellNumber=$SellNumber+$row[0];
		}										

		/*
			返回的值：
			SellComplete:卖指令交易状态，3是完全交易，2是部分交易
			BuyComplete:买指令交易状态，3是完全交易，2是部分交易
			SellNumber:卖指令总卖出数量
			BuyNumber:买指令总买入数量
			sell_no:卖指令编号
			buy_no:买指令编号
			SellFinalPrice:卖指令总成交价
			BuyFinalPrice:买指令总成交价
		*/

		mysqli_query($con,"UPDATE buy SET price= ".$BuyFinalPrice." WHERE buy_no=".$buy_no."");
		mysqli_query($con,"UPDATE buy SET complete_num= ".$BuyNumber." WHERE buy_no=".$buy_no."");

		mysqli_query($con,"UPDATE sell SET price= ".$SellFinalPrice." WHERE sell_no=".$sell_no."");
		mysqli_query($con,"UPDATE sell SET complete_num= ".$SellNumber." WHERE sell_no=".$sell_no."");
	}
	
	
/*-----------------反馈信息给交易客户端-----------------*/
	if($TCtype ==6){
		$TCtype =0 ;
		$sql = mysqli_query($con, "select * from tran where buy_user_id = '$TCuser_id' or sell_user_id= '$TCuser_id'");
		$datarow = mysqli_num_rows($sql);
		for($i=0;$i<$datarow;$i++){
			$sql_arr = mysqli_fetch_assoc($sql);
			$stock_id = $sql_arr['stock_id'];
			$stock_price = $sql_arr['trans_price'];
			$stock_number = $sql_arr['trans_stock_num'];
			$date = $sql_arr['time'];
			$purchaser = $sql_arr['buy_user_id'];
			$seller = $sql_arr['sell_user_id'];
			$data[i] = array($stock_id,$stock_price,$stock_number, $stock_number,$date,$purchaser, $seller);
			/*trans_no交易记录编号
				  stock_name交易股票名称
				  trans_price单笔交易价格
				  trans_stock_num单笔交易股数
				  time交易成交时间
				  sell_no卖指令编号（外键）
				  buy_no买指令编号（外键）*/
		}

		$Tcdata = json_encode($data);
		$urlTC = "localhost:8080/tc.php";
		http_post_data($urlTC,$Tcdata );
	}
	if($TCtype ==4){
		$TCtype =0 ;
		$sql = mysqli_query($con, "select * from sell where user_id= '$TCuser_id'");
		$datarow = mysqli_num_rows($sql);
		for($i=0;$i<$datarow;$i++){

			$sql_arr = mysqli_fetch_assoc($sql);
			$stock_id = $sql_arr['stock_name'];
			$stock_price = $sql_arr['stock_price'];
			$stock_number = $sql_arr['stock_num'];
			$date = $sql_arr['time'];
			$data[i] = array($stock_id,$stock_price,$stock_number, $stock_number,$date);

		}
		$Tcdata = json_encode($data);
		$urlTC = "localhost:8080/tc.php";
		http_post_data($urlTC,$Tcdata );
	}

	if($TCtype ==5){
		$TCtype =0 ;
		$sql = mysqli_query($con, "select * from buy where user_id= '$TCuser_id'");
		$datarow = mysqli_num_rows($sql);
		for($i=0;$i<$datarow;$i++){

			$sql_arr = mysqli_fetch_assoc($sql);
			$stock_id = $sql_arr['stock_name'];
			$stock_price = $sql_arr['stock_price'];
			$stock_number = $sql_arr['stock_num'];
			$date = $sql_arr['time'];
			$data[i] = array($stock_id,$stock_price,$stock_number, $stock_number,$date);

		}
		$Tcdata = json_encode($data);
		$urlTC = "localhost:8080/tc.php";
		http_post_data($urlTC,$Tcdata );
	}
	
	mysqli_close($con);
?>