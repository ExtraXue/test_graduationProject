<html>
<head>
    <title> jquery 延迟跳转</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <script type="text/javascript">
        setTimeout(
            function(){
                //添加你指定元素的onclick事件
            },1000 //1000 指 1000毫秒(1秒) 后触发
        );
    </script>
</head>

<?php
session_start();
require_once ('pdo.php');
$sql="select * from user_info where username='{$_SESSION['username']}'";
$rs=$pdo->query($sql);
$result=$rs->fetch(PDO::FETCH_ASSOC);
?>

<body>

<!--<input type="button" value="我是一个按钮" onclick="javascrtpt:window.location.href='http://www.baidu.com'">-->
<SPAN style="FONT-SIZE: 12px"><script type="text/javascript">
<!--
function go(t,url){
//t设置跳转时间：秒
//url设置跳转网址
    document.write("<div id=text>本页将在<strong id='tt'></strong>后，跳转至 <strong>管理员界面</strong>：<span id='link'></span></div>");
    document.write("若想直接跳转，请点击上述链接");
    document.getElementById("link").innerHTML="<a href="+url+">"+url+"</a>";
    $(t,url);
}
function $(t,url){
    ta = t-1;
    tb = t + "000";
    d = document.getElementById("tt");
    d.innerHTML=t;
    window.setInterval(function()
    {
        go_to(url);
    },1000);
}
function go_to(url){
    d.innerHTML=ta--;
    if(ta<0){
        document.write("正在跳转至：<h4>"+url+"</h4>");
        location.href="skip_bak.html";
        window.open(url);
    }
    else{
        return;
    }
}
//-->
</script>
<script type="text/javascript">
go(3, "index.php")
</script> </SPAN>
</body>
</html>
