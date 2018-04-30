<?php
/**
 * Created by PhpStorm.
 * Author: HowardXue
 * Date: 2018/4/24
 */

session_start();
date_default_timezone_set('PRC');
require_once ('pdo.php');

$noteType=$_POST['noteType'];
$sendTarget=$_POST['sendTarget'];
$noteTitle=$_POST['noteTitle'];
$noteContent=$_POST['noteContent'];
$nowDate=date('Y-m-d H:i:s');

$sqlGetUserinfo="select * from user_info";
$rs=$pdo->query($sqlGetUserinfo);
$result=$rs->fetch(PDO::FETCH_ASSOC);

//发送给全体教师
if($sendTarget=='allTeacher'){
    $sqlGetUserInfoT="select * from user_info where role_type='2'";
    $rsGetUserInfoT=$pdo->query($sqlGetUserInfoT);
    $resultGetUserInfoT=$rsGetUserInfoT->fetchAll(PDO::FETCH_ASSOC);
    foreach ($pdo->query($sqlGetUserInfoT) as $key=> $resultGetUserInfoT){
        $putNote="insert into note_board (note_title, note_content, admin_name, create_time, send_target, note_type)
values ('{$noteTitle}','{$noteContent}','{$_SESSION['username']}','{$nowDate}','{$resultGetUserInfoT['id']}','{$noteType}')";
        $pdo->exec($putNote);
    }
    echo('<script>alert("通知发送成功");history.back();</script>');
}
//发送给全体学生
if($sendTarget=='allStudent'){
    $sqlGetUserInfoS="select * from user_info where role_type='1'";
    $rsGetUserInfoS=$pdo->query($sqlGetUserInfoS);
    $resultGetUserInfoS=$rsGetUserInfoS->fetchAll(PDO::FETCH_ASSOC);
    foreach ($pdo->query($sqlGetUserInfoS) as $key=> $resultGetUserInfoS){
        $putNote="insert into note_board (note_title, note_content, admin_name, create_time, send_target, note_type)
values ('{$noteTitle}','{$noteContent}','{$_SESSION['username']}','{$nowDate}','{$resultGetUserInfoS['id']}','{$noteType}')";
        $pdo->exec($putNote);
    }
    echo('<script>alert("通知发送成功");history.back();</script>');
}
//发送给党支部
if($sendTarget <> 'allStudent' && $sendTarget <> 'allStudent'){
    $sqlGetUserInfoD="select * from user_info where dept_id = '{$sendTarget}'";
    $rsGetUserInfoD=$pdo->query($sqlGetUserInfoD);
    $resultGetUserInfoD=$rsGetUserInfoD->fetchAll(PDO::FETCH_ASSOC);
    foreach ($pdo->query($sqlGetUserInfoD) as $key=> $resultGetUserInfoD){
        $putNote="insert into note_board (note_title, note_content, admin_name, create_time, send_target, note_type)
values ('{$noteTitle}','{$noteContent}','{$_SESSION['username']}','{$nowDate}','{$resultGetUserInfoD['id']}','{$noteType}')";
        $pdo->exec($putNote);
    }
    echo('<script>alert("通知发送成功");history.back();</script>');
}



