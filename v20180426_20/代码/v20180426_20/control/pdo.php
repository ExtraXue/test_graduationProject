<?php
//数据库连接复用脚本
header('Content-type:text/html;charset=utf8');
try{
    $dsn="mysql:host=localhost;dbname=2018";
    $pdo=new PDO($dsn,'root','root');
}catch(PDOException $e){
    echo '数据库连接失败！失败原因为：'.$e->getMessage();
}
$pdo->query('set names utf8');

?>
