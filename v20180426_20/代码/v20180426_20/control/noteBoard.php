<?php
/**
 * Created by PhpStorm.
 * Author: HowardXue
 * Date: 2018/4/24
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
    <title>通知板</title>
</head>

<?php
session_start();
header('Content-type:text/html;charset=utf8');
require_once ('pdo.php');
$sqlGetUserinfo="select * from user_info a where a.username='{$_SESSION['username']}'";
$rs=$pdo->query($sqlGetUserinfo);
$result=$rs->fetch(PDO::FETCH_ASSOC);

$sqlGetDeptInfo="select * from dept_info";
$rsGetDeptInfo=$pdo->query($sqlGetDeptInfo);
$resultGetDeptInfo=$rsGetDeptInfo->fetchAll(PDO::FETCH_ASSOC);

$sqlGetNoteInfo="select * from note_info";
$rsGetNoteInfo=$pdo->query($sqlGetNoteInfo);
$resultGetNoteInfo=$rsGetNoteInfo->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>历史通知</strong></div>
    <div class="body-content">
        <div class="form-group">
<!-- 仅管理员可见内容begin-->
            <?php
            if($result['role_type']=='0') {
                ?>
                <form method="post" class="form-x" action="noteBoardCheck.php">
                    <div class="form-group" >
                        <div class="label">
                            <label>通知类别：</label>
                        </div>
                        <div class="field" >
                            <select class="input" name="noteType">
                                <?php
                                foreach ($resultGetNoteInfo as $key => $value){
                                    echo "<option value='$value[note_type_id]'>$value[note_name]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="label">
                            <label>通知对象：</label>
                        </div>
                        <div class="field">
                        <select class="input" name="sendTarget">
                            <option value="allTeacher">全体教师</option>
                            <option value="allStudent">全体学生</option>
                        <?php
                            foreach ($resultGetDeptInfo as $key => $value){
                                echo "<option value='$value[dept_id]'>$value[dept_name]</option>";
                            }
                        ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>通知主题：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input w50" id="mpass" name="noteTitle" size="50" placeholder="输入通知主题" data-validate="required:请输入通知主题" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>通知内容:</label>
                        </div>
                        <div class="field">
                        <textarea name="noteContent" class="input" style="height:100px; float: left "
                          placeholder="当前管理员：<?php echo "{$_SESSION['username']}" ?>"></textarea>
                        <div class="field" style="padding-top: 20px;">
                            <button class="button bg-main icon-check-square-o" type="submit">提交</button>
                        </div>
                        </div>
                    </div>

                </form>
                <?php
                $sqlGetNoteInfo="select * from note_board order by create_time desc";
                $rsGetGetNoteInfo=$pdo->query($sqlGetNoteInfo);
                $resultGetNoteInfo=$rsGetGetNoteInfo->fetch(PDO::FETCH_ASSOC);
                foreach ($pdo->query($sqlGetNoteInfo) as $key=>$resultGetNoteInfo) {
                    ?>
                    <div style="height: 20px"></div>
                    <div class="dialog open">
                        <div class="dialog-head">
                            <strong>通知主题：</strong>
                            <span style="font-style: italic;color: #C50C11">
                        <?php echo "$resultGetNoteInfo[note_title]"?></span>

                            <span style="float: right;font-weight: bold">
                        <?php echo "$resultGetNoteInfo[create_time]"; ?>
                                &nbsp;&nbsp;
                        <label>通知对象ID：</label>
                        <span style="color: #C50C11">
                        <?php echo "$resultGetNoteInfo[send_target]"?></span>
                        </span>
                            <!--只有管理员具有删除权限-->
                            <?php
                            if($result['role_type']=='0'){?>
                                <!--获取UID-->
                                <a href="deleteNote.php?uid=<?=$resultGetNoteInfo['uid']?>"
                                   class="button button-little bg-red" style="padding: 5px 10px;margin-left: 10px;">
                                    <span class="icon-power-off" >删除</span></a>
                                <?php
                            }?>
                        </div>
                        <div class="dialog-body"><?php echo "$resultGetNoteInfo[note_content]"?></div>
                    </div>
                    <?php
                }
                ?>
                <?php
            }
            ?>
<!--仅管理员可见内容end-->

            <?php
            if($result['role_type']<>'0') {
                ?>
                <?php
                $sqlGetUserInfo="select * from user_info where username ='{$_SESSION['username']}'";
                $rsGetUserInfo=$pdo->query($sqlGetUserInfo);
                $resultGetUserInfo=$rsGetUserInfo->fetch(PDO::FETCH_ASSOC);

                $sqlGetNoteInfo="select * from note_board where send_target = '{$resultGetUserInfo['id']}' order by create_time desc";
                $rsGetGetNoteInfo=$pdo->query($sqlGetNoteInfo);
                $resultGetNoteInfo=$rsGetGetNoteInfo->fetchAll(PDO::FETCH_ASSOC);
                foreach ($pdo->query($sqlGetNoteInfo) as $key=>$resultGetNoteInfo) {
                    ?>
                    <div style="height: 20px"></div>
                    <div class="dialog open">
                        <div class="dialog-head">
                            <strong>通知主题：</strong>
                            <span style="color: #C50C11;font-family: 'Microsoft YaHei';font-size: 16px;">
                        <?php echo "$resultGetNoteInfo[note_title]"?></span>

                            <span style="float: right;font-weight: bold">
                        <?php echo "$resultGetNoteInfo[create_time]"; ?>
                                &nbsp;&nbsp;
                        <label>发起管理员：</label>
                        <span style="color: #C50C11">
                        <?php echo "$resultGetNoteInfo[admin_name]"?></span>
                        </span>
                            <!--只有管理员具有删除权限-->
                            <?php
                            if($result['role_type']=='0' ){?>
                                <!--获取UID-->
                                <a href="deleteNote.php?uid=<?=$resultGetNoteInfo['uid']?>"
                                   class="button button-little bg-red" style="padding: 5px 10px;margin-left: 10px;">
                                    <span class="icon-power-off" >删除</span></a>
                                <?php
                            }?>
                            <?php
                            if($result['role_type'] <> '0' && $resultGetNoteInfo['is_read'] == '0') {
                                ?>
                                <a href="readNote.php?uid=<?= $resultGetNoteInfo['uid'] ?>"
                                   class="button button-little bg-yellow" style="padding: 5px 10px;margin-left: 10px;">
                                    <span class="icon">单击设置为已读</span></a>

                                <?php
                            }
                            ?>
                        </div>
                        <div class="dialog-body"><?php echo "$resultGetNoteInfo[note_content]"; ?></div>
                    </div>
                    <?php
                }
                ?>
                <?php
            }
            ?>
           <div class="clear"></div>
        </div>
    </div>
</div>



</body>
</html>