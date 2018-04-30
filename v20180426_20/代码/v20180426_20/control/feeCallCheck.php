<?php
/**
 * Created by PhpStorm.
 * User: 67569
 * Date: 2018/4/26
 * Time: 12:18
 */

session_start();
date_default_timezone_set('PRC');
require_once ('pdo.php');
$userId = $_POST['userId'];
$feeCount=$_POST['feeCount'];
$periodBegin=$_POST['periodBegin'];
$periodEnd=$_POST['periodEnd'];
$remark=$_POST['remark'];
$nowDate=date('Y-m-d H:i:s');


$sqlGetFeeInfo="select * from user_fee_info a";
$rsGetFeeInfo=$pdo->query($sqlGetFeeInfo);
$resultGetFeeInfo=$rsGetFeeInfo->fetch(PDO::FETCH_ASSOC);

$sqlGetUserInfo="select * from user_info a where a.id='$userId'";
$rsGetUserInfo=$pdo->query($sqlGetUserInfo);
$resultGetUserInfo=$rsGetUserInfo->fetch(PDO::FETCH_ASSOC);



//缴纳状态：1：已通知，2：用户已缴纳，3：管理员已确认
if($resultGetUserInfo){
    $sqlSendFeeCall="insert into user_fee_info (user_id, user_name,send_time, period_begin, period_end, purchase_status,status_chg_time,remark) 
VALUES ('{$userId}','{$resultGetUserInfo['username']}','{$feeCount}','{$periodBegin}','{$periodEnd}','1','{$nowDate}','{$remark}')";
    $pdo->exec($sqlSendFeeCall);
    header("Location:feeCall.php");
}


