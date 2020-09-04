<?php
session_start();
define("_EXEC",1); //定义权限设置
//define("H_ACTION",1);	//定义后台操作
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
$sj = date("Y-m-d H:i:s");
$string = "UPDATE ".$data['admin']." SET LastLogoutTime ='{$sj}' WHERE username='{$_SESSION['Admin']['Name']}'";
mysql_query($string, $conn) or die("ERROR: ".mysql_error());
//$_SESSION['Admin']='';
unset($_SESSION['Admin']); //删除Session变量
//session_unset();
header("location:login.php");
exit;
?>