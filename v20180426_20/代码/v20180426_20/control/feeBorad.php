<?php
/**
 * Created by PhpStorm.
 * User: HowardXue
 * Date: 2018/4/26
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="renderer" content="webkit">
    <title></title>
    <link rel="stylesheet" href="css/pintuer.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/jquery.js"></script>
    <script src="js/pintuer.js"></script>
    <title>党费缴纳历史</title>
</head>

<?php
session_start();
header('Content-type:text/html;charset=utf8');
require_once('pdo.php');
$sqlGetUserinfo = "select * from user_info a where a.username='{$_SESSION['username']}'";
$rs = $pdo->query($sqlGetUserinfo);
$result = $rs->fetch(PDO::FETCH_ASSOC);
?>

<body>
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>党费缴纳历史</strong></div>
    <div class="body-content">
        <?php
        $sqlGetFeeInfo="select * from user_fee_info where purchase_status ='2'";
        $rsGetFeeInfo=$pdo->query($sqlGetFeeInfo);
        $resultGetFeeInfo=$rsGetFeeInfo->fetchAll(PDO::FETCH_ASSOC);
        foreach ($pdo->query($sqlGetFeeInfo) as $key => $resultGetFeeInfo) {
            ?>
            <div style="height: 20px"></div>
            <div class="dialog open">
                <div class="dialog-head">
                    <span class="dialog-close rotate-hover"></span>
                    <strong>用户：</strong>
                    <span style="font-style: italic;color: #C50C11">
                <?php echo "$resultGetFeeInfo[user_name]" ?></span>
                    <span style="float: right;font-weight: bold">
            <?php echo "$resultGetFeeInfo[purchase_time]"; ?>
            </span>
                    <?php
                    if ($result['role_type'] == '0') {
                        ?>
                        <!--获取UID-->
                        <a href="feeFinishCheck.php?uid=<?= $resultGetFeeInfo['uid'] ?>"
                           class="button button-little bg-green" style="padding: 5px 10px;margin-left: 10px;" onclick="return confirm('确认已经补交了党费？');">
                            <span class="icon-power-off">确认已交</span></a>
                        <?php
                    } ?>
                </div>
                <div class="dialog-body"><strong style="font-size: 16px;">缴纳金额：</strong><?php echo "$resultGetFeeInfo[fee_count]" ?>&nbsp;元</div>
            </div>
            <?php
        }
        ?>
    </div>


</div>
<p></p>


</body>
</html>
