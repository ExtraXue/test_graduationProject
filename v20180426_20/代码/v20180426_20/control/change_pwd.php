<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="css/pintuer.css">
<link rel="stylesheet" href="css/admin.css">
<script src="js/jquery.js"></script>
<script src="js/pintuer.js"></script>
</head>

<?php
session_start();
require_once ('pdo.php');
$sql="select * from user_info where username='{$_SESSION['username']}'";
$rs=$pdo->query($sql);
$result=$rs->fetch(PDO::FETCH_ASSOC);

?>

<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong><span class="icon-key"></span> 修改会员密码</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="change_pwd_check.php">
      <div class="form-group">
        <div class="label">
          <label>管理员帐号：</label>
        </div>
        <div class="field">
          <label style="line-height:33px;">
           <strong><?php  echo "$result[username]"  ?></strong>
          </label>
        </div>
      </div>      
      <div class="form-group">
        <div class="label">
          <label >原始密码：</label>
        </div>
        <div class="field">
          <input type="password" class="input w50" id="mpass" name="old_password" size="50" placeholder="请输入原始密码" data-validate="required:请输入原始密码" />
        </div>
      </div>      
      <div class="form-group">
        <div class="label">
          <label >新密码：</label>
        </div>
        <div class="field">
          <input type="password" class="input w50" name="new_password" size="50" placeholder="请输入新密码" data-validate="required:请输入新密码,length#>=5:新密码不能小于5位" />
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label >确认新密码：</label>
        </div>
        <div class="field">
          <input type="password" class="input w50" name="re_new_password" size="50" placeholder="请再次输入新密码" data-validate="required:请再次输入新密码,repeat#new_password:两次输入的密码不一致"/>
        </div>
      </div>
      
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit" onclick="check()"> 提交</button>
        </div>
      </div>      
    </form>
  </div>
</div>
<script>
    function check(){
        var a="$&*#";
        var b;
        for(i=0 ;i<username.value.length;i++){
            b=username.value.charAt(i);
            if(a.indexOf(b)>=0){
                alert("姓名里不能含有非法字符$&*#");
                return false;}
        }

        var d=new_password.value;
        var e=re_new_password.value;
        if(d!=e){
            alert('密码和确认密码不一致');
            new_password.focus();
            return false;
        }
        var f="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var g="1234567890";
        var j;
        var k;
        var cc=0;
        var dd=0;
        for(j=0;j<new_password.value.length;j++){
            k=new_password.value.charAt(j);
            if(f.indexOf(k)>=0){
                ++cc ;
            }
            if(g.indexOf(k)>=0){
                ++dd ;
            }
        }
        if(cc==0 || dd==0){
            alert('密码必须包括字母和数字');
            new_password.focus();
            return false;
        }
    }</script>
</body></html>