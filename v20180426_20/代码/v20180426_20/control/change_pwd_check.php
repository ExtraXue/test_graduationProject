<?php
session_start();
header('Content-type:text/html;charset=utf8');
$old_password=$_POST['old_password'];
$new_password=$_POST['new_password'];
$re_new_password=$_POST['re_new_password'];
$old_password=MD5($old_password);
$new_password=MD5($new_password);
$re_new_password=MD5($re_new_password);


require_once ('pdo.php');
//$sql="update user_info  set password = '{$new_password}' where username='{$username}'";
$sql="select * from user_info where username='{$_SESSION['username']}'
and password = '{$old_password}' and status = '1'";
$pdo->query('set names utf8');
$rs=$pdo->query($sql);
$return=$rs->fetch(PDO::FETCH_ASSOC);
if($return)
{
    if($old_password <> $new_password){
        $info_chg_time=date('Y-m-d H:i:s');
        $change_sql="update user_info  set password = '{$new_password}',info_chg_time='{$info_chg_time}' where username='{$_SESSION['username']}'";
        $pdo->exec($change_sql);
        echo(
        '<script>
    if(confirm("修改成功，请重新至主界面重新登录"))
    {
    window.parent.close();
    }else{
        window.parent.close();
    }
    </script>'
        );
    }else{
        echo('<script>alert("修改失败，修改密码与原密码相同！");history.back();</script>');
    }
}
else{
    echo('<script>alert("修改失败，原密码验证错误或用户数据异常！");history.back();</script>');
    echo $return;
}



?>

