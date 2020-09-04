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
    if (obj.pwd1.value != "" && obj.pwd1.value != obj.pwd2.value)
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
<?php
if(!empty($_GET['id']))
{
    $id = $_GET['id'];
    $sql = "SELECT * FROM ".$data['admin']." WHERE id='$id'";
    $result = mysql_query($sql, $conn) or die("Error:".mysql_error());
    $res = mysql_fetch_array($result);
    if (mysql_num_rows($result) != 0)
    {
?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">系统设置</a></li>
        <li><a href="#">修改管理员</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>管理员信息</span></div>
    <form method="post" id="myform" name="myform" action="AdminSave.php" onsubmit="return chkInput(this)">
    <input type="hidden" value="<?php echo $res['id'];?>" name="pid">
    <input type="hidden" value="modify" name="action">
    <ul class="forminfo">
        <li><label>管理员帐号</label><font color="#FF0000"><?php echo $res['username'];?></font></li>
        <li><label>新密码</label><input name="pwd1" id="pwd1" type="password" class="dfinput" value="" /><i> 数字、字符组合，8位数以上</i></li>
        <li><label>密码确认</label><input name="pwd2" id="pwd2" type="password" value="" class="dfinput" /><i> 再一次输入密码</i></li>
        <li><label>姓名</label><input name="realname" id="realname" type="text" value="<?php echo $res['realname'];?>" class="dfinput" /><i> (真实姓名)</i></li>
        <li><label>部门</label><input name="depart" id="depart" type="text" value="<?php echo $res['depart'];?>" class="dfinput" /><i></i></li>
        <li><label>审核通过</label><cite><input name="openflag" type="radio" value="1" <?php if($res['openflag']==1) echo "checked"; ?> />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="openflag" type="radio" value="0" <?php if($res['openflag']==0) echo "checked"; ?> />否</cite></li>
        <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存"/>&nbsp;&nbsp;<input name="" type="button" class="btn" value="返回" onclick="javascript:history.back(-1)"/></li>
    </ul>
    </form>
</div>
<?php
    }
}
?>
</body>
</html>
