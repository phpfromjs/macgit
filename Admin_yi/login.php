<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录后台管理系统</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>
<script src="js/cloud.js" type="text/javascript"></script>
<script language="javascript">
$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    $(window).resize(function(){
        $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })
});
</script> 
<script language=javascript>
<!--
function SetFocus()
{
    if (document.Login.user.value == "")
    {
        document.Login.user.focus();
    }
    else
    {
        document.Login.user.select();
    }
}

function CheckForm()
{
    if (document.Login.user.value == "")
    {
        alert("请输入用户名！");
        document.Login.user.focus();
        return false;
    }
    if (document.Login.pwd.value == "")
    {
        alert("请输入密码！");
        document.Login.pwd.focus();
        return false;
    }
    if (document.Login.verify_code.value == "")
    {
        alert ("请输入您的验证码！");
        document.Login.verify_code.focus();
        return(false);
    }
}
//-->
</script>
</head>
<?php
session_start();
define("_EXEC",1); //定义权限设置
//define("H_ACTION",1);	//定义后台操作
//define("DROOT",".."); //定义路径
header("Content-Type:text/html; charset=utf-8");
require_once("inc/conn.php");
//退出操作
//if ($_GET['lgout'] == 1)
//{
    //$_SESSION['Admin'] = '';
//}
//判断是否登陆，如果已登陆则跳转
if ($_SESSION['Admin']['Id'] > 0)
{
    header("Location:index.php");
}
if (($_POST['user'] != "") AND ($_POST['pwd'] != "") AND ($_POST['verify_code'] != ""))
{
    if (strtolower($_POST['verify_code']) != $_SESSION['code'])
    {
        echo "<script>alert('验证码错误');location.href='login.php';</script>";
        exit;
    }
    $pwd = md5(trim($_POST['pwd']));
    $sql = "SELECT * FROM ".$data['admin']." WHERE username ='{$_POST['user']}' AND Password='{$pwd}' ";
    $resul = mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
    $tt = mysql_fetch_array($resul);
    if (mysql_num_rows($resul) != 0)
    {
        if ($tt['openflag'] != 1)
        {
            echo "<script>alert('您的账号未通过审核，请联系管理员!');location.href='login.php';</script>";
        }
        else
        {
            $_SESSION['Admin']['Id'] = $tt['id'];
            $_SESSION['Admin']['power'] = $tt['power'];
            $_SESSION['Admin']['adminjb'] = $tt['adminjb'];
            $_SESSION['Admin']['Name'] = $tt['username'];
            $_SESSION['Admin']['Pwd'] = $tt['Password'];
            $_SESSION['Admin']['RealName'] = $tt['realname'];
            $_SESSION['Admin']['LastLogoutTime'] = $tt['LastLogoutTime'];
            $_SESSION['Admin']['LoginTimes'] = $tt['LoginTimes'];
            $_SESSION['Admin']['sj'] = date("Y-m-d H:i:s");
            $ip = $_SERVER['REMOTE_ADDR'];
            $sj = date("Y-m-d H:i:s");
            $string = "UPDATE ".$data['admin']." SET lastLoginIip='{$ip}',LoginTimes=LoginTimes+1,LastLoginTime='{$sj}' WHERE username='{$_SESSION['Admin']['Name']}'";
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:index.php");
        }
    }
    else
    {
        echo "<script>alert('帐号或密码错误!');location.href='login.php';</script>";
    }
}
//$x = file_get_contents("http://www.baidu.com");
//echo $x;
?>
<body style="background-color:#1C77AC;background-image:url(images/light.png);background-repeat:no-repeat;background-position:center top;overflow:hidden;">
<div id="mainBody">
    <div id="cloud1" class="cloud"></div>
    <div id="cloud2" class="cloud"></div>
</div>
<div class="logintop">
    <span>欢迎登录后台管理界面平台</span>
    <ul>
        <li><a href="/">回首页</a></li>
        <li><a href="http://www.gdwl.net.cn" target="_blank">帮助</a></li>
        <li><a href="http://www.gdwl.net.cn" target="_blank">关于</a></li>
    </ul>
</div>
<div class="loginbody">
    <span class="systemlogo"><h1>网联科技后台管理系统</h1></span> 
    <div class="loginbox">
        <form name="Login" action="login.php" method="post" target="_parent" onSubmit="return CheckForm();">
        <ul>
            <li><input type="text" id="user" name="user" class="loginuser" placeholder="登录账号" data-validate="required:请填写账号,length#>=5:账号长度不符合要求"/></li>
            <li><input type="password" id="pwd" name="pwd" class="loginpwd" placeholder="登录密码" data-validate="required:请填写密码,length#>=8:密码长度不符合要求"/></li>
            <li>
                <input type="text" id="verify_code" name="verify_code" class="loginverify" style="width:80px;" />
                <img src="../../code/code.php" onclick="javascript:this.src='../../code/code.php?tm='+Math.random();" width="90" height="30" id="codeimg" style="vertical-align:top;" />
                <a href="javascript:void(0);" onclick="javascript:document.getElementById('codeimg').src='../../code/code.php?tm='+Math.random();" style="font-size:12px;cursor:pointer;">更换</a>
            </li>
            <li><input name="" type="submit" class="loginbtn" value="登&nbsp;&nbsp;录" /><label><input name="" type="reset" class="loginbtn" value="取&nbsp;&nbsp;消" /></label></li>
        </ul>
        </form>
    </div>
</div>
<div class="loginbm">版权所有&nbsp;&nbsp;&nbsp;&nbsp;@2015-2016&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.gdwl.net.cn" target="_blank">网联科技</a></div>
</body>
</html>
