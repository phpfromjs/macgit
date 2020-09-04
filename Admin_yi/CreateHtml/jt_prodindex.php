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
//$sFile1 = $sFile."/cn/products/weblist.php?classname=index";
//$tFile = "cn/products/weblist.php";
//$shtml->create_html($sFile1,$tFile);
//一级分类
$class=mysql_query("select * from ".$data['classpro']." where prv_id=0 and class_name_cn<>'' order by sort desc",$conn) or die("ERROR: ".mysql_error());
while($classt=mysql_fetch_array($class)){
$resull=mysql_query("select * from ".$data['pro']." where passed=1 and title<>'' and link_id like '%|".$classt['classid']."|%' order by sort desc",$conn) or die("ERROR: ".mysql_error());
$src="index";
if(mysql_num_rows($resull)!=0){
$rs=mysql_fetch_array($resull);
$num_row = mysql_num_rows($resull);
$pagesize = 12;
$pages= intval($num_row/$pagesize);//总页数
if($num_row % $pagesize)
			  {
				  $pages++;
			  }
for($i=1;$i<=$pages;$i++){
$sFile12 = $sFile."/products/".$src.".php?classid=".$classt['classid']."&page=".$i."&classname=".$src."_".$classt['classid'];
$tFile2 = "/products/".$src."_".$classt['classid']."_".$i.".html";
$shtml->create_html($sFile12,$tFile2);
	if ($i==1){  //生成产品首页
		$tFile3 = "/products/weblist.php";
		$shtml->create_html($sFile12,$tFile3);
	}
}
}
else
{
$sFile1 = $sFile."/products/".$src.".php?classid=".$classt['classid']."&page=1&classname=".$src."_".$classt['classid']."";
$tFile = "/products/".$src."_".$classt['classid']."_1.html";
$shtml->create_html($sFile1,$tFile);
}
}

//中文结束

//echo "<span class='STYLE1'>(产品首页)生成静态栏目成功!</span>";
?>

<div class="chenggong">
 <div class="cg_left"><img src="../images/laugh.jpg" /></div>
 <div class="cg_right"><h1>(产品列表)</h1><p>生成静态栏目成功!</p></div>
</div>

</body>
</html>