<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>生成静态</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body style="background-color:#FFFFFF;">
<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
$shtml = new Controller;
//中文开始
$sFile1 = $sFile."/home/weblist.php?classname=123";
$tFile = "/home/weblist.php";
$shtml->create_html($sFile1, $tFile);
$sFile1 = $sFile."/home/weblist.php?classname=123";
$tFile = "weblist.php";
$shtml->create_html($sFile1, $tFile);
//中文结束
?>
<div class="chenggong">
    <div class="cg_left"><img src="../images/laugh.jpg" /></div>
    <div class="cg_right"><h1>(网站首页)</h1><p>生成静态栏目成功!</p></div>
</div>
</body>
</html>