<?php
$postData = file_get_contents('php://input');
$re = json_decode($postData);
if($re->b==2)
    var_dump($re);
echo $re->a;
