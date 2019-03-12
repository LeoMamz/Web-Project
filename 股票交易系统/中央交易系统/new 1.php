<?php
    header('Access-Control-Allow-Origin:*');//注意！跨域要加这个头 上面那个没有
    $student = $_POST['student'];
    echo $student['name'];
    echo $student['age'];
    echo $student['sex'];
?>