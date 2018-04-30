<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="renderer" content="webkit">
    <title>管理界面首页-用户信息</title>
    <link rel="stylesheet" href="css/pintuer.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/jquery.js"></script>
    <script src="js/pintuer.js"></script>
</head>
<?php
session_start();
require_once('pdo.php');
$sql = "select * from user_info where username='{$_SESSION['username']}'";
$rs = $pdo->query($sql);
$result = $rs->fetch(PDO::FETCH_ASSOC);


$get_dept = "select * from dept_info where dept_id='{$result['dept_id']}'";
$rs_dept = $pdo->query($get_dept);
$result_dept = $rs_dept->fetch(PDO::FETCH_ASSOC);

$sqlGetFeeInfo = "select * from user_fee_info a where a.user_name='{$_SESSION['username']}'";
$rsGetFeeInfo = $pdo->query($sqlGetFeeInfo);
$resultGetFeeInfo = $rsGetFeeInfo->fetch(PDO::FETCH_ASSOC);

switch ($result['role_type']) {
    case "0":
        $result['role_type'] = "管理员";
        break;
    case "1":
        $result['role_type'] = "教师";
        break;
    case "2":
        $result['role_type'] = "学生";
        break;
    default:
        $result['role_type'] = "未知";
        break;
}

?>

<body>
<div class="panel admin-panel">
    <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 个人信息</strong></div>
    <div class="body-content" style="padding:30px 30px; overflow:hidden; font-size:16px ">
        <div class="form-group"
        ">
        <div class="">
            <label style="text-align: left">用户名称：<strong><?php echo "$result[username]" ?></strong></label>
        </div>
        <p></p>
    </div>
    <div class="form-group">
        <div class="">
            <label>用户角色：<strong><?php echo "$result[role_type]" ?></strong></label>
        </div>
        <p></p>
    </div>
    <div class="form-group">
        <div class="">
            <label style="text-align: left">电子邮箱：<strong><?php echo "$result[email]" ?></strong></label>
        </div>
        <p></p>
    </div>

    <div class="form-group">
        <div class="">
            <label>所属党支部：<strong><?php echo "$result_dept[dept_name]" ?></strong></label>
        </div>
        <p></p>
    </div>
    <?php
    if($result['role_type'] <> '管理员'){
    ?>
    <?php
    if ($resultGetFeeInfo['purchase_status'] == '1') {
        ?>
        <div class="form-group" style="color: red">
            <div class="">
                <label>党费情况：欠费&nbsp;<strong><?php echo "$resultGetFeeInfo[fee_count]" ?> </strong>元</label>
                &nbsp;&nbsp;<label>党费周期：<strong><?php echo "$resultGetFeeInfo[period_begin]" ?>
                        至 <?php echo "$resultGetFeeInfo[period_end]" ?></strong></label>
                <label><a href="purchaseFee.php?uid=<?= $resultGetFeeInfo['uid'] ?>"
                          class="button button-little bg-green" style="padding: 5px 10px;margin-left: 10px;"
                          onClick="return confirm('确定已经补交了党费?');">
                        <span class="icon">点击以确认补交</span></a>
                </label>
            </div>
            <p></p>
        </div>
        <?php
    }
    if ($resultGetFeeInfo['purchase_status'] == '2') {
        ?>
        <div class="form-group" style="color: red">
            <div class="">
                <label>党费情况：欠费&nbsp;<strong><?php echo "$resultGetFeeInfo[fee_count]" ?> </strong>元</label>
                &nbsp;&nbsp;<label>党费周期：<strong><?php echo "$resultGetFeeInfo[period_begin]" ?>
                        至 <?php echo "$resultGetFeeInfo[period_end]" ?></strong></label>
                <label><a href=" "
                          class="button button-little bg-yellow" style="padding: 5px 10px;margin-left: 10px;"">
                    <span class="icon">审核中...</span></a>
                </label>
            </div>
            <p></p>
        </div>
        <?php
    }
    if ($resultGetFeeInfo['purchase_status'] <> '1' && $resultGetFeeInfo['purchase_status'] <> '2') {
        ?>
        <div class="form-group">
            <div class="">
                <label>党费情况：暂无欠费</label>
            </div>
            <p></p>
        </div>

        <?php
    }}
    ?>

    <div class="form-group">
        <div class="">
            <label>党支部书记：<strong><?php echo "$result_dept[dept_leader]" ?></strong></label>
        </div>
        <p></p>
    </div>
    <div class="form-group">
        <div class="">
            <label>党支部联系电话：<strong><?php echo "$result_dept[dept_phone]" ?></strong></label>
        </div>
        <p></p>
    </div>
    <div class="form-group">
        <div class="">
            <label>最近一次登录IP地址：<strong><?php echo "$result[login_ip]" ?></strong></label>
        </div>
        <p></p>
    </div>
</div>
</div>
</body>
</html>
