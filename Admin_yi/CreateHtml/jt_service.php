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
//$sFile1 = $sFile."/cn/about/index.php?classname=123";
//$tFile = "cn/about/index.php";
//$shtml->create_html($sFile1,$tFile);
$p=1;
$resull=mysql_query("select * from ".$data['about']." where passed=1 and title<>'' and qy=5 order by sort asc",$conn) or die("ERROR: ".mysql_error());
while($title=mysql_fetch_array($resull)){
$sFile2 = $sFile."/feedback/index.php?id=".$title['id']."&classname=123";
$tFile = "/feedback/show_".$title['id'].".html";
$shtml->create_html($sFile2,$tFile);
if($p==1){
	$sFile3 = $sFile."/feedback/index.php?id=".$title['id']."&classname=123";
	$tFile4 = "/feedback/index.php";
	$shtml->create_html($sFile3,$tFile4);
}
$p++;
$i++;
}
//中文结束

//echo "<span class='STYLE1'>(联系我们)生成静态栏目成功!</span>";
?>
<div class="chenggong">
 <div class="cg_left"><img src="../images/laugh.jpg" /></div>
 <div class="cg_right"><h1>(客服服务)</h1><p>生成静态栏目成功!</p></div>
</div>

</body>
</html>