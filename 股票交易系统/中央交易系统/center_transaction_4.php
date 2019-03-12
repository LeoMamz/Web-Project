<?php
session_start();
//header("Content-type: text/html; charset=utf8");
header("HTTP/1.1 200 OK");

$checkDayStr = date('Y-m-d ', time());
$timeBegin1 = strtotime($checkDayStr . "09:30" . ":00");
$timeEnd1 = strtotime($checkDayStr . "15:00" . ":00");
$curr_time = time();
if ($curr_time >= $timeBegin1 && $curr_time <= $timeEnd1) {
    /*我们的程序*/
}


/*-----------------------建库建表---------------------*/
$con = mysqli_connect("localhost:3306", "root", "", "mysql");//连接数据库
if (!$con) {
    die("连接错误：" . mysqli_connect_error());
}
mysqli_query($con, "set character utf8");
//新建数据库stock
$db_name = 'stock';
$d = 0;
$flag = 0;
$db_result = mysqli_query($con, "show databases");
while ($row = mysqli_fetch_array($db_result)) {
    if ($row[$d] == 'stock') {
        $flag = 1;
        break;
    }
}
if ($flag == 0) {
    mysqli_query($con, "create database stock");
    //echo"创建数据库成功!";
    mysqli_select_db($con, "stock");//连接创建的数据库stock
    $table_message = "create table message
		(stock_name varchar(40),
		stock_id char(10),
		stock_price decimal(7,2),
		continue_trans bool default 1,
		up_confine decimal(4,2) default 0.1,
		down_confine decimal(4,2) default 0.1,
		primary key(stock_name))";
    if (mysqli_query($con, $table_message)) {
        echo "创建股票表成功!";
    } else {
        echo "创建股票表错误：" . mysqli_error($con);
    }
    /*state状态，1表示未交易，2表示部分交易，3表示完全交易
    price表示该指令最终成交价格
    complete_num表示最终成交股数
    user_id表示用户名
    continue_trans表示交易是否进行，默认值为1*/
    $table_buy = "create table buy        
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
    if (mysqli_query($con, $table_buy)) {
        echo "创建买指令表成功!";
    } else {
        echo "创建买指令表错误：" . mysqli_error($con);
    }
    $table_sell = "create table sell     
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
    if (mysqli_query($con, $table_sell)) {
        echo "创建卖指令表成功!";
    } else {
        echo "创建卖指令表错误：" . mysqli_error($con);
    }
    /*trans_no交易记录编号
    stock_id交易股票名称
    trans_price单笔交易价格
    trans_stock_num单笔交易股数
    time交易成交时间
    sell_no卖指令编号（外键）
    buy_no买指令编号（外键）*/
    $table_tran = "create table tran      
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
    if (mysqli_query($con, $table_tran)) {
        echo "创建交易记录表成功!";
    } else {
        echo "创建交易记录表错误：" . mysqli_error($con);
    }
} else if ($flag == 1) {
    mysqli_select_db($con, "stock");
}

$db_name = 'administration';
$d = 0;
$flag = 0;
$db_result = mysqli_query($con, "show databases");
while ($row = mysqli_fetch_array($db_result)) {
    if ($row[$d] == 'administration') {
        $flag = 1;
        break;
    }
}
if ($flag == 0) {
    mysqli_query($con, "create database administration");
    //echo"创建数据库成功!";
    mysqli_select_db($con, "administration");
    $table_1 = "create table natural_security_acc(
		sec_acc int not null auto_increment,
		sec_pwd varchar(20) not null,
		if_frozen tinyint(1)default 0,
		name varchar(20) not null,
		gender char(2) not null,
		identity_num char(18) not null unique,
		address varchar(80) not null,
		occupation varchar(20) not null,
		education varchar(20) not null,
		company varchar(40) not null,
		tel varchar(20) not null,
		if_agency tinyint(1) default 0 ,
		agent_id char(18) default '000000000000000000',
		primary key(sec_acc))";
    if (mysqli_query($con, $table_1)) {
        $table_1_alter = "alter table natural_security_acc AUTO_INCREMENT=1000000000";
        mysqli_query($con, $table_1_alter);
    }
    $table_2 = "create table legal_security_acc(
		sec_acc int not null auto_increment,
		sec_pwd varchar(20) not null,
		if_frozen tinyint(1) default 0,
		corp_name varchar(40) not null,
		reg_id char(15) not null unique,
		license char(15) not null unique,
		corp_tel varchar(20) not null,
		corp_addr varchar(80) not null,
		corp_rep_name varchar(20) not null,
		corp_rep_id char(18) not null unique,
		auth_name varchar(20) not null,
		auth_id char(18) not null unique,
		auth_tel varchar(20) not null,
		auth_addr varchar(80) not null,
		primary key(sec_acc))";
    if (mysqli_query($con, $table_2)) {
        $table_2_alter = "alter table legal_security_acc AUTO_INCREMENT=2000000000";
        mysqli_query($con, $table_2_alter);
    }
    $table_3 = "create table capital_acc(
		cap_acc int not null  auto_increment,
		cap_pwd varchar(20) not null,
		sec_acc int not null,
		active_cap int not null,
		frozen_cap int not null,
		if_frozen tinyint(1) default 0,
		primary key(cap_acc))";
    if (mysqli_query($con, $table_3)) {
        $table_3_alter = "alter table capital_acc AUTO_INCREMENT=3000000000";
        mysqli_query($con, $table_3_alter);
    }
    $table_4 = "create table stock_info(
		sec_acc int not null,
		stock_code char(6) not null,
		stock_name varchar(40) not null,
		current_price int not null,
		stock_num int not null,
		total_cost decimal(16,2) not null,
		if_frozen tinyint(1) default 0,
		primary key(sec_acc, stock_code))";
    mysqli_query($con, $table_4);
    $table_5 = "create table admin (
		ID VARCHAR(20),
		password VARCHAR(20))";
    mysqli_query($con, $table_5);
}


