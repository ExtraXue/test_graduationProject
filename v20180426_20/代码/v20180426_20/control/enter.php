<?php
session_start();
header('Content-type:text/html;charset=utf8');
$username=$_POST['username'];
$password=$_POST['password'];
$username=strtolower(trim($username));
$password=MD5($password);

try{
    $dsn="mysql:host=localhost;dbname=2018";
    $pdo=new PDO($dsn,'root','root');
}catch(PDOException $e){
    echo '数据库连接失败！失败原因为：'.$e->getMessage();
}
date_default_timezone_set('PRC');
$sql="select * from user_info where username='{$username}'";
$pdo->query('set names utf8');
$rs=$pdo->query($sql);
$result=$rs->fetch(PDO::FETCH_ASSOC);

//role_type:0：管理员，1：老师，2：学生
if ($result){
    if($password==$result['password'] && $result['status']=='1' && $result['role_type']=='0')
    {
        $_SESSION['username']=$username;
        $login_ip=$_SERVER['REMOTE_ADDR'];//获取当前IP
        $login_time=date('Y-m-d H:i:s');
        $sql="update user_info set login_ip='{$login_ip}',login_time='{$login_time}' where username='{$username}'";
        $pdo->exec($sql);
        header('Location:skip.php');
    }
    if($password==$result['password'] && $result['status']=='1' && $result['role_type']=='1')
    {
        $_SESSION['username']=$username;
        $login_ip=$_SERVER['REMOTE_ADDR'];//获取当前IP
        $login_time=date('Y-m-d H:i:s');
        $sql="update user_info set login_ip='{$login_ip}',login_time='{$login_time}' where username='{$username}'";
        $pdo->exec($sql);
        header('Location:skip_t.php');
    }
    if($password==$result['password'] && $result['status']=='1' && $result['role_type']=='2')
    {
        $_SESSION['username']=$username;
        $login_ip=$_SERVER['REMOTE_ADDR'];//获取当前IP
        $login_time=date('Y-m-d H:i:s');
        $sql="update user_info set login_ip='{$login_ip}',login_time='{$login_time}' where username='{$username}'";
        $pdo->exec($sql);
        header('Location:skip_s.php');
    }
    else{
        echo('<script>alert("密码错误或用户状态异常，请重新尝试登录或联系管理员");history.back()</script>>');
    }
}else{
    echo('<script>alert("用户名不存在，请重新登录");history.back()</script>');

}

?>