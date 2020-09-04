<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<?php
if ($_POST['action'] == "add")
{
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $addtime = $_POST['addtime'];
    $realpassword = $_POST['password'];
    $mobile = $_POST['mobile'];
    if (!empty($realpassword))
    {
        mysql_query("INSERT INTO ".$data['user']." SET username='$username',password='$password',email='$email',addtime='$addtime',realpassword='$realpassword',mobile='$mobile' ",$conn) or die("ERROR: ".mysql_error());
        echo "<script language='javascript'>window.alert('添加成功！'); location='MemberList.php ';</script>";
    }
    else
    {
        mysql_query("INSERT INTO ".$data['user']." SET  username='$username',email='$email',addtime='$addtime',mobile='$mobile' ",$conn) or die("ERROR: ".mysql_error());
        echo "<script language='javascript'> window.alert('添加成功！'); location='MemberList.php ';</script>";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加会员资料</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="../js/function.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
function checkInput(obj)
{
    if (!strNoEmpty(obj.username, "请输入帐号!"))
    {
        return false;
    }
    if (!strNoEmpty(obj.password, "请输入密码!"))
    {
        return false;
    }
    if (obj.password.value != "")
    {
        if (!strNoEmpty(obj.password2, "请输入确认密码!"))
        {
            return false;
        }
        if (!strNoEqual(obj.password,obj.password2, "密码输入前后不一致!"))
        {
            return false;
        }
    }
    if (!strNoEmpty(obj.email, "请输入邮箱地址!"))
    {
        return false;
    }
    return true;
}
</script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">会员中心</a></li>
        <li><a href="#">会员列表</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>添加会员</span></div>
    <form name="myform" method="post" action="?" onSubmit="return checkInput(this);">
    <input type="hidden" name="action" value="add">
    <ul class="forminfo">
        <li><label>帐号</label><input type="text" id="username" name="username" class="dfinput" /><i>（*）</i></li>
        <li><label>密码</label><input type="password" id="password" name="password" class="dfinput" /><i>（*）</i></li>
        <li><label>确认密码</label><input type="password" id="password2" name="password2" class="dfinput" /><i>（*）</i></li>
        <li><label>邮箱地址</label><input type="text" id="email" name="email" class="dfinput2" /><i></i></li>
        <li><label>手机号码</label><input type="text" id="mobile" name="mobile" class="dfinput2" /><i></i></li>
        <li><label>注册时间</label><input type="text" id="addtime" name="addtime" value="<?php echo date("Y-m-d H:i:s");?>" maxlength="50" class="dfinput" /><i></i></li>
        <li><label>&nbsp;</label><input type="submit" name="" value="确认保存" class="btn" />&nbsp;&nbsp;&nbsp;<input type="button" name="" value="返&nbsp;&nbsp;&nbsp;&nbsp;回" onClick="location.href='MemberList.php?page=<?php echo $_GET['page'];?>';" class="btn" /></li>
    </ul>
    </form>
</div>
</body>
</html>