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
parent.window.location.href="../login.php";
</script>
<?php
}
?>