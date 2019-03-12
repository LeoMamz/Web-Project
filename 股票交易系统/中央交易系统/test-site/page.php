<!DOCTYPE html>
<?php
	Session_Start();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<link href="styles/style_page.css" rel="stylesheet" type="text/css">
	<title>Login test page</title>
</head>
<body>
	<?php
		if($_SESSION['value']==1){
			header("Content-type: text/html; charset=utf8");
			$conn=mysqli_connect("localhost:3308","root","","library");
			if(!$conn){
				die("连接错误：".mysqli_connect_error());
			}
			$ad_id=$_POST['ad_id'];
			$password=$_POST['password'];
			$_SESSION['admin']=$_POST['ad_id'];
			if($ad_id==""||$password==""){
				echo"<script>alert('请输入帐号和密码');window.location.replace(document.referrer);</script>";
			}
			else{
				$selsql="select ad_id,password from administrators where ad_id='$ad_id'";
				$selres=mysqli_query($conn,$selsql);
				$selrow=mysqli_fetch_assoc($selres);
				if($selrow['ad_id']==$ad_id){
					if($selrow['password']==$password){
						echo"<script>alert('登录成功！');</script>";
					}
					else{
						echo"<script>alert('密码错误');window.location.replace(document.referrer);</script>";
					}
				}
				else{
					echo"<script>alert('用户不存在');window.location.replace(document.referrer);</script>";
				}
			}
			mysqli_close($conn);
			$_SESSION['value']=0;
		}
	?>
	<h1>Hello, <?php echo $_SESSION['admin']?> !</h1>
	<form action="index.php" method="post">
	  <div class="button">
	  <button type="subject">注销</button>
	  </div>
	</form>
	<form action="page.php" method="post">
	  <div>
	    <br>
	    <h2>查询借阅记录</h2>
	  </div>
      <div>
        <label for="cno">输入借书证号:</label>
        <input type="text" name="cno"/>
      </div>
	  <div>
	    <label for="select_att">指定属性排序:</label>
		<input type="text" name="select_att"/>
	  </div>
	  <p>(默认按title排序，或输入指定属性排序，如category，press，year，author，price)</p>
	  <div class="button">
	  <button type="submit" name="selbutton">查询</button>
	  </div>
	  
	  <div>
	    <br>
	    <h2>借书</h2>
	  </div>
	  <div>
        <label for="cno1">输入借书证号:</label>
        <input type="text" name="cno1"/>
      </div>
      <div>
        <label for="bno1">输入借书书号:</label>
        <input type="text" name="bno1"/>
      </div>
	    <div class="button">
        <button type="submit" name="bor_but">借书</button>
	  </div>
	  
	  <div>
	    <br>
	    <h2>还书</h2>
	  </div>
	  <div>
        <label for="cno2">输入借书证号:</label>
        <input type="text" name="cno2"/>
      </div>
      <div>
        <label for="bno2">输入还书书号:</label>
        <input type="text" name="bno2"/>
      </div>
	    <div class="button">
        <button type="submit" name="ret_but">还书</button>
	  </div>
	  
	  <div>
	    <br>
	    <h2>图书入库</h2>
	  </div>
	  <div>
	    <label for="insert_one">单本入库(属性间用,隔开):</label>
		<input type="text" name="insert_one"/>
	  </div>
	  <div class="button">
	  <button type="submit" name="ins_one_but">执行</button>
	  </div>
	  <p>批量入库的图书信息放在data.txt中</p>
	  <div class="button">
	  <button type="submit" name="ins_man_but">批量入库</button>
	  </div>
	  
	  <div>
	    <br>
		<h2>借书证管理</h2>
	  </div>
	  <div>
	    <label for="insert_card">添加借书证(属性间用,隔开):</label>
		<input type="text" name="insert_card"/>
	  </div>
	  <div class="button">
	  <button type="submit" name="ins_card_but">添加</button>
	  </div>
	  <div>
	    <label for="delete_card">删除借书证(输入借书证号):</label>
		<input type="text" name="delete_card"/>
	  </div>
	  <div class="button">
	  <button type="submit" name="del_card_but">删除</button>
	  </div>
	</form>
	<?php
		header("Content-type: text/html; charset=utf8");
		$conn=mysqli_connect("localhost:3308","root","","library");
		if(!$conn){
		    die("连接错误：".mysqli_connect_error());
		}
		if(isset($_POST['bor_but'])){
			$cno1=$_POST['cno1'];
			$bno1=$_POST['bno1'];
			if(!empty($cno1)&&!empty($bno1)){
				$sql_card_bor="select*from card where cno='{$cno1}'";
				if(mysqli_num_rows(mysqli_query($conn,$sql_card_bor))){
					$cousql_bor="select stock from book where bno='{$bno1}'";
					$count_sto=mysqli_query($conn,$cousql_bor);
					$row_sto=mysqli_fetch_assoc($count_sto);
					$count_bor=$row_sto["stock"];
					$ad_id1=$_SESSION['admin'];
					if($count_bor>0){
						$count_bor--;
						$updsql_bor="update book set stock='{$count_bor}' where bno='{$bno1}'";
						mysqli_query($conn,$updsql_bor);
						$inssql_bor="insert into borrow values('{$cno1}','{$bno1}','2018-5-8',null,'{$ad_id1}')";
						mysqli_query($conn,$inssql_bor);
						echo"<div id='absolute'>借书成功！</div> <br>";
					}
					else{
						echo"<div id='absolute'>该书无库存!</div>";
						$selmax_bor="select max(timestamp(return_date)) from borrow where bno='{$bno1}'";
						$selmaxres_bor=mysqli_query($conn,$selmax_bor);
						if(mysqli_num_rows($selmaxres_bor)){
							$row_tim=mysqli_fetch_assoc($selmaxres_bor);
							if($row_tim["max(timestamp(return_date))"]!=NULL){
								echo"<div id='normal'>该书最近归还时间为：" .$row_tim["max(timestamp(return_date))"]."</div>";
							}
							else{
								echo"<div id='normal'>该书尚无归还记录！</div>";
							}
						}
					}
				}
				else{
					echo"<div id='absolute'>该借书证不存在！</div>";
				}
			}
		}
		else if(isset($_POST['ret_but'])){
			$cno2=$_POST['cno2'];
			$bno2=$_POST['bno2'];
			if(!empty($cno2)&&!empty($bno2)){
				$sql_card_ret="select*from card where cno='{$cno2}'";
				if(mysqli_num_rows(mysqli_query($conn,$sql_card_ret))){
					$selsql_ret="select*from book where bno in (select bno from borrow where cno='{$cno2}' and return_date is null)";
					$selres_ret=mysqli_query($conn,$selsql_ret);
					if(mysqli_num_rows($selres_ret)>0){
						$cousql_ret="select total,stock from book where bno='{$bno2}'";
						$count_sto_ret=mysqli_query($conn,$cousql_ret);
						$row_sto_ret=mysqli_fetch_assoc($count_sto_ret);
						$count_ret=$row_sto_ret["stock"];
						$count_ret_tot=$row_sto_ret["total"];
						if($count_ret<$count_ret_tot){
							$count_ret++;
							$updsql_ret="update book set stock='{$count_ret}' where bno='{$bno2}'";
							mysqli_query($conn,$updsql_ret);
							$altsql_ret="update borrow set return_date='2018-5-9' where bno='{$bno2}' and cno='{$cno2}'";
							mysqli_query($conn,$altsql_ret);
							echo"<div id='absolute'>还书成功！</div>";
						}
						else{
							echo"<div id='absolute'>还书失败！未找到相应的借阅记录！</div>";
						}
					}
					else{
						echo"<div id='absolute'>还书失败！未找到相应的借阅记录！</div>";
					}
				}
				else{
					echo"<div id='absolute'>该借书证不存在！</div>";
				}
			}
		}
		else if(isset($_POST['selbutton'])||!empty($_GET['cno'])){
			mysqli_query($conn,"set character utf8");
			$length=5; 
			$offset2=0;
			if(isset($_POST['cno'])){
				$cno=$_POST['cno'];
				$select_att=$_POST['select_att'];
			}
			if(empty($_GET['offset2'])){
				$offset2=0;
			}
			else{
			   $offset2=$_GET['offset2'];
			}  
			if(!empty($_GET['cno'])){
				$cno=$_GET['cno'];
			    $select_att=$_GET['select_att'];
			}
			  
			if(empty($select_att)){
				$select_att='title';
			}
			if(!empty($cno)){
				$sql_card="select*from card where cno='{$cno}'";
				if(mysqli_num_rows(mysqli_query($conn,$sql_card))){
					$selsql_sel="select*from book where bno in (select bno from borrow where cno='{$cno}') order by $select_att limit {$offset2},{$length}";
					
					//limit要求参数   
					$pagenum2=@$_GET['page2']?$_GET['page2']:1;  
					  
					//数据总行数  
					//$selsqltot="select count(*) from $selsql_sel";  
					$arrtot_sel=mysqli_fetch_row(mysqli_query($conn,$selsql_sel)); 
					$pagetot_sel=ceil($arrtot_sel[0]/$length);  
				  
					//限制页数  
					if($pagenum2>=$pagetot_sel){  
						$pagenum2=$pagetot_sel;  
					}  
			  
					$selres_sel=mysqli_query($conn,$selsql_sel);
					if(mysqli_num_rows($selres_sel)>0){
						echo"<div id='absolute'>查询结果：</div>";
						echo"<table border=1 id='normal'>";
						echo"<tr><td  bgcolor=#A9A9A9>bno</td><td  bgcolor=#A9A9A9>category</td><td  bgcolor=#A9A9A9>title</td><td  bgcolor=#A9A9A9>press</td><td  bgcolor=#A9A9A9>year</td><td  bgcolor=#A9A9A9>author</td><td  bgcolor=#A9A9A9>price</td><td  bgcolor=#A9A9A9>total</td><td  bgcolor=#A9A9A9>stock</td></tr>";
						while($row=mysqli_fetch_assoc($selres_sel)){
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
						$prevpage2=$pagenum2-1;  
						$nextpage2=$pagenum2+1; 
						if($prevpage2==0){
							$prevpage2=1;
						}
						if($nextpage2>=$pagetot_sel){
							$nextpage2=$pagenum2;
						}
						echo "<p id='pstyle'><a href='page.php?page2=$prevpage2&offset2=".(($pagenum2-1)*$length)."&cno=$cno&select_att=$select_att'>上一页 </a><a href='page.php?page2=$nextpage2&offset2=".($pagenum2*$length)."&cno=$cno&select_att=$select_att'>下一页</a></p>";  
						
						/*while($row=mysqli_fetch_assoc($selres_sel)){
							echo"bno:".$row["bno"]."--category:".$row["category"]."--title:".$row["title"]."--press:".$row["press"]."--year:".$row["year"]."--author:".$row["author"]."--price:".$row["price"]."--total:".$row["total"]."--stock:".$row["stock"]."<br>";
						}*/
					}
					else{
						echo"<div id='absolute'>0结果</div>";
					}
				}
				else{
					echo"<div id='absolute'>该借书证不存在！</div>";
				}
			}
		}
		else if(isset($_POST['ins_one_but'])){
			$insert_one=$_POST['insert_one'];
			$content=explode(",",$insert_one);
			$ins_one_res=mysqli_query($conn,"insert into book values('{$content[0]}','{$content[1]}','{$content[2]}','{$content[3]}','{$content[4]}','{$content[5]}','{$content[6]}','{$content[7]}','{$content[7]}')");
			if($ins_one_res){
				echo"<div id='absolute'>入库成功！</div>";
			}
			else{
				echo"<div id='absolute'>入库失败！</div>";
			}
		}
		else if(isset($_POST['ins_man_but'])){
			function InsertTxtDataIntoDatabase($split_char,$file,$table,$conn,$fields=array()){
				if(empty($fields)){
					$head="insert into '{$table}' values('";
				}
				else{
					$head="insert into {$table}(".implode(",",$fields).") values('";
				}
				$end="')";
				$sqldata=trim(file_get_contents($file));
				if(preg_replace('/\s*/i','',$split_char)==''){
					$split_char='/(\w+)(\s+)/i';
					$replace="$1','";
					$special_func='preg_replace';
				}
				else{
					$split_char=$split_char;
					$replace="','";
					$special_func='str_replace';
				}
				$sqldata=preg_replace('/(\s*)(\n+)(\s*)/i','\'),(\'',$sqldata);
				$sqldata=$special_func($split_char,$replace,$sqldata);
				$sqldata=$special_func(")','(","),(",$sqldata);
				$query=$head.$sqldata.$end;
				if(mysqli_query($conn,$query)){
					return array(true);
				}
				else{
					return array(false,mysqli_error($conn),mysqli_errno($conn));
				}
			}
			$split_char=',';
			$file='data.txt';
			$fields=array('bno','category','title','press','year','author','price','total','stock');
			$table='book';
			$result=InsertTxtDataIntoDatabase($split_char,$file,$table,$conn,$fields);
			if(array_shift($result)){
				echo"<div id='absolute'>入库成功！</div>";
			}
			else{
				echo"<div id='absolute'>入库失败! <br>Error: ".array_shift($result)."</div>";
			}
		}
		else if(isset($_POST['ins_card_but'])){
			$insert_card=$_POST['insert_card'];
			$content_card=explode(",",$insert_card);
			$inssql_card="select*from card where cno='{$content_card[0]}'";
			$inssql_card_con="insert into card values('{$content_card[0]}','{$content_card[1]}','{$content_card[2]}','{$content_card[3]}')";
			$insres_card=mysqli_query($conn,$inssql_card);
			if(mysqli_num_rows($insres_card)>0){
				echo"<div id='absolute'>添加失败！该借书证已存在！</div>";
			}
			else{
				mysqli_query($conn,$inssql_card_con);
				echo"<div id='absolute'>添加成功！</div>";
			}
		}
		else if(isset($_POST['del_card_but'])){
			$delete_card=$_POST['delete_card'];
			$delsql="select*from borrow where cno='{$delete_card}' and return_date is null";
			$delsql_card="select*from card where cno='{$delete_card}'";
			$delres_card=mysqli_query($conn,$delsql_card);
			$delres=mysqli_query($conn,$delsql);
			if(mysqli_num_rows($delres)>0){
				echo"<div id='absolute'>删除失败！该借书证尚有图书未归还！</div>";
			}
			else if(mysqli_num_rows($delres_card)>0){
				mysqli_query($conn,"delete from card where cno='{$delete_card}'");
				echo"<div id='absolute'>删除成功！</div>";
			}
			else{
				echo"<div id='absolute'>删除失败！未找到该借书证！</div>";
			}
		}
		mysqli_close($conn);
	?>
</body>
</html>