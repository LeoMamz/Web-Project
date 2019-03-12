<?php
	$con = mysqli_connect("localhost:3306","root","mamz","SEWeb");
    if (!$con){
        die('Could not connect: ' . mysqli_error());
    }
    mysqli_query($con , "set names utf8");
    $uid1="2333";
    $uname1="姜则旻";
    $pwd1=password_hash('123456', PASSWORD_BCRYPT);
    $t1="s";

    $uid2="9999";
    $uname2="茅则冬";
    $pwd2=password_hash('123456', PASSWORD_BCRYPT);
    $t2="t";

    $uid3="8888";
    $uname3="某某某";
    $pwd3=password_hash('123456', PASSWORD_BCRYPT);
    $t3="s";

    $uid4="1111";
    $uname4="灯晓萍";
    $pwd4=password_hash('123456', PASSWORD_BCRYPT);
    $t4="t";

    $cid="0100";
    $cname="软件工程杂烩";

    mysqli_query($con,"INSERT INTO myuser values ('".$uid1."','".$uname1."','".$pwd1."','".$t1."',NULL)");
    mysqli_query($con,"INSERT INTO myuser values ('".$uid2."','".$uname2."','".$pwd2."','".$t2."',NULL)");
    mysqli_query($con,"INSERT INTO myuser values ('".$uid3."','".$uname3."','".$pwd3."','".$t3."',NULL)");
    mysqli_query($con,"INSERT INTO myuser values ('".$uid4."','".$uname4."','".$pwd4."','".$t4."',NULL)");

    mysqli_query($con,"INSERT INTO course values ('".$cid."','".$cname."',NULL)");

    mysqli_query($con,"INSERT INTO coursestudent values ('".$cid."','".$uid1."',NULL)");

    mysqli_query($con,"INSERT INTO courseteacher values ('".$cid."','".$uid2."')");
    mysqli_query($con,"INSERT INTO courseteacher values ('".$cid."','".$uid4."')");
?>