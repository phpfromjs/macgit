<?php 
require_once("../inc/AdminCheck.php");
$uptypes=array(
    'image/jpg', 
    'image/jpeg',
    'image/png',
    'image/pjpeg',
    'image/gif',
    'image/bmp',
    'image/x-png',
	'application/octet-stream',
	'application/vnd.ms-excel',
	'application/pdf',
	'video/x-flv',
);
$max_file_size=600000000000;     //上传文件大小限制, 单位BYTE
$imgpreviewsize=1/2;    //缩略图比例
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZwelL图片上传程序</title>
<style type="text/css">
<!--
body
{
	font-size: 9pt;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
body,td,th {
	font-size: 9pt;
}
.tx1 { height: 19px;font-size: 9pt; border: 1px solid; border-color: #000000; color: #056DAF}
-->
</style>
</head>
<body><div id="showw">
<form enctype="multipart/form-data" method="post" name="upform" style="margin:0PX;">
<input name="upfile" type="file" <?php if(strpos($_SERVER["HTTP_USER_AGENT"],"Chrome"))echo 'style="width:85%"';?>><input type="submit" value="上传" class="tx1">
<input type="hidden"  value="<?php echo  $_GET['formname'];?>" name="formname">
<input type="hidden"  value="<?php echo  $_GET['editname'];?>" name="editname">
<input type="hidden" value="<?php echo  "../../wl_upload/".$_GET['uppath']."/";?>" name="uppath">
<input type="hidden"  value="<?php echo  $_GET['filelx'];?>" name="filelx">
</form></div>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$destination_folder=$_POST['uppath']; //上传文件路径
if (!is_uploaded_file($_FILES["upfile"]["tmp_name"])){//是否存在文件
echo "<script> window.alert('图片不存在！');</script>";
    //echo "图片不存在!";
    exit;
}
$file = $_FILES["upfile"];
if($max_file_size < $file["size"]){//检查文件大小
echo "<script> window.alert('文件太大！');</script>";
    //echo "文件太大!";
    exit;
}
//echo "<script> window.alert('".$file["type"]."');<script>";exit();
if(!in_array($file["type"], $uptypes)){//检查文件类型
echo "<script> window.alert('文件类型不符！');</script>";
    //echo "文件类型不符!".$file["type"];
    exit;
}
if(!file_exists($destination_folder)){
    mkdir($destination_folder);
}
$filename=$file["tmp_name"];
$image_size = getimagesize($filename);
$pinfo=pathinfo($file["name"]);
$ftype=$pinfo['extension'];
$destination = $destination_folder.time().".".$ftype;
if (file_exists($destination) && $overwrite != true){
    echo "同名文件已经存在了";
    exit;
}
if(!move_uploaded_file ($filename, $destination)){
    echo "移动文件出错";
    exit;
}
$pinfo=pathinfo($destination);
$fname=$pinfo["basename"];
echo "<script>parent.document.".$_POST['formname'].".".$_POST['editname'].".value='".$destination_folder.$fname."';showw.style.display='none';</script>";
echo "图片上传成功！文件大小:".ceil($file["size"]/1024)."KB";
//echo "<script> window.alert('图片上传成功！');window.close();<script>";
}
?>
</body>
</html>