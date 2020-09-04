<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
if (isset($_GET['qy']))
{
    if (!empty($_GET['qy']))
    {
        $_SESSION['qy'] = $_GET['qy'];
    }
    else
    {
        $_SESSION['qy'] = 0;
    }
}
?>
<?php
$sql = "SELECT * FROM ".$data['home']." WHERE qy=".$_SESSION['qy']." ORDER BY sort DESC";
$resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
$tt = mysql_fetch_array($resul);
if (mysql_num_rows($resul) == 0)
{
    $maxsort = "1";
}
else
{
    $maxsort = $tt['sort']+1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站基本信息</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/laydate.js"></script>
<script language = "javascript">
function CheckForm()
{
    if (document.myform.title.value == "" && document.myform.title_en.value=="")
    {
        alert("栏目名称全部不能为空！");
        document.myform.title.focus();
        return false;
    }
    return true;
}
</script>
<!----===调用编辑器==---->
<link href="../KindEditor/plugins/myplugins.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="../KindEditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="../KindEditor/plugins/myplugins.js"></script>
<script type="text/javascript">
KE.show({
    id: 'content',
    skinType: 'office',
    cssPath: '../KindEditor/ke.css',
    resizeMode: ke_resize_dwn,
    items: ke_items_all
});
KE.show({
    id: 'content_en',
    skinType: 'office',
    cssPath: '../KindEditor/ke.css',
    resizeMode: ke_resize_dwn,
    items: ke_items_all
});
KE.show({
    id: 'content_j',
    skinType: 'office',
    cssPath: '../KindEditor/ke.css',
    resizeMode: ke_resize_dwn,
    items: ke_items_all
});
</script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
    <li><a href="#">首页设置</a></li>
        <li><a href="#">添加栏目</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>首页设置</span></div>
    <form method="POST" name="myform" onSubmit="return CheckForm();" action="HomeSave.php?action=add" target="_self">
    <ul class="forminfo">
        <li><label>栏目排序</label><input type="text" id="sort" name="sort" value="<?php echo $maxsort;?>" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=<?php echo $maxsort;?>;}" class="dfinput" style="width:100px;" /><i></i></li>
        <li><label>栏目名称</label><input type="text" id="title" name="title" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>栏目名称</label><input type="text" id="title_en" name="title_en" class="dfinput" /><i>（英文）</i></li>
    
        <li style="display:none;"><label>缩略图</label><input type="hidden" id="cls_imgX" name="cls_imgX" class="dfinput" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=cls_imgX&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="23" style="top:2px;"></iframe><i>（中文）尺寸:160px X 160px</i></li>
        <li style="display:none;"><label>缩略图</label><input type="hidden" id="cls_imgD" name="cls_imgD" class="dfinput" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=cls_imgD&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="23" style="top:2px;"></iframe><i>（英文）尺寸:160px X 160px</i></li>
        <li style="display:none;"><label>封面图</label><input type="hidden" id="p" name="p" class="dfinput" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=p&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe><i>（中文）尺寸:320px X 320px</i></li>
        <li style="display:none;"><label>封面图</label><input type="hidden" id="p_en" name="p_en" class="dfinput" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=p_en&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe><i>（英文）尺寸:320px X 320px</i></li>
        <li style="display:none;"><label>栏目摘要</label><textarea id="text" name="text" cols="" rows="" class="textinput"></textarea><i>（中文）</i></li>
        <li style="display:none;"><label>栏目摘要</label><textarea id="text_en" name="text_en" cols="" rows="" class="textinput"></textarea><i>（英文）</i></li>
        <li><label>栏目内容<i><br />（中文）</i></label><textarea id="content" name="content" cols="" rows="" class="textinput2"></textarea></li>
        <li style="display:none;"><label>栏目内容<i><br />（英文）</i></label><textarea id="content_en" name="content_en" cols="" rows="" class="textinput2"></textarea></li>
        <li><b>SEO信息设置</b></li>
        <li><label>网页标题</label><input type="text" id="t" name="t" class="dfinput2" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页标题</label><input type="text" id="t_en" name="t_en" class="dfinput2" /><i>（英文）</i></li>
        <li><label>网页关键字</label><input type="text" id="k" name="k" class="dfinput2" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页关键字</label><input type="text" id="k_en" name="k_en" class="dfinput2" /><i>（英文）</i></li>
        <li><label>网站描述</label><textarea id="d" name="d" cols="" rows="" class="textinput"></textarea><i>（中文）</i></li>
        <li style="display:none;"><label>网站描述</label><textarea id="d_en" name="d_en" cols="" rows="" class="textinput"></textarea><i>（英文）</i></li>
        <li><label>通过审核</label><cate><input type="checkbox" id="Passed2" name="passed" value="1" checked="checked" /></cate><i>（如果选中的话将直接发布）</i></li>
        <li style="display:none;"><label>推荐显示</label><input type="checkbox" id="tj" name="tj" value="1" /><i>（如果选中的话将推荐显示）</i></li>
        <li><label>录入时间</label><input type="text" id="UpdateTime" name="UpdateTime" value="<?php echo date("Y-m-d H:i:s");?>" maxlength="50" class="dfinput" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" /><i></i></li>
        <li><label>&nbsp;</label><input type="submit" name="" value="确认保存" class="btn" /></li>
    </ul>
    </form>
</div>
</body>
</html>