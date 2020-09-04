<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<?php
if ($_POST['action']=="reply")
{
    $id = $_POST['id'];
    $reply = $_POST['reply'];
    $retime = $_POST['retime'];
    mysql_query("UPDATE ".$data['feedback']." SET reply='$reply',retime='$retime',passed=1 WHERE id='{$id}'", $conn) or die("ERROR: ".mysql_error());
    echo "<script language='javascript'>window.alert('回复成功！'); location='feedback.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>在线留言</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
if (!empty($_GET['pID']))
{
    $id = $_GET['pID'];
    $page = $_GET['page'];
    $sql = "SELECT * FROM ".$data['feedback']." WHERE id='$id'";
    $result = mysql_query($sql, $conn) or die("ERROR:".mysql_error());
    $res = mysql_fetch_array($result);
    if (mysql_num_rows($result) != 0)
    {
?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">在线留言</a></li>
        <li><a href="#">查看留言</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>留言信息</span></div>
    <form name="myform" method="post" action="?" >
    <input type="hidden" name="action" value="reply">
    <input type="hidden" name="id" value="<?php echo $res['id'];?>">
    <ul class="forminfo">
        <li><label>语言</label><?php echo $res['title'];?><i></i></li>
        <li ><label>公司名称</label><?php echo $res['company'];?></li>
        <li><label>联系人</label><?php echo $res['user'];?></li>
        <li><label>传真</label><?php echo $res['fax'];?></li>
        <li style="display:none;"><label>性别</label><?php echo $res['sex'];?></li>
        <li><label>电话</label><?php echo $res['tel'];?></li>
        <li style="display:none;"><label>所在城市</label><?php echo $res['country'];?></li>
        <li style="display:none;"><label>地址</label><?php echo $res['address'];?></li>
        <li><label>移动电话</label><?php echo $res['phone'];?></li>
        <li style="display:none;"><label>MSN</label><?php echo $res['msn'];?></li>
        <li style="display:none;"><label>QQ</label><?php echo $res['qq'];?></li>
        <li style="display:none;"><label>邮政编码</label><?php echo $res['zip'];?></li>
        <li><label>E-mail</label><?php echo $res['email'];?></li>
        <li><label>留言内容</label><?php echo $res['content'];?></li>
        <li><label>留言时间</label><?php echo $res['addtime'];?></li>
        <li style="display:none;"><label>回复</label><textarea name="reply" id="reply" cols="" rows="" class="textinput"><?php echo $res['reply'];?></textarea><input name="retime" type="hidden" id="retime" value="<?php echo date("Y-m-d H:i:s");?>"></li>
        <li><label>&nbsp;</label><!--<input name="" type="submit" class="btn" value="确认保存"/>&nbsp;&nbsp;&nbsp;&nbsp;--><input name="" onClick="javascript:window.history.back(-1);"  type="button" class="btn" value="返&nbsp;&nbsp;&nbsp;&nbsp;回"/></li>
    </ul>
    </form>
</div>
<?php
    }
}
?>
</body>
</html>
