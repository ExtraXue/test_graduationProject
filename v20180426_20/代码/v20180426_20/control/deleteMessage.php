<?php
/**
 * Created by PhpStorm.
 * User: HowardXue
 * Date: 2018/4/23
 * Time: 21:04
 */

session_start();
require_once ('pdo.php');

$uid=$_GET['uid'];
$sqlGetMessage="select * from message_board a where a.uid='{$uid}'";

$rsSqlGetMessage=$pdo->query($sqlGetMessage);
$resultSqlGetMessage=$rsSqlGetMessage->fetch(PDO::FETCH_ASSOC);

if($resultSqlGetMessage){
    $sqlDeleteMessage="delete from message_board where uid='{$uid}'";
    $pdo->exec($sqlDeleteMessage);
    echo '<script>alert("删除成功！");location.href="messageBorad.php";</script>';
}else{
    echo '<script>alert("删除失败，请联系管理员");location.href="login.html";</script>';
}
?>
