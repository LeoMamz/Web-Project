
<?php
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
$oldPwd = $newPwd1 = $newPwd2 ="";
$state=0;
$url  = "http://localhost/Administration/Client_interface/account";
$postType = 2;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPwd = test_input($_POST["oldPwd"]);
    $newPwd1 = test_input($_POST["newPwd1"]);
    $newPwd2 = test_input($_POST["newPwd2"]);
    $state=1;
    $data = json_encode(array('type'=>$postType, 'user'=>$_COOKIE['user'],'oldPWD'=>$oldPwd, 'newPWD'=>$newPwd1));
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
include "updatepw.php";
if($oldPwd == ""&&$state==1) {
    echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('请输入旧密码');
           </script>";
    $state=0;
}else if($newPwd1==''&&$state==1){
    echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('请输入新密码！');
           </script>";
    $state = 0;
}else if($newPwd2==''&&$state==1){
    echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('请再次输入新密码！');
           </script>";
    $state = 0;
}else if($newPwd2!=''&&$state==1 && $newPwd2!=''&& $oldPwd != ""){
    if($newPwd2 != $newPwd1&&$state==1){
        echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('两次输入的密码不相同！');
           </script>";
        $state = 0;
    }else if((strlen($newPwd1)<6 || strlen($newPwd1) > 18)&&$state==1){
        echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('密码应为6~18位！');
           </script>";
        $state = 0;
    }
    else if($state == 1){
        $jsonReturn = post_data($url, $data);
        $return = json_decode($jsonReturn);
//你返回给我：$return = json_encode(1);
        if($return == 0){
            echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('旧密码输入不正确!');
           </script>";
        }else if($return == 1){
            echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('密码修改成功！');
           </script>";
            setcookie("user", $user, time()+3600);
        }else if($return == 2){
            echo "<script>
           $('.mask,.dialog').show();
		   $('.dialog .dialog-bd p').html('密码修改不成功！');
           </script>";
        }
        $state = 0;
    }
}
