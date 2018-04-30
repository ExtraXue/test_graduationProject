<!--防跳墙start-->
<?php
session_start();
header('Content-type:text/html;charset=utf8');
require_once('pdo.php');
if (!isset($_SESSION['username'])) {
    echo('<script> alert("登录异常，请重新登录");location.href="../index.html";</script>');
}
?>
<!--防跳墙end-->

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="renderer" content="webkit">
    <title>后台管理中心</title>
    <link rel="stylesheet" href="css/pintuer.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/jquery.js"></script>
</head>

<body style="background-color:#f2f9fd;">
<style>
    .header-bottom {
        float: left;
        font-size: 12px;
    }

</style>
<div class="header bg-main">
    <div class="logo margin-big-left fadein-top">
        <h1><img src="images/y.jpg" class="radius-circle rotate-hover" height="50" alt=""/>后台管理中心</h1>
    </div>
    <div class="head-l"><a class="button button-little bg-green" href="" target="_blank"><span class="icon-home"></span>
            前台首页</a> &nbsp; &nbsp;<a class="button button-little bg-red" href="exit.php"><span
                    class="icon-power-off"></span> 退出登录</a></div>
    <div style="height: 25px;"></div>

    <div class="clear"></div>
</div>
</div>
<div class="leftnav">
    <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
    <h2><span class="icon-user"></span>基本设置</h2>
    <ul style="display:block">
        <li><a href="userinfo.php" target="right"><span class="icon-caret-right"></span>个人信息</a></li>
        <li><a href="change_pwd.php" target="right"><span class="icon-caret-right"></span>修改密码</a></li>
    </ul>
    <h2><span class="icon-pencil-square-o"></span>栏目管理</h2>
    <ul style="display: block">
        <?php
        $sqlGetUserInfo = "select * from user_info where username ='{$_SESSION['username']}'";
        $rsGetUserInfo = $pdo->query($sqlGetUserInfo);
        $resultGetUserInfo = $rsGetUserInfo->fetch(PDO::FETCH_ASSOC);

        if ($resultGetUserInfo['role_type'] <> '0') {
            ?>
            <li><a href="noteBoard.php" target="right"><span class="icon-caret-right"></span>历史通知</a></li>
            <li><a href="list.html" target="right"><span class="icon-caret-right"></span>在线学习</a></li>
            <li><a href="feeHistory.php" target="right"><span class="icon-caret-right"></span>党费缴纳历史</a></li>
            <?php
        }
        ?>
        <?php
        if ($resultGetUserInfo['role_type'] == '0') {
            ?>
            <li><a href="noteBoard.php" target="right"><span class="icon-caret-right"></span>通知发布</a></li>
            <li><a href="feeCall.php" target="right"><span class="icon-caret-right"></span>党费催欠</a></li>
            <li><a href="feeHistory.php" target="right"><span class="icon-caret-right"></span>党费缴纳历史查询</a></li>
            <li><a href="feeBorad.php" target="right"><span class="icon-caret-right"></span>党费缴纳信息</a></li>
            <?php
        }
        ?>

        <li><a href="messageBorad.php" target="right"><span class="icon-caret-right"></span>公众留言板</a></li>
    </ul>
</div>
<script type="text/javascript">
    $(function () {
        $(".nav h2").click(function () {
            $(this).next().slideToggle(200);
            $(this).toggleClass("on");
        })
        $(".nav ul li a").click(function () {
            $("#a_leader_txt").text($(this).text());
            $(".leftnav ul li a").removeClass("on");
            $(this).addClass("on");
        })
    });
