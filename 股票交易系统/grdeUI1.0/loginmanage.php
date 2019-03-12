<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/6/18
 * Time: 17:15
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        echo "sdaf f";
    };
    if (isset($_POST['delete']))  echo $_POST['delete'];
    $user = $_POST[1];
    $pwd = $_POST[2];
    echo $user;
    echo'<br>';
    echo $pwd ;
    session_start();
    $_SESSION['user'] = $user;
    //header("Location:index.php");
}else{
    echo "没有收到";
}


?>