/*------------------从交易管理系统获取信息------------------*/
function http_post_data($url, $data_string)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($data_string))
    );
    ob_start();
    curl_exec($ch);
    $return_content = ob_get_contents();

    ob_end_clean();

    $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    return $return_content;
}


/*-------------------从交易客户端获取信息--------------------*/
$TCpostData = json_encode(array('stock_id' => "shoudaoqinghuida", 'type' => 7)); //file_get_contents('php://input');
echo $TCpostData;
$TCdata = json_decode($TCpostData);
//echo json_encode($TCdata);
//$TCtype = $TCdata['type'];
$TCtype = $TCdata->type;
if ($TCtype == 10) {
    $a = json_encode(true);
    echo $a;
}
var_dump($TCdata);
// 0-出售 1-购买 2-撤回出售 3-撤回购买 4-请求用户出售股票 5-请求用户购买股票 6-请求用户交易记录股票 7-查询股票是否停牌

if (($TCtype == 4) || ($TCtype == 5) || ($TCtype == 6) || ($TCtype == 7)) {
    $TCstock_id = $TCdata->stock_id;
} else {
    $TCstock_id = $TCdata->stock_id;
    $TCstock_price = $TCdata->stock_price;
    $TCstock_number = $TCdata->stock_number;
    $TCuser_id = $TCdata->user_id;
    $TCdate = $TCdata->date;
    $TCtype = $TCdata->type;// 0 出售 1 购买

    $TCtimestamp = time();
}

//假设外部传值
/*$TCstock_id="0000000000";
$TCuser_id=1;
$TCstock_price=90;
$TCstock_number=50;
$TCtimestamp=date("y-m-d h:i:s");
$TCdate=date("y-m-d h:i:s");
$TCtype=0;
$TSMup=0.1;
$TSMdown=0.1;
$settlement=100;
$confine_flag=1;*/


$TCstock_name_result = mysqli_query($con, "SELECT stock_name FROM message WHERE stock_id='" . $TCstock_id . "'");
$TCstock_name = mysqli_fetch_array($TCstock_name_result);
$stock_name = $TCstock_name[0];

$settlement_result = mysqli_query($con, "SELECT trans_price FROM tran WHERE trans_no=(SELECT max(trans_no) FROM tran WHERE TO_DAYS(NOW())-TO_DAYS(time)=1) AND stock_id='" . $TCstock_id . "'");
$settlement_array = mysqli_fetch_array($settlement_result);
$settlement = $settlement_array[0];

$up_confine_result = mysqli_query($con, "SELECT up_confine FROM message WHERE stock_id='" . $TCstock_id . "'");
$up_confine_array = mysqli_fetch_array($up_confine_result);
$up_confine = $up_confine_array[0];

$down_confine_result = mysqli_query($con, "SELECT down_confine FROM message WHERE stock_id='" . $TCstock_id . "'");
$down_confine_array = mysqli_fetch_array($down_confine_result);
$down_confine = $down_confine_array[0];

$limit_up = $settlement + ($settlement * $up_confine);
$limit_down = $settlement - ($settlement * $down_confine);


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
                              $TCtimestamp*/