</script>
<ul class="bread">
    <div style="float: left;padding-right: 20px;">
        <?php
        echo "<strong style='color: #C50C11'>欢迎你：$_SESSION[username]</strong>";
        ?>
    </div>
    <div style="float: right">
        <?php
        $sqlGetUserInfo = "select * from user_info where username ='{$_SESSION['username']}'";
        $rsGetUserInfo = $pdo->query($sqlGetUserInfo);
        $resultGetUserInfo = $rsGetUserInfo->fetch(PDO::FETCH_ASSOC);

        $sqlGetNoteInfo = "select * from note_board where send_target = '{$resultGetUserInfo['id']}' and is_read ='0' order by create_time desc";
        $rsGetGetNoteInfo = $pdo->query($sqlGetNoteInfo);
        $resultGetNoteInfo = $rsGetGetNoteInfo->fetch(PDO::FETCH_ASSOC);

        $sqlGetNoteCount = "select count(*) as count from note_board where send_target = '{$resultGetUserInfo['id']}' and is_read ='0' order by create_time desc";
        $rsGetNoteCount = $pdo->query($sqlGetNoteCount);
        $resultGetNoteCount = $rsGetNoteCount->fetch(PDO::FETCH_ASSOC);

        $sqlGetFeeInfo="select * from user_fee_info where purchase_status ='2'";
        $rsGetFeeInfo=$pdo->query($sqlGetFeeInfo);
        $resultGetFeeInfo=$rsGetFeeInfo->fetchAll(PDO::FETCH_ASSOC);

        $sqlGetFeeInfoCount="select count(*) as count from user_fee_info where purchase_status ='2'";
        $rsGetFeeInfoCount=$pdo->query($sqlGetFeeInfoCount);
        $resultGetFeeInfoCount=$rsGetFeeInfoCount->fetch(PDO::FETCH_ASSOC);

        if ($resultGetNoteInfo && $resultGetUserInfo['role_type'] <> '0') {
            echo "<a href=\"noteBoard.php\" target=\"right\"onclick='dispear()' id='notification'><strong style='color: #C50C11'>您有$resultGetNoteCount[count]条未读信息！</strong></a>";
        }
        if($resultGetFeeInfo && $resultGetUserInfo['role_type'] == '0'){
            echo "<a href=\"feeBorad.php\" target=\"right\"onclick='dispear()' id='notification'><strong style='color: #C50C11'>您有$resultGetFeeInfoCount[count]条党费补交消息待确认！</strong></a>";
        }

        ?>
        <script>
            function dispear() {
                var notification = document.getElementById('notification');
                notification.style.display = "none";
            }
        </script>
    </div>
    <div style="float: left">当前时间：</div>
    <div class="header-bottom">
        <div class="date">
            <div class="date" id="localtime"></div>

            <script type="text/javascript">

                function showLocale(objD) {
                    var str, colorhead, colorfoot;
                    var yy = objD.getYear();
                    if (yy < 1900) yy = yy + 1900;
                    var MM = objD.getMonth() + 1;
                    if (MM < 10) MM = '0' + MM;
                    var dd = objD.getDate();
                    if (dd < 10) dd = '0' + dd;
                    var hh = objD.getHours();
                    if (hh < 10) hh = '0' + hh;
                    var mm = objD.getMinutes();
                    if (mm < 10) mm = '0' + mm;
                    var ss = objD.getSeconds();
                    if (ss < 10) ss = '0' + ss;
                    var ww = objD.getDay();
                    if (ww == 0) colorhead = "<font color=\"#777\">";
                    if (ww > 0 && ww < 6) colorhead = "<font color=\"#777\">";
                    if (ww == 6) colorhead = "<font color=\"#777\">";
                    if (ww == 0) ww = "星期日";
                    if (ww == 1) ww = "星期一";
                    if (ww == 2) ww = "星期二";
                    if (ww == 3) ww = "星期三";
                    if (ww == 4) ww = "星期四";
                    if (ww == 5) ww = "星期五";
                    if (ww == 6) ww = "星期六";
                    colorfoot = "</font>"
                    str = colorhead + yy + "-" + MM + "-" + dd + " " + "  " + ww + colorfoot;
                    return (str);
                }

                function tick() {
                    var today;
                    today = new Date();
                    document.getElementById("localtime").innerHTML = showLocale(today);
                    window.setTimeout("tick()", 1000);
                }

                tick();
            </script>
        </div>

    </div>

</ul>

<div class="admin">
    <iframe scrolling="auto" rameborder="0" src="userinfo.php" name="right" width="100%" height="100%"></iframe>
</div>

</body>
</html>