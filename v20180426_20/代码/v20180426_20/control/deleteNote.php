<?php
/**
 * Created by PhpStorm.
 * User: HowardXue
 * Date: 2018/4/24
 * Time: 18:59
 */

session_start();

require_once('pdo.php');

$uid = $_GET['uid'];
$sqlGetNoteInfo = "select * from note_board where uid='{$uid}'";
$rsGetNoteInfo = $pdo->query($sqlGetNoteInfo);
$resultGetNoteInfo = $rsGetNoteInfo->fetch(PDO::FETCH_ASSOC);

if ($resultGetNoteInfo) {
    $sqlDeleteNote = "delete from note_board where uid = '{$uid}'";
    $pdo->exec($sqlDeleteNote);
    header("Location:noteBoard.php");
    exit();
}