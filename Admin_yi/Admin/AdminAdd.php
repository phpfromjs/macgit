<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员信息</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
<!--
function chkInput(obj)
{
    if (obj.uid.value == "")
    {
        alert("请输入您的帐号。");
        obj.uid.focus();
        return false;
    }
    if (obj.pwd1.value == "")
    {
        alert("请输入您的密码。");
        obj.pwd1.focus();
        return false;
    }
    if (obj.pwd1.value != obj.pwd2.value)
    {
        alert("请确认您的密码。");
        obj.pwd2.focus();
        return false;
    }
    return true;
}
//-->
</script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">系统设置</a></li>
        <li><a href="#">添加管理员</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>管理员信息</span></div>
    <form action="AdminSave.php" method="post" name="myform" id="myform"  onsubmit="return chkInput(this)">
    <input type="hidden" value="add" name="action">
    <ul class="forminfo">
        <li><label>管理员帐号</label><input name="uid" id="uid" type="text" class="dfinput" value="" /><i> 数字、字符组合</i></li>
        <li><label>新密码</label><input name="pwd1" id="pwd1" type="password" class="dfinput" value="" /><i> 数字、字符组合，8位数以上</i></li>
        <li><label>密码确认</label><input name="pwd2" id="pwd2" type="password" value="" class="dfinput" /><i> 再一次输入密码</i></li>
        <li><label>姓名</label><input name="realname" id="realname" type="text" value="" class="dfinput" /><i> (真实姓名)</i></li>
        <li><label>部门</label><input name="depart" id="depart" type="text" value="" class="dfinput" /><i></i></li>
        <li><label>审核通过</label><cite><input name="openflag" type="radio" value="1" <?php if ($res['openflag'] == 1){echo "checked";} ?> />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="openflag" type="radio" value="0" <?php if ($res['openflag'] == 0){echo "checked";} ?> />否</cite></li>
        <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存" />&nbsp;&nbsp;<input name="" type="button" class="btn" value="返回" onclick="javascript:history.back(-1)" /></li>
    </ul>
    </form>
</div>
</body>
</html>
