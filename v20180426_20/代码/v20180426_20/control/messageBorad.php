<?php
/**
 * Created by PhpStorm.
 * User: HowardXue
 * Date: 2018/4/23
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>
    <link rel="stylesheet" href="css/pintuer.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/jquery.js"></script>
    <script src="js/pintuer.js"></script>
    <title>留言板</title>
</head>

<?php
session_start();
header('Content-type:text/html;charset=utf8');
require_once ('pdo.php');
$sqlGetUserinfo="select * from user_info a where a.username='{$_SESSION['username']}'";
$rs=$pdo->query($sqlGetUserinfo);
$result=$rs->fetch(PDO::FETCH_ASSOC);
?>

<body>
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>公众留言板</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="messageBoradCheck.php">

            <div class="form-group">
                <div class="label" >
                    <label>内容:</label>
                </div>
                <div class="field">
                    <textarea name="message" class="input" style="height:100px; float: left "
                              placeholder="当前用户：<?php echo "{$_SESSION['username']}"?>"></textarea>

                    <div class="field" style="padding-top: 20px;">
                        <button class="button bg-main icon-check-square-o" type="submit" > 提交</button>
                    </div>
                </div>
                <div class="clear"></div>

            </div>

        </form>

    </div>
</div>


<?php
$sqlGetMessageInfo="select * from message_board order by create_time desc";
$rsGetMessageInfo=$pdo->query($sqlGetMessageInfo);
$resultGetMessageInfo=$rsGetMessageInfo->fetch(PDO::FETCH_ASSOC);


foreach ($pdo->query($sqlGetMessageInfo) as $key=>$resultGetMessageInfo) {
    ?>
    <div style="height: 20px"></div>
    <div class="dialog open">
        <div class="dialog-head">
            <span class="dialog-close rotate-hover"></span>
            <strong>发布人：</strong>
            <span style="font-style: italic;color: #C50C11">
                <?php echo "$resultGetMessageInfo[username]"?></span>
            <span style="float: right;font-weight: bold">
            <?php echo "$resultGetMessageInfo[create_time]"; ?>
            </span>
<!--            管理员具有删除权限-->
            <?php
            if($result['role_type']=='0'){?>
                <!--获取UID-->
                <a href="deleteMessage.php?uid=<?=$resultGetMessageInfo['uid']?>"
                   class="button button-little bg-red" style="padding: 5px 10px;margin-left: 10px;">
                    <span class="icon-power-off" >删除</span></a>
            <?php
            }?>
        </div>
        <div class="dialog-body"><?php echo "$resultGetMessageInfo[message]"?></div>
    </div>
    <?php
}
?>
</body>
</html>