<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>生成静态</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body style="background-color:#FFF;">
<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
$shtml=new Controller;
//中文开始
$resull=mysql_query("select * from ".$data['case']." where passed=1 and title<>'' order by sort desc",$conn) or die("ERROR: ".mysql_error());
while($title=mysql_fetch_array($resull))
{
$sFile2 = $sFile."/cn/factory/show.php?id=".$title['id']."&classname=123";
$tFile2 = "cn/factory/show_".$title['id'].".html";
$shtml->create_html($sFile2,$tFile2);
}
//中文结束
//英文开始
$resull=mysql_query("select * from ".$data['case']." where passed=1 and title_en<>'' order by sort desc",$conn) or die("ERROR: ".mysql_error());
while($title=mysql_fetch_array($resull))
{
$sFile2 = $sFile."/en/factory/show.php?id=".$title['id']."&classname=123";
$tFile2 = "en/factory/show_".$title['id'].".html";
$shtml->create_html($sFile2,$tFile2);
}
//英文结束

//繁体开始
$resull=mysql_query("select * from ".$data['case']." where passed=1 and title_j<>'' order by sort desc",$conn) or die("ERROR: ".mysql_error());
while($title=mysql_fetch_array($resull))
{
$sFile2 = $sFile."/jp/factory/show.php?id=".$title['id']."&classname=123";
$tFile2 = "jp/factory/show_".$title['id'].".html";
$shtml->create_html($sFile2,$tFile2);
}
//繁体结束

//echo "<span class='STYLE1'>(新闻详细)生成静态栏目成功!</span>";
?>
<div class="chenggong">
 <div class="cg_left"><img src="../images/laugh.jpg" /></div>
 <div class="cg_right"><h1>(新闻详细)</h1><p>生成静态栏目成功!</p></div>
</div>

</body>
</html>