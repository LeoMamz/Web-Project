<?php
	header('Access-Control-Allow-Origin:*');
	$postStr = '{"action": "stop", "stock_id": "APPLE"}';
	$js = json_decode($postStr, true);
	echo $js['action'];
	//$postStr = file_get_contents("php://input");
	//echo $postStr;
	//echo '<script src="http://code.jquery.com/jquery-latest.js"></script>';//
   // $student = $_POST['student'];
   // echo $student['name'];
   // echo $student['age'];
   // echo $student['sex'];
?>
