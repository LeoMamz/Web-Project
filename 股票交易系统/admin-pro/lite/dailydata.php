<?php
ignore_user_abort();
set_time_limit(0);
$interval=86400;
while(true)
{   
    $date=date('Y-m-d',time());
    $end_time=strtotime($Date."15:30"."00");
    $current_time=time();
    if($current_time==$end_time)
    {   
        $conn = new mysqli("localhost","root","123456");
        if(mysqli_errno($conn)){
            echo mysqli_errno($conn);
            exit;
        }
        mysqli_select_db($conn,"stock");//
        mysqli_set_charset($conn,'utf8');
        $sql="select stock_name from message";
        $res=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_row($res)){ 
            $sql1="select max(trans_price) from tran where stock_name='$row[0]'";
            $res1=mysqli_query($conn,$sql1);
            $max=mysqli_result($res1,0);
            $sql2="select min(trans_price) from tran where stock_name='$row[0]'";
            $res2=mysqli_query($conn,$sql2);
            $min=mysqli_result($res2,0);
            $sql3="select sum(trans_price) from tran where stock_name='$row[0]'and '$end_time'-time<=86400";
            $res3=mysqli_query($conn,$sql3);
            $num=mysqli_result($res3,0);
            $sql4="select *from(select trans_price from tran where stock_name='$row[0]' order by time desc) where rownum=1";
            $res4=mysqli_query($conn,$sql4);
            $close_price=mysqli_result($res4,0);
            $sql5="select *from(select time from trans where stock_name='$row[0]' order by time desc) where rownum=1";
            $res5=mysqli_query($conn,$sql5);
            $date=date("Y-m-d",mysqli_result($res4,0));
            $sql6="insert into daily_info values('$row[0],'$close_price','$max','$min','$num','$date')";
            $res6=mysqli_query($conn,$sql6);
        }
        sleep($interval);
    }
}
?>