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

//分类首页开始
$classtop=mysql_query("select * from ".$data['classvideo']." where class_name_cn<>'' order by sort asc limit 0,1",$conn) or die("ERROR: ".mysql_error());
while($classttop=mysql_fetch_array($classtop)){
if($classttop['lx']==0)$ur="index";
if($classttop['lx']==1)$ur="index";
if($classttop['lx']==2)$ur="index";
$resulltop=mysql_query("select * from ".$data['video']." where passed=1 and title<>'' and classid=".$classttop['classid']." order by sort desc",$conn) or die("ERROR: ".mysql_error());
if(mysql_num_rows($resulltop)!=0){
$rstop=mysql_fetch_array($resulltop);
$num_rowtop = mysql_num_rows($resulltop);
$pagesizetop = 8;
$pagestop= intval($num_rowtop/$pagesizetop);//总页数
if($num_rowtop % $pagesizetop)
			  {
				  $pagestop++;
			  }
for($itop=1;$itop<=$pagestop;$itop++){
$sFile1top2 = $sFile."/video/".$ur.".php?classid=".$classttop['classid']."&page=".$itop."&classname=".$ur."_".$classttop['classid'];
if ($itop==1){
  $tFiletop2 = "/video/index.php";
}else{
  $tFiletop2 = "/video/index_".$itop.".html";
}
$shtml->create_html($sFile1top2,$tFiletop2);
}
}
else
{
$sFiletop1 = $sFile."/partner/".$ur.".php?classid=".$classt['classid']."&page=1&classname=".$ur."_".$classt['classid']."";
$tFiletop = "/partner/index.php";
$shtml->create_html($sFiletop1,$tFiletop);
}
}
//分类首页结束

//分类开始
$class=mysql_query("select * from ".$data['classvideo']." where class_name_cn<>'' order by sort asc",$conn) or die("ERROR: ".mysql_error());
while($classt=mysql_fetch_array($class)){
if($classt['lx']==0)$ur="index";
if($classt['lx']==1)$ur="index";
if($classt['lx']==2)$ur="index";
$resull=mysql_query("select * from ".$data['video']." where passed=1 and title<>'' and classid=".$classt['classid']." order by sort desc",$conn) or die("ERROR: ".mysql_error());
if(mysql_num_rows($resull)!=0){
$rs=mysql_fetch_array($resull);
$num_row = mysql_num_rows($resull);
$pagesize = 8;
$pages= intval($num_row/$pagesize);//总页数
if($num_row % $pagesize)
			  {
				  $pages++;
			  }
for($i=1;$i<=$pages;$i++){
$sFile12 = $sFile."/video/".$ur.".php?classid=".$classt['classid']."&page=".$i."&classname=".$ur."_".$classt['classid'];
$tFile2 = "/video/".$ur."_".$classt['classid']."_".$i.".html";
$shtml->create_html($sFile12,$tFile2);
}
}
else
{
$sFile1 = $sFile."/video/".$ur.".php?classid=".$classt['classid']."&page=1&classname=".$ur."_".$classt['classid']."";
$tFile = "/video/".$ur."_".$classt['classid']."_1.html";
$shtml->create_html($sFile1,$tFile);
}
}
//中文结束

//echo "<span class='STYLE1'>(新闻分类)生成静态栏目成功!</span>";
?>

<div class="chenggong">
 <div class="cg_left"><img src="../images/laugh.jpg" /></div>
 <div class="cg_right"><h1>(视频展示)</h1><p>生成静态栏目成功!</p></div>
</div>

</body>
</html>