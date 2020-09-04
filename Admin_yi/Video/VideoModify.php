<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
$sjk=$data['classvideo'];
?>
<?php
if(!empty($_GET['pID'])){
					  $id=$_GET['pID'];
					  $page=$_GET['page'];
					  $sql="select * from ".$data['video']." where id='$id'";
					  $result=mysql_query($sql,$conn) or die("Error:".mysql_error());
					  $res=mysql_fetch_array($result);
					  if (mysql_num_rows($result)!=0){
					  ?>
<?php
$m=0;
$pp=$res['classid'];
function ShowTree($parentID,$conn,$date) {
$conn1=$conn;
$date1=$date;
global $m;
global $pp;
$m++;
$sql="select * from ".$date1." where prv_id='".$parentID."' order by sort asc";
$resul=mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
if (mysql_num_rows($resul)==0 && $m==1) echo "该频道暂无栏目";
while($rs=mysql_fetch_array($resul)){
if(intval($rs['classid'])==intval($pp)){
$sele="selected='selected'";
}
else{
$sele="";
}
echo "<option value='".$rs['classid'] ."'".$sele.">";
			  for ($n=1;$n<=$m;$n++){
			  if($n==$m && $m==1){
			  echo "├";
			  }
			  elseif($n==1){			  
			  echo "  ├";
			  }
			  elseif($n==$m){			  
			  echo "─";
			  }
			  else{
			  echo "─";
			  }
			  }
echo $rs['class_name_cn']."<br>";
ShowTree($rs['classid'],$conn1,$date1);
			  $m--;
			  echo "</option>";

}
}

$m1=0;
$pp1=$res['classid1'];
function ShowTree1($parentID,$conn,$date) {
$conn1=$conn;
$date1=$date;
global $m1;
global $pp1;
$m1++;
$sql="select * from ".$date1." where prv_id='".$parentID."' order by sort asc";
$resul=mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
if (mysql_num_rows($resul)==0 && $m1==1) echo "该频道暂无栏目";
while($rs=mysql_fetch_array($resul)){
if(intval($rs['classid'])==intval($pp1)){
$sele="selected='selected'";
}
else{
$sele="";
}
echo "<option value='".$rs['classid'] ."'".$sele.">";
			  for ($n=1;$n<=$m1;$n++){
			  if($n==$m1 && $m1==1){
			  echo "├";
			  }
			  elseif($n==1){			  
			  echo "  ├";
			  }
			  elseif($n==$m1){			  
			  echo "─";
			  }
			  else{
			  echo "─";
			  }
			  }
echo $rs['class_name_cn']."<br>";
ShowTree1($rs['classid'],$conn1,$date1);
			  $m1--;
			  echo "</option>";

}
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>南昆山云天海</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function ChangeInput (objSelect,objInput){
if (!objInput) return;
var str = objInput.value;
var arr = str.split(",");
for (var i=0; i<arr.length; i++){
     if(objSelect.value==arr[i])return;
}
if(objInput.value=='' || objInput.value==0 || objSelect.value==0){
	  objInput.value=objSelect.value
}else{
	  objInput.value+=','+objSelect.value
}
}

function CheckForm()
{
/*	var rePrice=/^[0-9]{1,}\.?[0-9]{0,2}$/;
	if(!rePrice.test(document.myform.price.value))
	{
	alert("货币格式不正确!");
	document.myform.price.focus();
	return false;
	}*/
	if (document.myform.title.value=="")
	{
		alert("栏目名称不能为空！");
		document.myform.title.focus();
		return false;
	}
	return true;  
}

function AddFile() 
{ 
	for (var Key=1;Key<=4;Key++) 
	{ 
		if(document.getElementById("myTR_"+Key).style.display=='none') 
		{ 
			document.getElementById("myTR_"+Key).style.display=''; 
			break; 
		} 
	} 
} 

function DelFile(Key) 
{ 
	document.all("myTR_"+Key).style.display='none'; 
} 
</script>
<!----===调用编辑器==---->
<link rel="stylesheet" type="text/css" href="../KindEditor/plugins/myplugins.css" />
<script type="text/javascript" charset="utf-8" src="../KindEditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="../KindEditor/plugins/myplugins.js"></script>
<script type="text/javascript">
	KE.show({
		id : 'content',
		skinType: 'office',
        cssPath : '../KindEditor/ke.css',
        resizeMode : ke_resize_dwn,
		items : ke_items_all
	});
	KE.show({
		id : 'content_en',
		skinType: 'office',
        cssPath : '../KindEditor/ke.css',
        resizeMode : ke_resize_dwn,
		items : ke_items_all
	});
	KE.show({
		id : 'content_j',
		skinType: 'office',
        cssPath : '../KindEditor/ke.css',
        resizeMode : ke_resize_dwn,
		items : ke_items_all
	});
</script>
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">荣誉资质</a></li>
    <li><a href="#">添加栏目</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>修改栏目</span></div>
    <form method="POST" name="myform" onSubmit="return CheckForm();" action="VideoSave.php?action=Modify">
    <ul class="forminfo">
    <li><label>所属栏目</label><select name="classid" class="dfinput" style="width:180px;"><?php ShowTree(0,$conn,$sjk)?></select>&nbsp;&nbsp;&nbsp;&nbsp;排序：<input name="sort" id="sort" type="text" value="<?php echo $res['sort'];?>" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=<?php echo $res['sort'];?>;}" class="dfinput" style="width:100px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;点击数：
                <input name="hits" type="text" id="hits" class="dfinput" style="width:100px;" value="<?php echo $res['hits'];?>" /><i></i></li>
    
    <li><label>栏目名称</label><input name="title" id="title" type="text" class="dfinput" value="<?php echo $res['title'];?>" /><i></i></li>
    
    <li style="display:none"><label>栏目名称</label><input name="title_en" id="title_en" type="text" class="dfinput" value="<?php echo $res['title_en'];?>" /><i>（英文）</i></li>
    
    <li style="display:none"><label>栏目名称</label><input name="title_j" id="title_j" type="text" class="dfinput" value="<?php echo $res['title_j'];?>" /><i>（繁体）</i></li>
    
    <li style="display:none"><label>栏目型号</label><input name="model" id="model" type="text" class="dfinput" value="<?php echo $res['model'];?>" /><i></i></li>
    
    <li style="display:none"><label>市场价格</label><input name="price" id="price" type="text" class="dfinput" value="<?php echo $res['price'];?>" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=1;}" /><i>（必须是数字）</i></li>
    
    <li style="display:none"><label>促销价格</label><input name="price1" id="price1" type="text" class="dfinput" value="<?php echo $res['price1'];?>" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=1;}" /><i>（必须是数字）</i></li>
    
    <li><label>缩略图</label><input name="spic" type="hidden" id="spic" size="53" class="tx1" value="../../<?php echo $res['spic'];?>"/><iframe style="top:2px" id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=spic&uppath=proimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30"></iframe>
              <?php if($res['spic']!=""){?>
               <i><a href="javascript:;" onMouseOver="document.getElementById('pic1').style.display='block';" onMouseOut="document.getElementById('pic1').style.display='none';">图已上传</a>[<a href="ProFileDel.php?id=<?php echo $res['id'];?>&fld=spic">删除</a>]
                <div id="pic1" style="position:absolute;z-index:1;display:none"><img src="../../<?php echo $res['spic'];?>" border="0" style="border:1px solid #000000;" width="100"/></div>
                <?php }
			  else{?>
              图暂无！
              <?php }?> 荣誉资质：550 X 733px ； 厂房厂貌：550 X 360px</i></li>
    
    <li style="display:none"><label>栏目大图</label><input name="bpic" type="hidden" id="bpic" size="53" class="tx1" value="../../<?php echo $res['bpic'];?>"/><iframe style="top:2px" id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=bpic&uppath=proimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30"></iframe>
              <?php if($res['bpic']!=""){?>
               <i><a href="javascript:;" onMouseOver="document.getElementById('pic2').style.display='block';" onMouseOut="document.getElementById('pic2').style.display='none';">图已上传</a>[<a href="ProFileDel.php?id=<?php echo $res['id'];?>&amp;fld=bpic">删除</a>]
                <div id="pic2" style="position:absolute;z-index:1;display:none"><img src="../../<?php echo $res['bpic'];?>" border="0" style="border:1px solid #000000;" width="100"/></div>
                <?php }
			  else{?>
图暂无！
<?php }?> 尺寸:600px X 392px</i></li>

