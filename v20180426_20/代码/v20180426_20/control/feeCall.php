<?php
/**
 * Created by PhpStorm.
 * User: 67569
 * Date: 2018/4/25
 * Time: 17:42
 */
?>
<?php
error_reporting(E_ALL^E_NOTICE);?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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


$sqlGetDeptInfo="select * from dept_info";
$rsGetDeptInfo=$pdo->query($sqlGetDeptInfo);
$resultGetDeptInfo=$rsGetDeptInfo->fetchAll(PDO::FETCH_ASSOC);

$sqlGetFeeInfo="select * from user_fee_info";
$rsGetFeeInfo=$pdo->query($sqlGetFeeInfo);
$resultGetFeeInfo=$rsGetFeeInfo->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>党费催欠</strong></div>
    <div class="body-content">
        <form action="feeCall.php" method="post">
                <div class="form-group" style="padding-left: 5%;">
                    <div class="label" style="float: left;padding-top: 8px;">
                        <label>选择党支部：</label>
                    </div>
                    <div class="field">
                    <div style="float: left">
                    <select class="input" name="deptId" style="width: 200px" ">
                        <?php
                        foreach ($resultGetDeptInfo as $key => $value){
                            echo "<option value='$value[dept_id]'>$value[dept_name]</option>";
                        }
                        ?>
                    </select>
                    </div>
                    <div>
                        <button class="button bg-yellow" type="submit" style="margin-left: 20px;">查找用户</button>
                    </div>

                    </div>
                </div>
        </form>
                    <form method="post" class="form-x" action="feeCallCheck.php">
                    <div class="form-group" style="margin-top: 30px;">
                        <div class="label">
                            <label>选择用户：</label>
                        </div>
                        <div class="field">
                            <select class="input" name="userId" style="width: 200px" ">
                                <?php
                                $contents = $_POST['deptId'];
                                $sqlGetUserinfo="select * from user_info a where a.dept_id='$contents'";
                                $rs=$pdo->query($sqlGetUserinfo);
                                $result=$rs->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $key => $valueUser){
                                    echo "<option value='$valueUser[id]'>$valueUser[username]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>需交党费：</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" name="feeCount" size="50" placeholder="单位：元"  style="width:200px"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>党费周期：</label>
                        </div>
                        <div class="field" style="">
                            <input type="date" class="input" id="periodBegin" name="periodBegin" style="width:200px"/>
                            <div style="height: 5px"></div>
                            <strong style="padding-left: 6%;">至</strong>
                            <div style="height: 5px"></div>
                            <input type="date" class="input" id="periodEnd" name="periodEnd"  style="width:200px"/>
                        </div>

                    </div>
                    <div style="height: 20px"></div>
                    <div class="form-group">
                        <div class="label">
                            <label>备注:</label>
                        </div>
                        <div class="field">
                    <textarea name="remark" class="input" style="height:100px; float: left "
                              placeholder="如没有备注，可以不填写"></textarea>
                            <div class="field" style="padding-top: 20px;">
                                <button class="button bg-main icon-check-square-o" type="submit">提交</button>
                            </div>
                        </div>
                    </div>
            </form>
</div>

</body>
</html>