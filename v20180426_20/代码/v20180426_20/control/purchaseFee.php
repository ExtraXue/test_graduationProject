<?php
/**
 * Created by PhpStorm.
 * User: 67569
 * Date: 2018/4/26
 * Time: 14:30
 */

session_start();
require_once ('pdo.php');
date_default_timezone_set('PRC');
$uid=$_GET['uid'];
$sqlGetFeeInfo="select * from user_fee_info where uid='{$uid}'";
$rsGetFeeInfo=$pdo->query($sqlGetFeeInfo);
$resultGetFeeInfo=$rsGetFeeInfo->fetch(PDO::FETCH_ASSOC);
$nowDate=date('Y-m-d H:i:s');

if($resultGetFeeInfo['purchase_status']=='1'){
    $sqlUpdatePurchaseStatus="update user_fee_info set purchase_status = '2',purchase_time= '{$nowDate}',status_chg_time = '{$nowDate}' where uid = '{$uid}'";
    $pdo->exec($sqlUpdatePurchaseStatus);
    header("Location:userinfo.php");
    exit();
}?>