//排序函数
function sortByCols($list, $field)
{
    $sort_arr = array();
    $sort_rule = '';
    foreach ($field as $sort_field => $sort_way) {
        foreach ($list as $key => $val) {
            $sort_arr[$sort_field][$key] = $val[$sort_field];
        }
        $sort_rule .= '$sort_arr["' . $sort_field . '"],' . $sort_way . ',';
    }
    if (empty($sort_arr) || empty($sort_rule)) {
        return $list;
    }
    eval('array_multisort(' . $sort_rule . ' $list);');
    return $list;
}

//------------获取信息--------------
//while(true)
//{
//撤销卖指令
if ($TCtype == 2) {
    //获取该指令的状态
    $cur_delete_result = mysqli_query($con, "SELECT state 
														  FROM sell
														  WHERE stock_id 	= '" . $TCstock_id . "'
														  AND   user_id  	= " . $TCuser_id . "
														  AND   stock_price	= " . $TCstock_price . "
														  AND   stock_num 	= " . $TCstock_number . "
														  AND   time 		= '" . $TCtimestamp . "'");
    $if_can_delete = mysqli_fetch_array($cur_delete_result);
    //若未被处理，则撤销
    if ($if_can_delete == 1) {
        mysqli_query($con, "DELETE FROM sell 
							  WHERE stock_id 	= '" . $TCstock_id . "'
							  AND   user_id  	= " . $TCuser_id . "
							  AND   stock_price	= " . $TCstock_price . "
							  AND   stock_num 	= " . $TCstock_number . "
							  AND   time 		= '" . $TCtimestamp . "'");
        $data = array('re' => 1);
        $Tcdata = json_encode($data);
        echo $Tcdata;
    } //否则不做任何变动
    else {
        $data = array('re' => 0);
        $Tcdata = json_encode($data);
        echo $Tcdata;
    }
} //撤销买指令
else if ($TCtype == 3) {
    //获取该指令的状态
    $cur_delete_result = mysqli_query($con, "SELECT state 
														  FROM buy
														  WHERE stock_id 	= '" . $TCstock_id . "'
														  AND   user_id  	= " . $TCuser_id . "
														  AND   stock_price	= " . $TCstock_price . "
														  AND   stock_num 	= " . $TCstock_number . "
														  AND   time 		= '" . $TCtimestamp . "'");
    $if_can_delete = mysqli_fetch_array($cur_delete_result);
    //若未被处理，则撤销
    if ($if_can_delete == 1) {
        mysqli_query($con, "DELETE FROM buy 
							  WHERE stock_id 	= '" . $TCstock_id . "'
							  AND   user_id  	= " . $TCuser_id . "
							  AND   stock_price	= " . $TCstock_price . "
							  AND   stock_num 	= " . $TCstock_number . "
							  AND   time 		= '" . $TCtimestamp . "'");
        $data = array('re' => 1);
        $Tcdata = json_encode($data);
        echo $Tcdata;
    } //否则不做任何变动
    else {
        $data = array('re' => 0);
        $Tcdata = json_encode($data);
        echo $Tcdata;
    }
}


//获取最优先的指令元组（获取所有信息后排序）
//存放同一支股票的买指令
$buy_stock_result[] = array();
//存放同一支股票的卖指令
$sell_stock_result[] = array();
//存放当前处理的买指令
$cur_buy = array();
//存放当前处理的卖指令
$cur_sell = array();

//传入指令为卖指令，需匹配买指令
if ($TCtype == 0) {
    //获取该股票的可交易状态
    $cur_stock_state_result = mysqli_query($con, "SELECT continue_trans FROM message WHERE stock_id = '" . $TCstock_id . "'");
    $cur_stock_state = mysqli_fetch_array($cur_stock_state_result);

    //从数据库获取该股票所有买指令
    $cur_buy_result = mysqli_query($con, "SELECT * FROM buy WHERE state <> 3 AND stock_id = '" . $TCstock_id . "'");
    $row_num = mysqli_num_rows($cur_buy_result);

    if (!$row_num || !$cur_stock_state[0]) {
        mysqli_query($con, "INSERT INTO sell
						  VALUES (NULL, '" . $TCstock_id . "', '" . $stock_name . "', " . $TCstock_price . ", " . $TCstock_number . ", '" . $TCtimestamp . "', 1, 0, 0, " . $TCuser_id . ")");
        //echo $stock_name;
    } else {
        //存入备用数组
        $col_num = mysqli_num_fields($cur_buy_result);
        $j = 0;
        while ($row = mysqli_fetch_array($cur_buy_result)) {
            for ($i = 0; $i < $col_num; $i++) {
                $buy_stock_result[$j][$i] = $row[$i];
            }
            $j++;
        }

        //优先级排序（先价格，同价格选最早）
        $buy_stock_result = sortByCols($buy_stock_result, array(
            3 => SORT_DESC,  //先按价格降序
            5 => SORT_ASC,   //再按时间升序
        ));
        //获取最优先买指令
        $cur_buy = $buy_stock_result[0];
        //-------------指令撮合---------------

        //将该卖指令传入数据库
        mysqli_query($con, "INSERT INTO sell
							  VALUES (NULL, '" . $TCstock_id . "', '" . $stock_name . "', " . $TCstock_price . ", " . $TCstock_number . ", '" . $TCtimestamp . "', 1, 0, 0, " . $TCuser_id . ")");

        //获取该指令的id
        $sell_no_result = mysqli_query($con, "SELECT max(sell_no) FROM sell");
        $sell_no_cur = mysqli_fetch_array($sell_no_result);

        //此时卖价高于最高买价，撮合失败
        if ($TCstock_price > $cur_buy[3]) {
            ;
        } //此时买卖价格刚好相等，属于最一般情况，直接匹配
        else if ($TCstock_price == $cur_buy[3]) {
            //切割指令

            if ($TCstock_number > $cur_buy[4]) //此时卖指令股数多于买指令，将卖指令切割
            {
                //按照买指令股数交易这一部分
                price_calc(1, $TCstock_price, $cur_buy[3], $cur_buy[4], $sell_no_cur[0], $cur_buy[0]);

                //更新该买指令状态为3
                mysqli_query($con, "UPDATE buy SET state = 3
									  WHERE buy_no = '.$cur_buy[0].'");

                $sell_stock_remain = $TCstock_number - $cur_buy[4];

                //卖指令剩下的部分作为新指令返回指令队列
                mysqli_query($con, "UPDATE sell SET state = 2, stock_num = '.$sell_stock_remain.'
									  WHERE sell_no = '.$sell_no_cur[0].'");

            } else if ($TCstock_number == $cur_buy[4]) //此时买卖股数也相等
            {
                //按照买指令股数交易这一部分
                price_calc(1, $TCstock_price, $cur_buy[3], $cur_buy[4], $sell_no_cur[0], $cur_buy[0]);

                //更新该买指令状态为完全交易
                mysqli_query($con, "UPDATE buy SET state = 3
									  WHERE buy_no = '.$cur_buy[0].'");

                //更新该卖指令状态为完全交易
                mysqli_query($con, "UPDATE sell SET state = 3
									  WHERE sell_no = '.$sell_no_cur[0].'");


            } else //此时买指令股数多于卖指令，将买指令切割
            {
                //按照卖指令股数交易这一部分
                price_calc(1, $TCstock_price, $cur_buy[3], $TCstock_number, $sell_no_cur[0], $cur_buy[0]);

                //更新该卖指令状态为3
                mysqli_query($con, "UPDATE sell SET state = 3
									  WHERE sell_no = '.$sell_no_cur[0].'");

                $buy_stock_remain = $cur_buy[4] - $TCstock_number;

                //买指令剩下的部分作为新指令返回指令队列
                mysqli_query($con, "UPDATE buy SET state = 2, stock_num = " . $buy_stock_remain . "
									  WHERE buy_no = '.$cur_buy[0].'");
            }
        } //此时卖价低于最高买价
        else {
            //切割指令

            if ($TCstock_number > $cur_buy[4]) //此时卖指令股数多于买指令，将卖指令切割
            {
                //按照买指令股数交易这一部分
                price_calc(2, $TCstock_price, $cur_buy[3], $cur_buy[4], $sell_no_cur[0], $cur_buy[0]);

                //更新该买指令状态为3
                mysqli_query($con, "UPDATE buy SET state = 3
									  WHERE buy_no = '.$cur_buy[0].'");

                $sell_stock_remain = $TCstock_number - $cur_buy[4];

                //卖指令剩下的部分作为新指令返回指令队列
                mysqli_query($con, "UPDATE sell SET state = 2, stock_num = " . $sell_stock_remain . "
									  WHERE sell_no = '.$sell_no_cur[0].'");

            } else if ($TCstock_number == $cur_buy[4]) //此时买卖股数也相等
            {
                //按照买指令股数交易这一部分
                price_calc(2, $TCstock_price, $cur_buy[3], $cur_buy[4], $sell_no_cur[0], $cur_buy[0]);

                //更新该买指令状态为完全交易
                mysqli_query($con, "UPDATE buy SET state = 3
									  WHERE buy_no = '.$cur_buy[0].'");

                //更新该卖指令状态为完全交易
                mysqli_query($con, "UPDATE sell SET state = 3
									  WHERE sell_no = '.$sell_no_cur[0].'");


            } else //此时买指令股数多于卖指令，将买指令切割
            {
                //按照卖指令股数交易这一部分
                price_calc(2, $TCstock_price, $cur_buy[3], $TCstock_number, $sell_no_cur[0], $cur_buy[0]);

                //更新该卖指令状态为3
                mysqli_query($con, "UPDATE sell SET state = 3
									  WHERE sell_no = '.$sell_no_cur[0].'");

                $buy_stock_remain = $cur_buy[4] - $TCstock_number;

                //买指令剩下的部分作为新指令返回指令队列
                mysqli_query($con, "UPDATE buy SET state = 2, stock_num = '.$buy_stock_remain.'
									  WHERE buy_no = '.$cur_buy[0].'");
            }

        }

    }
} //传入指令为买指令，需匹配卖指令
else if ($TCtype == 1) {
    //获取该股票的可交易状态
    $cur_stock_state_result = mysqli_query($con, "SELECT continue_trans FROM message WHERE stock_id = '" . $TCstock_id . "'");
    $cur_stock_state = mysqli_fetch_array($cur_stock_state_result);

    //从数据库获取该股票所有卖指令
    $cur_sell_result = mysqli_query($con, "SELECT * FROM sell WHERE state <> 3 AND stock_id = '" . $TCstock_id . "'");
    $row_num = mysqli_num_rows($cur_sell_result);
    if (!$row_num || !$cur_stock_state[0]) {
        mysqli_query($con, "INSERT INTO buy
						  VALUES (NULL, '" . $TCstock_id . "', '" . $stock_name . "', " . $TCstock_price . ", " . $TCstock_number . ", '" . $TCtimestamp . "', 1, 0, 0, " . $TCuser_id . ")");
    } else {
        //存入备用数组
        $col_num = mysqli_num_fields($cur_sell_result);
        $j = 0;
        while ($row = mysqli_fetch_array($cur_sell_result)) {
            for ($i = 0; $i < $col_num; $i++) {
                $sell_stock_result[$j][$i] = $row[$i];
            }
            $j++;
        }

        //优先级排序（先价格，同价格选最早）
        $sell_stock_result = sortByCols($sell_stock_result, array(
            3 => SORT_ASC,  //先按价格升序
            5 => SORT_ASC,  //再按时间升序
        ));
        //获取最优先卖指令
        $cur_sell = $sell_stock_result[0];

        //-------------指令撮合---------------

        //将该买指令传入数据库
        mysqli_query($con, "INSERT INTO buy
							  VALUES (NULL, '" . $TCstock_id . "', '" . $stock_name . "'," . $TCstock_price . ", " . $TCstock_number . ", '" . $TCtimestamp . "', 1, 0, 0, " . $TCuser_id . ")");

        //获取该指令的id
        $buy_no_result = mysqli_query($con, "SELECT max(buy_no) FROM buy");
        $buy_no_cur = mysqli_fetch_array($buy_no_result);

        //此时最低卖价高于买价，撮合失败
        if ($cur_sell[3] > $TCstock_price) {
            ;
        } //此时买卖价格刚好相等，属于最一般情况，直接匹配
        else if ($TCstock_price == $cur_sell[3]) {
            //切割指令

            if ($cur_sell[4] > $TCstock_number) //此时卖指令股数多于买指令，将卖指令切割
            {
                //按照买指令股数交易这一部分
                price_calc(1, $cur_sell[3], $TCstock_price, $TCstock_number, $cur_sell[0], $buy_no_cur[0]);

                //更新该买指令状态为3
                mysqli_query($con, "UPDATE buy SET state = 3
									 WHERE buy_no = '.$buy_no_cur[0].'");
                $complete_num_result = mysqli_query($con, "SELECT complete_num FROM buy 
									 WHERE buy_no = '.$buy_no_cur[0].'");
                $complete_num = mysqli_fetch_array($complete_num_result);
                mysqli_query($con, "UPDATE buy SET stock_num = '.$complete_num[0].'
									 WHERE buy_no = '.$buy_no_cur[0].'");

                $sell_stock_remain = $cur_sell[4] - $TCstock_number;

                //卖指令剩下的部分作为新指令返回指令队列
                mysqli_query($con, "UPDATE sell SET state = 2, stock_num = '.$sell_stock_remain.'
									 WHERE sell_no = '.$cur_sell[0].'");

            } else if ($TCstock_number == $cur_sell[4]) //此时买卖股数也相等
            {
                //按照买指令股数交易这一部分
                price_calc(1, $TCstock_price, $cur_sell[3], $TCstock_number, $cur_sell[0], $buy_no_cur[0]);

                //更新该买指令状态为完全交易
                mysqli_query($con, "UPDATE buy SET state = 3
									 WHERE buy_no = '.$buy_no_cur[0].'");
                $complete_num_result = mysqli_query($con, "SELECT complete_num FROM buy 
									 WHERE buy_no = '.$buy_no_cur[0].'");
                $complete_num = mysqli_fetch_array($complete_num_result);
                mysqli_query($con, "UPDATE buy SET stock_num = '.$complete_num[0].'
									 WHERE buy_no = '.$buy_no_cur[0].'");

                //更新该卖指令状态为完全交易
                mysqli_query($con, "UPDATE sell SET state = 3
									 WHERE sell_no = '.$cur_sell[0].'");
                $complete_num_result = mysqli_query($con, "SELECT complete_num FROM sell 
									 WHERE sell_no = '.$cur_sell[0].'");
                $complete_num = mysqli_fetch_array($complete_num_result);
                mysqli_query($con, "UPDATE sell SET stock_num = '.$complete_num[0].'
									 WHERE sell_no = '.$cur_sell[0].'");


            } else //此时买指令股数多于卖指令，将买指令切割
            {
                //按照卖指令股数交易这一部分
                price_calc(1, $TCstock_price, $cur_buy[3], $cur_sell[4], $cur_sell[0], $buy_no_cur[0]);

                //更新该卖指令状态为3
                mysqli_query($con, "UPDATE sell SET state = 3
									 WHERE sell_no = '.$cur_sell[0].'");
                $complete_num_result = mysqli_query($con, "SELECT complete_num FROM sell 
									 WHERE sell_no = '.$cur_sell[0].'");
                $complete_num = mysqli_fetch_array($complete_num_result);
                mysqli_query($con, "UPDATE sell SET stock_num = '.$complete_num[0].'
									 WHERE sell_no = '.$cur_sell[0].'");

                $buy_stock_remain = $TCstock_number - $cur_sell[4];

                //买指令剩下的部分作为新指令返回指令队列
                mysqli_query($con, "UPDATE buy SET state = 2, stock_num = '.$buy_stock_remain.'
									 WHERE buy_no = '.$buy_no_cur[0].'");
            }
        } //此时卖价低于最高买价
        else {
            //切割指令

            if ($cur_sell[4] > $TCstock_number) //此时卖指令股数多于买指令，将卖指令切割
            {
                //按照买指令股数交易这一部分
                price_calc(2, $cur_sell[3], $TCstock_price, $TCstock_number, $cur_sell[0], $buy_no_cur[0]);

                //更新该买指令状态为3
                mysqli_query($con, "UPDATE buy SET state = 3
									 WHERE buy_no = '.$buy_no_cur[0].'");
                $complete_num_result = mysqli_query($con, "SELECT complete_num FROM buy 
									 WHERE buy_no = '.$buy_no_cur[0].'");
                $complete_num = mysqli_fetch_array($complete_num_result);
                mysqli_query($con, "UPDATE buy SET stock_num = '.$complete_num[0].'
									 WHERE buy_no = '.$buy_no_cur[0].'");

                $sell_stock_remain = $cur_sell[4] - $TCstock_number;

                //卖指令剩下的部分作为新指令返回指令队列
                mysqli_query($con, "UPDATE sell SET state = 2, stock_num = '.$sell_stock_remain.'
									 WHERE sell_no = '.$cur_sell[0].'");

            } else if ($TCstock_number == $cur_sell[4]) //此时买卖股数也相等
            {
                //按照买指令股数交易这一部分
                price_calc(2, $TCstock_price, $cur_sell[3], $TCstock_number, $cur_sell[0], $buy_no_cur[0]);

                //更新该买指令状态为完全交易
                mysqli_query($con, "UPDATE buy SET state = 3
									 WHERE buy_no = '.$buy_no_cur[0].'");
                $complete_num_result = mysqli_query($con, "SELECT complete_num FROM buy 
									 WHERE buy_no = '.$buy_no_cur[0].'");
                $complete_num = mysqli_fetch_array($complete_num_result);
                mysqli_query($con, "UPDATE buy SET stock_num = " . $complete_num[0] . "
									 WHERE buy_no = '.$buy_no_cur[0].'");

                //更新该卖指令状态为完全交易
                mysqli_query($con, "UPDATE sell SET state = 3
									 WHERE sell_no = '.$cur_sell[0].'");
                $complete_num_result = mysqli_query($con, "SELECT complete_num FROM sell 
									 WHERE sell_no = '.$cur_sell[0].'");
                $complete_num = mysqli_fetch_array($complete_num_result);
                mysqli_query($con, "UPDATE sell SET stock_num = " . $complete_num[0] . "
									 WHERE sell_no = '.$cur_sell[0].'");


            } else //此时买指令股数多于卖指令，将买指令切割
            {
                //按照卖指令股数交易这一部分
                price_calc(2, $TCstock_price, $cur_buy[3], $cur_sell[4], $cur_sell[0], $buy_no_cur[0]);

                //更新该卖指令状态为3
                mysqli_query($con, "UPDATE sell SET state = 3
									 WHERE sell_no = '.$cur_sell[0].'");
                $complete_num_result = mysqli_query($con, "SELECT complete_num FROM sell 
									 WHERE sell_no = '.$cur_sell[0].'");
                $complete_num = mysqli_fetch_array($complete_num_result);
                mysqli_query($con, "UPDATE sell SET stock_num = '.$complete_num[0].'
								  WHERE sell_no = '.$cur_sell[0].'");

                $buy_stock_remain = $TCstock_number - $cur_sell[4];

                //买指令剩下的部分作为新指令返回指令队列
                mysqli_query($con, "UPDATE buy SET state = 2, stock_num = " . $buy_stock_remain . "
									 WHERE buy_no = " . $buy_no_cur[0] . "");
            }

        }
    }

}

//}


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


function price_calc($Condition, $SellPrice, $BuyPrice, $StockNumber, $sell_no, $buy_no)
{
    global $TSMup, $TSMdown, $confine_flag, $con, $settlement, $limit_up, $limit_down, $stock_name;
    switch ($Condition) {            //撮合情况，1为买卖价格一致，2为中间价格算法
        case 1:
            $Price = $SellPrice;
            break;
        case 2:
            $Price = ($SellPrice + $BuyPrice) / 2;
            break;
    }
    $stock_id_result = mysqli_query($con, "SELECT stock_id FROM buy where buy_no='.$buy_no.'");
    $stock_id = mysqli_fetch_array($stock_id_result);

    //涨跌停限制
    if ($Price < $limit_down) {
        $Price = $limit_down;
        mysqli_query($con, "UPDATE message SET continue_trans=0 WHERE stock_id='" . $stock_id[0] . "'");
    } else if ($Price > $limit_up) {
        $Price = $limit_up;
        mysqli_query($con, "UPDATE message SET continue_trans=0 WHERE stock_id='" . $stock_id[0] . "'");
    }

    //单笔交易结果返回
    $current_time = date("y-m-d h:i:s");
    mysqli_query($con, "INSERT INTO tran values(NULL,'" . $stock_id[0] . "','" . $stock_name . "'," . $Price . "," . $StockNumber . ",'" . $current_time . "'," . $sell_no . "," . $buy_no . ")");
    mysqli_query($con, "UPDATE message SET stock_price= " . $Price . " WHERE stock_id='" . $stock_id[0] . "'");

    //查询交易结果集中该买指令的买记录，加权平均算法计算已买入的股票总价格
    $P = array();
    $S = array();
    $i = 0;
    $buy_P_result = mysqli_query($con, "SELECT trans_price FROM tran where buy_no='.$buy_no.'");
    $buy_S_result = mysqli_query($con, "SELECT trans_stock_num FROM tran where buy_no='.$buy_no.'");
    $times = mysqli_num_rows($buy_P_result);
    while ($row = mysqli_fetch_array($buy_P_result)) {
        $P[$i++] = $row[0];
    }
    $i = 0;
    while ($row = mysqli_fetch_array($buy_S_result)) {
        $S[$i++] = $row[0];
    }
    $denominator = 0;
    $numerator = 0;
    for ($i = 0; $i < $times; $i++) {
        $denominator = $denominator + $S[$i];
        $numerator = $numerator + $P[$i] * $S[$i];
    }
    $BuyFinalPrice = $numerator / $denominator;

    //查询交易结果集中该卖指令的卖记录，加权平均算法计算已卖出的股票总价格
    $P = array();
    $S = array();
    $i = 0;
    $sell_P_result = mysqli_query($con, "SELECT trans_price FROM tran where sell_no='.$sell_no.'");
    $sell_S_result = mysqli_query($con, "SELECT trans_stock_num FROM tran where sell_no='.$sell_no.'");
    $times = mysqli_num_rows($sell_P_result);
    while ($row = mysqli_fetch_array($sell_P_result)) {
        $P[$i++] = $row[0];
    }
    $i = 0;
    while ($row = mysqli_fetch_array($sell_S_result)) {
        $S[$i++] = $row[0];
    }
    $denominator = 0;
    $numerator = 0;
    for ($i = 0; $i < $times; $i++) {
        $denominator = $denominator + $S[$i];
        $numerator = $numerator + $P[$i] * $S[$i];
    }
    $SellFinalPrice = $numerator / $denominator;

    //获得已买入数量
    $BuyNumber = 0;
    $buy_num_result = mysqli_query($con, "SELECT trans_stock_num FROM tran where buy_no='.$buy_no.'");
    while ($row = mysqli_fetch_array($buy_num_result)) {
        $BuyNumber = $BuyNumber + $row[0];
    }

    //获得已卖出数量
    $SellNumber = 0;
    $sell_num_result = mysqli_query($con, "SELECT trans_stock_num FROM tran where sell_no='.$sell_no.'");
    while ($row = mysqli_fetch_array($sell_num_result)) {
        $SellNumber = $SellNumber + $row[0];
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

    mysqli_query($con, "UPDATE buy SET price= '.$BuyFinalPrice.' WHERE buy_no='.$buy_no.'");
    mysqli_query($con, "UPDATE buy SET complete_num= '.$BuyNumber.' WHERE buy_no='.$buy_no.'");

    mysqli_query($con, "UPDATE sell SET price= '.$SellFinalPrice.' WHERE sell_no='.$sell_no.'");
    mysqli_query($con, "UPDATE sell SET complete_num= '.$SellNumber.' WHERE sell_no='.$sell_no.'");
}


/*-----------------反馈信息给交易客户端-----------------*/
if
($TCtype == 6) {
    $TCtype = 0;

    $sql = mysqli_query($con, "select * from tran where buy_user_id = '.$TCuser_id.' or sell_user_id= '.$TCuser_id.'");
    $datarow = mysqli_num_rows($sql);
    for ($i = 0; $i < $datarow; $i++) {
        $sql_arr = mysqli_fetch_assoc($sql);
        $stock_id = $sql_arr['stock_id'];
        $stock_price = $sql_arr['trans_price'];
        $stock_number = $sql_arr['trans_stock_num'];
        $date = $sql_arr['time'];
        $purchaser = $sql_arr['buy_user_id'];
        $seller = $sql_arr['sell_user_id'];
        $data[$i] = array($stock_id, $stock_price, $stock_number, $date, $purchaser, $seller);
    }

    $Tcdata = json_encode($data);
    echo $Tcdata;
//$urlTC = "localhost/stock/result.php";
//http_post_data($urlTC,$Tcdata );
} elseif
($TCtype == 4) {
    $TCtype = 0;
    $sql = mysqli_query($con, "select * from sell where user_id= '.$TCuser_id.'");
    $datarow = mysqli_num_rows($sql);
    for ($i = 0; $i < $datarow; $i++) {
        $sql_arr = mysqli_fetch_assoc($sql);
        $stock_id = $sql_arr['stock_name'];
        $stock_price = $sql_arr['stock_price'];
        $stock_number = $sql_arr['stock_num'];
        $date = $sql_arr['time'];
        $data[$i] = array($stock_id, $stock_price, $stock_number, $stock_number, $date);
    }
    $Tcdata = json_encode($data);
    echo $Tcdata;
//$urlTC = "localhost:8080/tc.php";
//http_post_data($urlTC,$Tcdata );
} elseif
($TCtype == 5) {
    $TCtype = 0;
    $sql = mysqli_query($con, "select * from buy where user_id= '.$TCuser_id.'");
    $datarow = mysqli_num_rows($sql);
    for ($i = 0; $i < $datarow; $i++) {
        $sql_arr = mysqli_fetch_assoc($sql);
        $stock_id = $sql_arr['stock_name'];
        $stock_price = $sql_arr['stock_price'];
        $stock_number = $sql_arr['stock_num'];
        $date = $sql_arr['time'];
        $data[$i] = array($stock_id, $stock_price, $stock_number, $stock_number, $date);
    }
    $Tcdata = json_encode($data);
    echo $Tcdata;
//	$urlTC = "localhost:8080/tc.php";
//	http_post_data($urlTC,$Tcdata );
} elseif
($TCtype == 7) {
    $sql = mysqli_query($con, "select * from message where stock_id = '" . $TCstock_id . "' and continue_trans = 1");
    $datarow = mysqli_num_rows($sql);

    if (datarow == 0) {
        $data = array('re2' => 0);
    } else {
        $data = array('re2' => 1);//}
    }


    $TCdata = json_encode($data);
//	$urlTC = "localhost:8080/tc.php";
    echo $TCdata;
//	http_post_data($urlTC,$TCdata );
} else {
    echo json_encode(1);
}


mysqli_close($con);
?>