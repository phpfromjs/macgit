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
$sql = "SELECT * FROM ".$data['contact']."  ORDER BY sort DESC";
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
<title>联系我们</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/laydate.js"></script>
<script language = "javascript">
function CheckForm()
{
    if (document.myform.title.value == "" && document.myform.title_en.value == "")
    {
        alert("栏目名称全部不能为空！");
        document.myform.title.focus();
        return false;
    }
    //if (document.myform.filename.value == "")
    //{
        //alert("文件名不能为空！");
        //document.myform.filename.focus();
        //return false;
    //}
    return true;
}
</script>
<script charset="utf-8" src="../kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="../kindeditor/lang/zh_CN.js"></script>
<script>
var editor;
KindEditor.ready(function(K){
    editor = K.create('textarea[name="content"]', {
    uploadJson : '../kindeditor/php/upload_json.php',
    fileManagerJson : '../kindeditor/php/file_manager_json.php',
    allowFileManager : true
  });
});
KindEditor.ready(function(K){
    editor = K.create('textarea[name="content_en"]', {
    uploadJson : '../kindeditor/php/upload_json.php',
    fileManagerJson : '../kindeditor/php/file_manager_json.php',
    allowFileManager : true
  });
});
KindEditor.ready(function(K){
    editor = K.create('textarea[name="content_j"]', {
    uploadJson : '../kindeditor/php/upload_json.php',
    fileManagerJson : '../kindeditor/php/file_manager_json.php',
    allowFileManager : true
  });
});
</script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="../js/pinyin.js"></script>
<script type="text/javascript">
function CreatePinYin()
{
    if (document.myform.crpy.checked == true)
    {
        var kk = $("#title").val();
        var pp = CC2PY(kk);
        $("#filename").val(pp);
    }
    else
    {
        $("#filename").val('');
    }
}
</script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
    <li><a href="#">联系我们</a></li>
        <li><a href="#">添加栏目</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>联系我们</span></div>
    <form method="post" name="myform" onSubmit="return CheckForm();" action="ContactSave.php?action=add" target="_self">
    <ul class="forminfo">
        <li><label>栏目排序</label><input type="text" id="sort" name="sort" value="<?php echo $maxsort;?>" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=<?php echo $maxsort;?>;}" class="dfinput" style="width:100px;" /><i></i></li>
        <li><label>栏目名称</label><input type="text" id="title" name="title" class="dfinput" /><i>（中文）</i></li>
        <li ><label>栏目名称</label><input type="text" id="title_en" name="title_en" class="dfinput" /><i>（英文）</i></li>
        <li><label>公司名称</label><input type="text" id="CompanyNameCn" name="CompanyNameCn" class="dfinput" /><i>（中文）</i></li>
        <li><label>公司名称En</label><input type="text" id="CompanyNameCn" name="CompanyNameEn" class="dfinput" /><i>（英文）</i></li>
        <li><label>栏目摘要</label><textarea id="text" name="text" cols="" rows="" class="textinput"></textarea><i>（中文）</i></li>
        <li ><label>栏目摘要</label><textarea id="text_en" name="text_en" cols="" rows="" class="textinput"></textarea><i>（英文）</i></li>
        <li ><label>二维码</label><input name="spic" id="spic" type="hidden" class="dfinput" /><iframe style="top:2px" id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=spic&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30"></iframe><i>中文</i></li>
        <li ><label>二维码</label><input name="spicen" id="spicen" type="hidden" class="dfinput" /><iframe style="top:2px" id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=spicen&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30"></iframe><i>英文</i></li>
        <li><label>地址</label><input type="text" id="AddressCn" name="AddressCn" class="dfinput" /><i>（中文）</i></li>
        <li><label>地址</label><input type="text" id="Addressen" name="Addressen" class="dfinput" /><i>（英文）</i></li>
        <li><label>移动电话1</label><input type="text" id="mobilephone1" name="mobilephone1" class="dfinput" /><i>（中文）</i></li>
        <li><label>移动电话1</label><input type="text" id="mobilephoneen1" name="mobilephoneen1" class="dfinput" /><i>（英文）</i></li>
        <li><label>移动电话2</label><input type="text" id="mobilephone2" name="mobilephone2" class="dfinput" /><i>（中文）</i></li>
        <li><label>移动电话2</label><input type="text" id="mobilephoneen2" name="mobilephoneen2" class="dfinput" /><i>（英文）</i></li>
        <li><label>固定电话</label><input type="text" id="TelePhone" name="TelePhone" class="dfinput" /><i>（中文）</i></li>
        <li><label>固定电话</label><input type="text" id="TelePhoneen" name="TelePhoneen" class="dfinput" /><i>（英文）</i></li>
        <li style="display: none"><label>传真</label><input type="text" id="Fax" name="Fax" class="dfinput" /><i>（中文）</i></li>
        <li style="display: none"><label>传真</label><input type="text" id="Faxen" name="Faxen" class="dfinput" /><i>（英文）</i></li>
        <li style="display: none"><label>邮政编码</label><input type="text" id="postalcodecn" name="postalcodecn" class="dfinput" /><i>（中文）</i></li>
        <li style="display: none"><label>邮政编码</label><input type="text" id="postalcodeen" name="postalcodeen" class="dfinput" /><i>（英文）</i></li>
        <li ><label>邮箱</label><input type="text" id="emailcn" name="emailcn" class="dfinput" /><i>（中文）</i></li>
        <li ><label>邮箱</label><input type="text" id="emailen" name="emailen" class="dfinput" /><i>（英文）</i></li>
        <li style="display: none"><label>工作时间</label><input type="text" id="worktimecn" name="worktimecn" class="dfinput" /><i>（中文）</i></li>
        <li style="display: none"><label>工作时间</label><input type="text" id="worktimeen" name="worktimeen" class="dfinput" /><i>（英文）</i></li>
        <li><label>经度</label><input type="text" id="Longitude" name="Longitude" class="dfinput" /><i>（中文）</i></li>
        <li><label>纬度</label><input type="text" id="Latitude" name="Latitude" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>文件名</label><input type="text" id="filename" name="filename" class="dfinput" style="width:250px;" /><input type="checkbox" name="crpy" value="" onclick="javascript:CreatePinYin()" />获取拼音<i>*（生成静态文件名）</i></li>
        <li><b>SEO信息设置</b></li>
        <li><label>网页标题</label><input type="text" id="t" name="t" class="dfinput2" /><i>（中文）</i></li>
        <li ><label>网页标题</label><input type="text" id="t_en" name="t_en" class="dfinput2" /><i>（英文）</i></li>
        <li><label>网页关键字</label><input type="text" id="k" name="k" class="dfinput2" /><i>（中文）</i></li>
        <li ><label>网页关键字</label><input type="text" id="k_en" name="k_en" class="dfinput2" /><i>（英文）</i></li>
        <li><label>网站描述</label><textarea id="d" name="d" cols="" rows="" class="textinput"></textarea><i>（中文）</i></li>
        <li ><label>网站描述</label><textarea id="d_en" name="d_en" cols="" rows="" class="textinput"></textarea><i>（英文）</i></li>
        <li><label>通过审核</label><cate><input type="checkbox" id="Passed2" name="passed" value="1" checked="checked" /></cate><i>（如果选中的话将直接发布）</i></li>
        <li style="display:none;"><label>推荐显示</label><input type="checkbox" id="tj" name="tj" value="1" /><i>（如果选中的话将推荐显示）</i></li>
        <li><label>录入时间</label><input type="text" id="UpdateTime" name="UpdateTime" value="<?php echo date("Y-m-d H:i:s");?>" maxlength="50" class="dfinput" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" /><i></i></li>
        <li><label>&nbsp;</label><input type="submit" name="" value="确认保存" class="btn" /></li>
    </ul>
    </form>
</div>
</body>
</html>
