<?php
/**
 * Created by PhpStorm.
 * User: 67569
 * Date: 2018/4/23
 * Time: 19:01
 */

session_start();
date_default_timezone_set('PRC');
require_once ('pdo.php');
$sqlGetUserinfo="select * from user_info where username='{$_SESSION['username']}'";
$rs=$pdo->query($sqlGetUserinfo);
$result=$rs->fetch(PDO::FETCH_ASSOC);

$message=$_POST['message'];
$now_date = date('Y-m-d H:i:s');

if($sqlGetUserinfo){
    $putMessage="insert into message_board  (username, message, create_time) 
    values ('{$_SESSION['username']}','{$message}','$now_date')";

    $pdo->exec($putMessage);

    header('Location:messageBorad.php');
}