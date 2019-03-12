<?php
if(!isset($_POST['submit'])){
    exit('非法访问!');
}
function post_data($url, $postData) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Content-Length: ' . strlen($postData))
    );
    $return_content = curl_exec($ch);
    curl_close($ch);
    return  $return_content;
}
// define variables and set to empty values
$user = $pwd = "";
$state=0;
$postType = 1;
$url  = "http://localhost/stock/checkUser.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = test_input($_POST["user1"]);
    $pwd = test_input($_POST["pwd1"]);
    $state=1;
    $data = json_encode(array('type'=>$postType, 'userID'=>$user, 'userPWD'=>$pwd));
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
include "login.html";
if($user == ""&&$state==1) {
    echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('请输入账号');
           </script>";
    $state=0;
}else if($pwd==''&&$state==1){
    echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('请输入密码');
           </script>";
    $state = 0;
}else if($state == 1){
    $jsonReturn = post_data($url, $data);
    $return = json_decode($jsonReturn);
    if($return == true){
        setcookie("user", $user, time()+3600);
        header("Location:index.php");
    }else{
        echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('账号不存在或密码不正确');
           </script>";
    }
}

