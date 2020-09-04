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
$shtml = new Controller;
//中文开始
$resull = mysql_query("SELECT * FROM ".$data['gas']." WHERE passed=1 AND title<>'' ORDER BY sort DESC", $conn) or die("ERROR: ".mysql_error());
while ($title = mysql_fetch_array($resull))
{
    $sFile2 = $sFile."/gas/show.php?id=".$title['id']."&classname=123";
    $tFile2 = "/gas/show_".$title['id'].".html";
    $shtml->create_html($sFile2, $tFile2);
}
//中文结束
?>
<div class="chenggong">
    <div class="cg_left"><img src="../images/laugh.jpg" /></div>
    <div class="cg_right"><h1>(安全供气详细)</h1><p>生成静态栏目成功!</p></div>
</div>
</body>
</html>