<?php
session_start();
define("_EXEC", 1); //定义权限设置
//define("H_ACTION", 1); //定义后台操作
header("Content-Type:text/html; charset=utf-8");
if (empty($_SESSION['Admin']))
{
?>
<script>
alert("登陆后台失效或时间超时，请重新登陆！");
parent.window.location.href="login.php";
</script>
<?php
}
?>
<?php
require_once("inc/conn.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台头部</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>
<script type="text/javascript">
$(function(){	
    //顶部导航切换
    $(".nav li a").click(function(){
        $(".nav li a.selected").removeClass("selected")
        $(this).addClass("selected");
    });	
});	
</script>
</head>
<body style="background:url(images/topbg.gif) repeat-y;">
<div class="topleft">
    <h1><a href="">网联科技后台管理系统</a></h1>
    <h2><a href="/">WWW.GDWL.NET.CN</a></h2>
</div>
<ul class="nav">
</ul>
<div class="topright">    
    <ul>
        <li><span><img src="images/help.png" title="帮助"  class="helpimg"/></span><a href="http://www.gdwl.net.cn" target="_blank">帮助</a></li>
        <li><a href="/" target="_blank">网站前台</a></li>
        <li><a href="loginout.php" target="_parent">退出</a></li>
    </ul>
    <div class="user">
        <span><?php echo $_SESSION['Admin']['Name'];?></span>
    </div>
</div>
</body>
</html>
