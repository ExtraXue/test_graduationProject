<?php
/**
 * Created by PhpStorm.
 * User: 67569
 * Date: 2018/4/26
 * Time: 18:41
 */
?>
<?php
error_reporting(E_ALL ^ E_NOTICE); ?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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

$sqlGetDeptInfo = "select * from dept_info";
$rsGetDeptInfo = $pdo->query($sqlGetDeptInfo);
$resultGetDeptInfo = $rsGetDeptInfo->fetchAll(PDO::FETCH_ASSOC);

$sqlGetUserInfo = "select * from user_info a where a.username='{$_SESSION['username']}'";
$rsGetUserInfo = $pdo->query($sqlGetUserInfo);
$resultGetUserInfo = $rsGetUserInfo->fetch(PDO::FETCH_ASSOC);

?>

<body>
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>党费催欠</strong></div>
    <div class="body-content">
     <?php if ($resultGetUserInfo['role_type'] == '0')
        {
        ?>
        <form action="feeHistory.php" method="post">
            <div class="form-group" style="padding-left: 5%;">
                <div class="label" style="float: left;padding-top: 8px;">
                    <label>选择党支部：</label>
                </div>
                <div class="field">
                    <div style="float: left">
                        <select class="input" name="deptId" style="width: 200px" ">
                        <?php
                        foreach ($resultGetDeptInfo as $key => $value) {
                            echo "<option value='$value[dept_id]'>$value[dept_name]</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div>
                        <button class="button bg-yellow " type="submit" style="margin-left: 20px;">
                            查找用户
                        </button>
                    </div>

                </div>
            </div>
        </form>
        <form method="post" class="form-x" action="feeHistory.php">
            <div class="form-group" style="margin-top: 30px;">
                <div class="label">
                    <label>选择用户：</label>
                </div>
                <div class="field">
                    <select class="input" name="userId" style="width: 200px" ">
                    <?php
                    $contents = $_POST['deptId'];
                    $sqlGetUserinfo = "select * from user_info a where a.dept_id='$contents'";
                    $rs = $pdo->query($sqlGetUserinfo);
                    $result = $rs->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $key => $valueUser) {
                        echo "<option value='$valueUser[id]'>$valueUser[username]</option>";
                    }
                    ?>
                    </select>
                </div>
            </div>
            <div class="form-group ">
                <div class="label">
                    <!--                此div做格式化用无实际意义-->
                </div>
                <div class="field" style="padding-top: 20px;">
                    <button class="button bg-main icon-check-square-o" type="submit">查询</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
$userId = $_POST['userId'];

$sqlGetFeeInfo = "select * from user_fee_info where user_id = '{$userId}' order by purchase_time desc";
$rsGetFeeInfo = $pdo->query($sqlGetFeeInfo);
$resultGetFeeInfo = $rsGetFeeInfo->fetch(PDO::FETCH_ASSOC);

foreach ($pdo->query($sqlGetFeeInfo) as $key => $resultGetFeeInfo) {
    ?>
    <div style="height: 20px"></div>
    <div class="dialog open">
        <div class="dialog-head">
            <span class="dialog-close rotate-hover"></span>
            <strong>用户名：</strong>
            <span style="font-style: italic;color: #C50C11">
                <?php echo "$resultGetFeeInfo[user_name]" ?></span>
            <span style="float: right;font-weight: bold">
            状态变更时间：<?php echo "$resultGetFeeInfo[status_chg_time]"; ?>
            </span>
        </div>
        <div class="dialog-body">缴纳金额：&nbsp;<strong><?php echo "$resultGetFeeInfo[fee_count]" ?></strong>&nbsp;元</div>
        <?php
        if ($resultGetFeeInfo['purchase_status'] == '1') {
            ?>
            <div style="float: right;" class="dialog-body">
                <h1><span class="tag bg-red">未缴费管理员已发通知</span></h1>
            </div>
            <?php
        }
        ?>
        <?php
        if ($resultGetFeeInfo['purchase_status'] == '2') {
            ?>
            <div style="float: right;" class="dialog-body">
                <h1><span class="tag bg-yellow">已缴费待管理员确认</span></h1>
            </div>
            <?php
        }
        ?>
        <?php
        if ($resultGetFeeInfo['purchase_status'] == '3') {
            ?>
            <div style="float: right;" class="dialog-body">
                <h1><span class="tag bg-green">已缴费管理员已确认</span></h1>
            </div>
            <?php
        }
        ?>
        <div class="dialog-body">党费周期：&nbsp;<strong><?php echo "$resultGetFeeInfo[period_begin]" ?></strong>
            &nbsp;至
            &nbsp;<strong><?php echo "$resultGetFeeInfo[period_end]" ?></strong></div>
        <div class="dialog-body">备注：&nbsp;<strong><?php echo "$resultGetFeeInfo[remark]" ?></strong></div>
    </div>
    <?php
}
}
if ($resultGetUserInfo['role_type'] <> '0') {
    $sqlGetFeeInfoTS = "select * from user_fee_info where user_name = '{$_SESSION['username']}' order by purchase_time desc";
    $rsGetFeeInfoTS = $pdo->query($sqlGetFeeInfoTS);
    $resultGetFeeInfoTS = $rsGetFeeInfoTS->fetch(PDO::FETCH_ASSOC);
    foreach ($pdo->query($sqlGetFeeInfoTS) as $key => $resultGetFeeInfoTS) {
        ?>
        <div style="height: 20px"></div>
        <div class="dialog open">
            <div class="dialog-head">
                <span class="dialog-close rotate-hover"></span>
                <strong>用户名：</strong>
                <span style="font-style: italic;color: #C50C11">
                <?php echo "$resultGetFeeInfoTS[user_name]" ?></span>
                <span style="float: right;font-weight: bold">
            状态变更时间：<?php echo "$resultGetFeeInfoTS[status_chg_time]"; ?>
            </span>

            </div>
            <div class="dialog-body">缴纳金额：&nbsp;<strong><?php echo "$resultGetFeeInfoTS[fee_count]" ?></strong>&nbsp;元
            </div>
            <?php
            if ($resultGetFeeInfoTS['purchase_status'] == '1') {
                ?>
                <div style="float: right;" class="dialog-body">
                    <h1><span class="tag bg-red">未缴费管理员已发通知</span></h1>
                </div>
                <?php
            }
            ?>
            <?php
            if ($resultGetFeeInfoTS['purchase_status'] == '2') {
                ?>
                <div style="float: right;" class="dialog-body">
                    <h1><span class="tag bg-yellow">已缴费待管理员确认</span></h1>
                </div>
                <?php
            }
            ?>
            <?php
            if ($resultGetFeeInfoTS['purchase_status'] == '3') {
                ?>
                <div style="float: right;" class="dialog-body">
                    <h1><span class="tag bg-green">已缴费管理员已确认</span></h1>
                </div>
                <?php
            }
            ?>
            <div class="dialog-body">党费周期：&nbsp;<strong><?php echo "$resultGetFeeInfoTS[period_begin]" ?></strong>
                &nbsp;至
                &nbsp;<strong><?php echo "$resultGetFeeInfoTS[period_end]" ?></strong></div>
            <div class="dialog-body">备注：&nbsp;<strong><?php echo "$resultGetFeeInfoTS[remark]" ?></strong></div>
        </div>
        <?php
    }
}
?>


</body>
</html>