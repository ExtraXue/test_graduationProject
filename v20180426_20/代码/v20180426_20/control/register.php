<?php
header('Content-type:text/html;charset=utf-8');
try{
    $dsn="mysql:host=localhost;dbname=2018";
    $pdo=new PDO($dsn,'root','root');
}catch(PDOException $e){
    echo '数据库连接失败！失败原因为：'.$e->getMessage();
}
date_default_timezone_set('PRC');
$username=trim($_POST['username']);
$username=strtolower($username);
$password=$_POST['password'];
$password=md5($password);
$repassword=$_POST['repassword'];
$repassword=md5($repassword);
$email=$_POST['email'];
$role_type=$_POST['role_type'];
$login_ip=$_SERVER['REMOTE_ADDR'];//获取当前IP
$info_chg_time=date('Y-m-d H:i:s');

$pdo->query('set names utf8');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
$check_sql="select * from user_info where username='{$username}' and status='1'";
$rs_check_sql=$pdo->query($check_sql);
$result=$rs_check_sql->fetch(PDO::FETCH_ASSOC);

if($password==$repassword){
    if($result==false){
        if($role_type=='teacher') {
            $sql = "insert into user_info(username,password,role_type,email,info_chg_time,login_ip)
    values('{$username}','{$password}','1','{$email}','{$info_chg_time}','{$login_ip}')";
            $pdo->exec($sql);
            echo '<script>alert("注册成功，现在请您单击返回跳转至登录页进行登录");location.href="login.html";</script>';
        }
        if( $role_type=='student'){
            $sql="insert into user_info(username,password,role_type,email,info_chg_time,login_ip)
    values('{$username}','{$password}','2','{$email}','{$info_chg_time}','{$login_ip}')";
            $pdo->exec($sql);
            echo '<script>alert("注册成功，现在请您单击返回跳转至登录页进行登录");location.href="login.html";</script>';
        }
    }
    else{
        echo '<script>alert("注册失败，用户名已存在");history.back();</script>';
    }
}else{
    echo '<script>alert("两次密码输入不一致");history.back();</script>';
}
