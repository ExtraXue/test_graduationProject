<?php
/**
 * Created by PhpStorm.
 * Author: Howard
 * Date: 2018/4/25
 * Time: 14:58
 */

session_start();
require_once ('pdo.php');

$uid=$_GET['uid'];
$sqlGetNoteInfo="select * from note_board where uid='{$uid}'";
$rsGetNoteInfo=$pdo->query($sqlGetNoteInfo);
$resultGetNoteInfo=$rsGetNoteInfo->fetch(PDO::FETCH_ASSOC);

if($sqlGetNoteInfo){
    $sqlUpdateNote="update note_board set is_read = '1' where uid = '{$uid}'";
    $pdo->exec($sqlUpdateNote);
    header("Location:noteBoard.php");
    exit();
}