<?php
//echo $res['mpic'];
if(!empty($res['mpic'])){
$arrPic=explode("|",$res['mpic']);
$pCount=count($arrPic)+1;
for($a=1;$a<=$pCount;$a++){
$arrImg[$a]=$arrPic[$a-1];
}
}
else{
$pCount=0;
}?>
<?php
for($i=1;$i<=4;$i++){
?>
    <li id="myTR_<?php echo $i;?>" style="display:none"><label>更多图片</label><input name="pic_<?php echo $i;?>" type="hidden" id="pic_<?php echo $i;?>" size="53" class="tx1" value="<?php echo $arrImg[$i];?>"/>
               <iframe style="top:2px" id="UploadFiles" src="../up/upload.php?formname=myform&editname=pic_<?php echo $i;?>&uppath=proimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="23"></iframe>
              <?php if(!empty($arrImg[$i])){?>
              <i><a href="javascript:;" onmouseover="document.getElementById('viewPic<?php echo $i;?>').style.display='block';" onmouseout="document.getElementById('viewPic<?php echo $i;?>').style.display='none';">图片已上传</a>
              <div id="viewPic<?php echo $i;?>" style="position:absolute;z-index:1;display:none"><img src="../../<?php echo $arrImg[$i];?>" border="0" style="border:1px solid #000000;" width="100"/></div><?php
			  }
			  else{?>
              图片暂无！
              <?php }?><?php if(!empty($arrImg[$i])){?><a href="ProFileDel1.php?id=<?php echo $res['id'];?>&pic=<?php echo $arrImg[$i];?>">删除文件</a>
              <?php
			  }
			  else{?><input id="buttondel<?php echo $i;?>" name="buttondel<?php echo $i;?>" type="button" value="删除" onclick="DelFile(<?php echo $i;?>);pic_<?php echo $i;?>.value='';" />
              <?php }?> 尺寸:750px* 610px</i>
    </li>
    <?php 
	  }
	?>
    
    <li style="display:none"><label>网页标题</label><input name="t" id="t" type="text" class="dfinput2" value="<?php echo $res['t'];?>" /><i>（中文）</i></li>
    
    <li style="display:none"><label>网页标题</label><input name="t_en" id="t_en" type="text" class="dfinput2" value="<?php echo $res['t_en'];?>" /><i>（英文）</i></li>
    
    <li style="display:none"><label>网页标题</label><input name="t_j" id="t_j" type="text" class="dfinput2" value="<?php echo $res['t_j'];?>" /><i>（繁体）</i></li>
    
    <li style="display:none"><label>网页关键字</label><input name="k" id="k" type="text" class="dfinput2" value="<?php echo $res['k'];?>" /><i>（中文）</i></li>
    
    <li style="display:none"><label>网页关键字</label><input name="k_en" id="k_en" type="text" class="dfinput2" value="<?php echo $res['k_en'];?>" /><i>（英文）</i></li>
    
    <li style="display:none"><label>网页关键字</label><input name="k_j" id="k_j" type="text" class="dfinput2"  value="<?php echo $res['k_j'];?>"/><i>（繁体）</i></li>
    
    <li style="display:none"><label>网站描述</label><textarea name="d" id="d" cols="" rows="" class="textinput"><?php echo $res['d'];?></textarea><i>（中文）</i></li>
    
    <li style="display:none"><label>网站描述</label><textarea name="d_en" id="d_en" cols="" rows="" class="textinput"><?php echo $res['d_en'];?></textarea><i>（英文）</i></li>
    
    <li style="display:none"><label>网站描述</label><textarea name="d_j" id="d_j" cols="" rows="" class="textinput"><?php echo $res['d_j'];?></textarea><i>（繁体）</i></li>
    
    <li style="display:none"><label>栏目参数</label><textarea name="text" id="text" cols="" rows="" class="textinput"><?php echo $res['text'];?></textarea><i>（中文）</i></li>
    
    <li style="display:none"><label>栏目参数</label><textarea name="text_en" id="text_en" cols="" rows="" class="textinput"><?php echo $res['text_en'];?></textarea><i>（英文）</i></li>
    
    <li style="display:none"><label>栏目参数</label><textarea name="text_j" id="text_j" cols="" rows="" class="textinput"><?php echo $res['text_j'];?></textarea><i>（繁体）</i></li>
    
    <li style="display:none"><label>栏目详情<i></i></label><textarea name="content" id="content" cols="" rows="" class="textinput2"><?php echo $res['content'];?></textarea></li>
    
    <li style="display:none"><label>栏目详情<i>（英文）</i></label><textarea name="content_en" id="content_en" cols="" rows="" class="textinput2"><?php echo $res['content_en'];?></textarea></li>
    
    <li style="display:none"><label>栏目详情<i>（繁体）</i></label><textarea name="content_j" id="content_j" cols="" rows="" class="textinput2"><?php echo $res['content_j'];?></textarea></li>
    
    <li><label>通过审核</label><cate><input name="passed" type="checkbox" id="Passed2" value="1" <?php if($res['passed']!=0) echo "checked"; ?> /></cate><i>（如果选中的话将直接发布）</i></li>

    <li style="display:none"><label>推荐显示</label><input name="tj" type="checkbox" id="tj" value="1" /><i>（如果选中的话将推荐显示）</i></li>
    
    <li style="display:none"><label>置顶显示</label><input name="isnew" type="checkbox" id="isnew" value="1" <?php if($res['tj']!=0) echo "checked"; ?> /><i>（如果选中的话将置顶显示）</i></li>
    
    <li><label>录入时间</label><input name="UpdateTime" type="text" id="UpdateTime" class="dfinput" value="<?php echo $res['addTime'];?>" /><i></i></li>
    
    <li><label>&nbsp;</label><input name="pid" type="hidden" id="pid" value="<?php echo $res['id'];?>" /><input name="" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    
    </div>

<?php
 }
}?>
</body>

</html>
