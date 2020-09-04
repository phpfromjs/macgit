<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
$sjk=$data['classhotel'];
?>
<?php
$sql="select * from ".$data['hotel']." order by sort desc";
$resul = mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
$tt=mysql_fetch_array($resul);
if (mysql_num_rows($resul) == 0){
 $maxsort="1";
}
else{
 $maxsort=$tt['sort']+1;
}
?>
<?php
$m=0;
function ShowTree($parentID,$conn,$date) {
$conn1=$conn;
$date1=$date;
global $m;
$m++;
$sql="select * from ".$date1." where prv_id='".$parentID."' order by sort asc";
$resul=mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
if (mysql_num_rows($resul)==0 && $m==1) echo "该频道暂无栏目";
while($rs=mysql_fetch_array($resul)){
echo "<option value='".$rs['classid'] ."'>";
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
function ShowTree1($parentID,$conn,$date) {
$conn1=$conn;
$date1=$date;
global $m1;
$m1++;
$sql="select * from ".$date1." where prv_id='".$parentID."' order by sort asc";
$resul=mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
if (mysql_num_rows($resul)==0 && $m1==1) echo "该频道暂无栏目";
while($rs=mysql_fetch_array($resul)){
echo "<option value='".$rs['classid'] ."'>";
  for ($n=1;$n<=$m1;$n++){
  if($n==$m1 && $m1==1){
  echo "├";
  }
  elseif($n==1){			  
  echo "&nbsp;&nbsp;";
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
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>案例中心</title>
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
    <li><a href="#">客户见证</a></li>
    <li><a href="#">添加栏目</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>添加栏目</span></div>
    <form method="POST" name="myform" onSubmit="return CheckForm();" action="HotelSave.php?action=add" target="_self">
    <ul class="forminfo">
    <li><label>所属类别</label><select name="classid" class="dfinput" style="width:180px;"><?php ShowTree(0,$conn,$sjk)?></select>&nbsp;&nbsp;&nbsp;&nbsp;排序：<input name="sort" id="sort" type="text" value="<?php echo $maxsort;?>" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=<?php echo $maxsort;?>;}" class="dfinput" style="width:100px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;点击数：
                <input name="hits" type="text" id="hits" value="0" class="dfinput" style="width:100px;" /><i></i></li>
    
    <li><label>栏目标题</label><input name="title" id="title" type="text" class="dfinput" /><i></i></li>
    
    <li style="display:none"><label>栏目名称</label><input name="title_en" id="title_en" type="text" class="dfinput" /><i>（英文）</i></li>
    
    <li style="display:none"><label>栏目名称</label><input name="title_j" id="title_j" type="text" class="dfinput" /><i>（繁体）</i></li>
    
    <li><label>合作伙伴</label><input name="model" id="model" type="text" class="dfinput" /><i></i></li>
    
    <li style="display:none"><label>市场价格</label><input name="price" id="price" type="text" class="dfinput" value="0" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=1;}" /><i>（必须是数字）</i></li>
    
    <li style="display:none"><label>促销价格</label><input name="price1" id="price1" type="text" class="dfinput" value="0" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=1;}" /><i>（必须是数字）</i></li>
    
    <li><label>栏目图片</label><input name="spic" id="spic" type="hidden" class="dfinput" /><iframe style="top:2px" id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=spic&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30"></iframe><i>尺寸:280px X 165px</i></li>
    
    <li style="display:none"><label>栏目大图</label><input name="bpic" id="bpic" type="hidden" class="dfinput" /><iframe style="top:2px" id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=bpic&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30"></iframe><i>（英文）尺寸:600px X 600px</i></li>

	<?php 
      for($i=1;$i<=4;$i++){
    ?>
    <li id="myTR_" style="display:none"><label>更多栏目</label><input name="pic_<?php echo $i;?>" id="pic_<?php echo $i;?>" type="hidden" class="dfinput" /><iframe style="top:2px" id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=pic_<?php echo $i;?>&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30"></iframe><i>尺寸:293px X 152px</i>
    <input id="buttondel<?php echo $i;?>" name="buttondel<?php echo $i;?>" type="button" value="删除" onClick="DelFile(<?php echo $i;?>);pic_<?php echo $i;?>.value='';">
    </li>
    <?php 
	  }
	?>
    
    <li style="display:none"><label>网页标题</label><input name="t" id="t" type="text" class="dfinput2" /><i>（中文）</i></li>
    
    <li style="display:none"><label>网页标题</label><input name="t_en" id="t_en" type="text" class="dfinput2" /><i>（英文）</i></li>
    
    <li style="display:none"><label>网页标题</label><input name="t_j" id="t_j" type="text" class="dfinput2" /><i>（繁体）</i></li>
    
    <li style="display:none"><label>网页关键字</label><input name="k" id="k" type="text" class="dfinput2" /><i>（中文）</i></li>
    
    <li style="display:none"><label>网页关键字</label><input name="k_en" id="k_en" type="text" class="dfinput2" /><i>（英文）</i></li>
    
    <li style="display:none"><label>网页关键字</label><input name="k_j" id="k_j" type="text" class="dfinput2" /><i>（繁体）</i></li>
    
    <li style="display:none"><label>网站描述</label><textarea name="d" id="d" cols="" rows="" class="textinput"></textarea><i>（中文）</i></li>
    
    <li style="display:none"><label>网站描述</label><textarea name="d_en" id="d_en" cols="" rows="" class="textinput"></textarea><i>（英文）</i></li>
    
    <li style="display:none"><label>网站描述</label><textarea name="d_j" id="d_j" cols="" rows="" class="textinput"></textarea><i>（繁体）</i></li>
    
    <li style="display:none"><label>栏目参数</label><textarea name="text" id="text" cols="" rows="" class="textinput"></textarea><i>（中文）</i></li>
    
    <li style="display:none"><label>栏目参数</label><textarea name="text_en" id="text_en" cols="" rows="" class="textinput"></textarea><i>（英文）</i></li>
    
    <li style="display:none"><label>栏目参数</label><textarea name="text_j" id="text_j" cols="" rows="" class="textinput"></textarea><i>（繁体）</i></li>
    
    <li><label>栏目详情<i></i></label><textarea name="content" id="content" cols="" rows="" class="textinput2"></textarea></li>
    
    <li style="display:none"><label>栏目详情<i>（英文）</i></label><textarea name="content_en" id="content_en" cols="" rows="" class="textinput2"></textarea></li>
    
    <li style="display:none"><label>栏目详情<i>（繁体）</i></label><textarea name="content_j" id="content_j" cols="" rows="" class="textinput2"></textarea></li>
    
    <li><label>通过审核</label><cate><input name="passed" type="checkbox" id="Passed2" value="1" checked="checked" /></cate><i>（如果选中的话将直接发布）</i></li>

    <li><label>推荐显示</label><input name="tj" type="checkbox" id="tj" value="1" /><i>（如果选中的话将推荐显示）</i></li>
    
    <li style="display:none"><label>置顶显示</label><input name="isnew" type="checkbox" id="isnew" value="1" /><i>（如果选中的话将置顶显示）</i></li>
    
    <li><label>录入时间</label><input name="UpdateTime" type="text" id="UpdateTime" class="dfinput" value="<?php echo date("Y-m-d H:i:s");?>" maxlength="50" /><i></i></li>
    
    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    
    </div>


</body>

</html>
