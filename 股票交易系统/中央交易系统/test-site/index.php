<!DOCTYPE html>
<?php
	Session_Start();
	$_SESSION['value']=1;
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <link href="styles/style.css" rel="stylesheet" type="text/css">
    <title>My test page</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <style>
      form{
        margin:10px auto;
        width:400px;
        padding:1em;
        border:1px solid #CCC;
        border-radius:1em;
      }
      form div+div{
        margin-top:1em;
      }
      label{
        display:inline-block;
        width:100px;
        text-align:right;
      }
      input,textarea{
        font:1em sans-serif;
        width:400px;
        box-sizing:border-box;
        border:1px solid #999;
      }
      input:focus,textarea:focus{
        border-color:#000;
      }
      textarea{
        vertical-align:top;
        height:5em;
      }
      .button{
        padding-left:40px;
      }
      button{
        margin-left:.5em;
      }
    </style>
  </head>
  <body>
    <h1>浙江大学图书管理系统</h1>
    <img src="images/zju.png" alt="The Zhejiang University logo.">
	
	<form action="page.php" method="post">
      <div>
        <label for="ad_id">帐号:</label>
        <input type="text" name="ad_id"/>
      </div>
      <div>
        <label for="password">密码:</label>
        <input type="password" name="password"/>
      </div>
	    <div class="button">
        <button type="submit" name="loginbutton">登录</button>
	  </div>
	</form>
    <form action="index.php" method="post">
	  <div>
	    <label for="select1">查询信息:</label>
		<input type="text" name="select1"/>
	  </div>
	  <div>
	    <label for="select2","select3">查询出版年份:</label>
		<input type="number" name="select2"/>
		<input type="number" name="select3"/>
	  </div>
	  <div>
	    <label for="price1","price2">查询价格:</label>
		<input type="number" name="price1"/>
		<input type="number" name="price2"/>
	  </div>
	  <div>
	    <label for="select_att">指定属性排序:</label>
		<input type="text" name="select_att"/>
	  </div>
	  <p>（默认按title排序，或输入指定属性排序，如category，press，year，author，price）</p>
	  <div class="button">
	  <button type="submit" name="selectbutton">查询</button>
	  </div>
    </form>
	<?php
	  header("Content-type: text/html; charset=gb2312");
	  $conn=mysqli_connect("localhost:3308","root","","library");
	  if(!$conn){
		  die("连接错误：".mysqli_connect_error());
	  }
	  mysqli_query($conn,"set character gb2312");
	  $length=5; 
	  $offset=0;
	  if(empty($_GET['offset'])){
		$offset=0;
	  }
	  else{
	   $offset=$_GET['offset'];
	  }
	    
	  if(!empty($_GET['select1'])||!empty($_GET['select2'])||!empty($_GET['select3'])||!empty($_GET['price1'])||!empty($_GET['price2'])){
		  $select1=$_GET['select1'];
		  $select2=$_GET['select2'];
		  $select3=$_GET['select3'];
		  $price1=$_GET['price1'];
		  $price2=$_GET['price2'];
		  $select_att=$_GET['select_att'];
	  }
	  if(isset($_POST['select1'])||isset($_POST['select2'])||isset($_POST['select3'])||isset($_POST['price1'])||isset($_POST['price2'])||isset($_POST['select_att'])){
		  $select1=$_POST['select1'];
		  $select2=$_POST['select2'];
		  $select3=$_POST['select3'];
		  $price1=$_POST['price1'];
		  $price2=$_POST['price2'];
		  $select_att=$_POST['select_att'];
	  } 
	  if(isset($_POST['selectbutton'])){
		  if(empty($_POST['select1'])&&empty($_POST['select2'])&&empty($_POST['select3'])&&empty($_POST['price1'])&&empty($_POST['price2'])&&empty($_POST['select_att'])){
		    $select2=0;
		    $select3=3000;
	      }
	  }
	  if(!empty($select1)||!empty($select2)||!empty($select3)||!empty($price1)||!empty($price2)){
		  if(empty($select3)){
			$select3=3000;
		  }
		  if(empty($select2)){
			$select2=0;
		  }
		  if(empty($price1)){
			$price1=0;
		  }
		  if(empty($price2)){
			$price2=30000;
		  }
		  if(empty($select_att)){
			$select_att='title';
		  }
		  if(empty($select1)){
			$sql="SELECT*FROM (select*from book where year>='{$select2}' and year<='{$select3}')a natural join (select*from book where price>='{$price1}' and price<='{$price2}')b order by $select_att limit {$offset},{$length}";
		  }
		  else{
			$sql="SELECT*FROM (select*from book where category='{$select1}' or title='{$select1}' or press='{$select1}' or author='{$select1}')c natural join (select*from book where year>='{$select2}' and year<='{$select3}')a natural join (select*from book where price>='{$price1}' and price<='{$price2}')b order by $select_att limit {$offset},{$length}";
		  }		
		  
		  //limit要求参数   
		  $pagenum=@$_GET['page']?$_GET['page']:1;  
		  
		  //数据总行数  
		  //$sqltot="select count(*) from $sql";  
		  //$sqltot=mysqli_query($conn,$sql);
		  $arrtot=mysqli_fetch_row(mysqli_query($conn,$sql)); 
		  $pagetot=ceil($arrtot[0]/$length);  
	  
		  //限制页数  
		  if($pagenum>=$pagetot){  
			$pagenum=$pagetot;  
		  }  
		  
		  $res=mysqli_query($conn,$sql);
			if(mysqli_num_rows($res)>0){
				echo"<br>查询结果：<br>";
				echo"<table border=1>";
				echo"<tr><td  bgcolor=#A9A9A9>bno</td><td bgcolor=#A9A9A9>category</td><td bgcolor=#A9A9A9>title</td><td bgcolor=#A9A9A9>press</td><td bgcolor=#A9A9A9>year</td><td bgcolor=#A9A9A9>author</td><td bgcolor=#A9A9A9>price</td><td bgcolor=#A9A9A9>total</td><td bgcolor=#A9A9A9>stock</td></tr>";
				while($row=mysqli_fetch_assoc($res)){
					echo"<tr>";
					echo"<td>".$row['bno']."</td>";
					echo"<td>".$row['category']."</td>";
					echo"<td>".$row['title']."</td>";
					echo"<td>".$row['press']."</td>";
					echo"<td>".$row['year']."</td>";
					echo"<td>".$row['author']."</td>";
					echo"<td>".$row['price']."</td>";
					echo"<td>".$row['total']."</td>";
					echo"<td>".$row['stock']."</td>";
					echo"</tr>";
				}
				echo"</table>";
				
				//计算上一页和下一页  
				$prevpage=$pagenum-1;  
				$nextpage=$pagenum+1; 
				if($prevpage==0){
					$prevpage=1;
				}
				if($nextpage>=$pagetot){
					$nextpage=$pagenum;
				}
				echo "<p><a href='index.php?page=$prevpage&offset=".(($pagenum-1)*$length)."&select1=$select1&select2=$select2&select3=$select3&price1=$price1&price2=$price2&select_att=$select_att'>上一页</a><a href='index.php?page=$nextpage&offset=".($pagenum*$length)."&select1=$select1&select2=$select2&select3=$select3&price1=$price1&price2=$price2&select_att=$select_att'>下一页</a></p>";  
				
				/*while($row=mysqli_fetch_assoc($res)){
					echo"bno:".$row["bno"]."--category:".$row["category"]."--title:".$row["title"]."--press:".$row["press"]."--year:".$row["year"]."--author:".$row["author"]."--price:".$row["price"]."--total:".$row["total"]."--stock:".$row["stock"]."<br>";
				}*/
			}
			else{
				echo"0结果";
			}
	  }
	  mysqli_close($conn);
    ?>
  </body>
</html>