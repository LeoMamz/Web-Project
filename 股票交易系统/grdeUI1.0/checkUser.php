<?php
$postData = file_get_contents('php://input');
$re = json_decode($postData);
if($re->userID == '123') {
    $a = json_encode(true);
    echo $a;
}



