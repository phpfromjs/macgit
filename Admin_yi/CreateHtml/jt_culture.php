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
$p = 1;
$resull = mysql_query("SELECT * FROM ".$data['about']." WHERE passed=1 AND title<>'' AND qy=2 ORDER BY sort ASC", $conn) or die("ERROR: ".mysql_error());
while ($title = mysql_fetch_array($resull))
{
    $sFile2 = $sFile."/service/index.php?id=".$title['id']."&classname=123";
    $tFile = "/service/show_".$title['id'].".html";
    $shtml->create_html($sFile2, $tFile);
    if ($p == 1)
    {
	$sFile3 = $sFile."/service/index.php?id=".$title['id']."&classname=123";
	$tFile4 = "/service/index.php";
        $shtml->create_html($sFile3, $tFile4);
    }
    $p++;
    $i++;
}
//中文结束
?>
<div class="chenggong">
    <div class="cg_left"><img src="../images/laugh.jpg" /></div>
    <div class="cg_right"><h1>(办事流程)</h1><p>生成静态栏目成功!</p></div>
</div>
</body>
</html>