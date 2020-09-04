<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="../css/css.css" type=text/css rel=stylesheet>
<?php
$allid=$_POST['ArticleID'];
$id=$_GET['ArticleID'];
//if(empty($allid)){
//echo "<script language='javascript'> window.alert('你还没有选择对象！'); history.go(-1);<script>";
//exit;
//}
if (!empty($allid)){
$allidlist = implode(",", $allid);
if(!empty($allidlist)){
$rs="select * from ".$data['hotel']." where id in($allidlist)";
$resul=mysql_query($rs,$conn) or die("ERROR: ".mysql_error());
while($title=mysql_fetch_array($resul)){
$spic="../../".$title['spic'];
$bpic="../../".$title['bpic'];

delFile ($spic);
delFile ($bpic);

if(!empty($title['mpic'])){
$arrPic=explode("|",$title['mpic']);
$pCount=count($arrPic)+1;
for($a=1;$a<=$pCount;$a++){
delFile ("../../".$arrPic[$a-1]);
}
}
}
$sql = "delete from ".$data['hotel']." where id in($allidlist)"; 
mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
echo "<script language='javascript'> window.alert('删除对象成功！'); location='HotelList.php';</script>";
exit;
}
}
?>
<?php
if(!empty($id)){
$rs="select * from ".$data['hotel']." where id='".$id."'";
$resul=mysql_query($rs,$conn) or die("ERROR: ".mysql_error());
while($title=mysql_fetch_array($resul)){
$spic="../../".$title['spic'];
$bpic="../../".$title['bpic'];
delFile($spic);
delFile($bpic);
if(!empty($title['mpic'])){
$arrPic=explode("|",$title['mpic']);
$pCount=count($arrPic)+1;
for($a=1;$a<=$pCount;$a++){
delFile ("../../".$arrPic[$a-1]);
}
}
}
$sql = "delete from ".$data['hotel']." where id='".$id."'"; 
mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
echo "<script language='javascript'> window.alert('删除对象成功！'); location='HotelList.php';</script>";
exit;
}
?>
<?php
	function delFile($file) {
	  if ( !is_file($file) ) return false;
	  @chmod($file, 0777);
	  @unlink($file);
	  return true;
	 }
	 ?>
<script language='javascript'> window.alert('你还没有选择对象！'); history.go(-1);</script>