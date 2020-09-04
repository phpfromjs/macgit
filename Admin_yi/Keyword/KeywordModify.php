<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<?php
if (!empty($_GET['pID']))
{
    $id = $_GET['pID'];
    $page = $_GET['page'];
    $sql = "SELECT * FROM ".$data['keyword']." WHERE id='$id' AND qy=".$_SESSION['qy']."";
    $result = mysql_query($sql, $conn) or die("ERROR:".mysql_error());
    $res = mysql_fetch_array($result);
    if (mysql_num_rows($result) != 0)
    {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>搜索关键词</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/laydate.js"></script>
<script language = "javascript">
function CheckForm()
{
    if (document.myform.title.value == "" && document.myform.title_en.value == "")
    {
        alert("分类名称全部不能为空！");
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
        <li><a href="#">搜索关键词</a></li>
        <li><a href="#">修改关键词</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>搜索关键词</span></div>
    <form method="post" name="myform" onSubmit="return CheckForm();" action="KeywordSave.php?action=Modify">
    <ul class="forminfo">
        <li><label>排序</label><input type="text" id="sort" name="sort" value="<?php echo $res['sort'];?>" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=<?php echo $res['sort'];?>;}" class="dfinput" style="width:100px;" /><i></i></li>
        <li><label>链接名称</label><input type="text" id="title" name="title" value="<?php echo $res['title'];?>" class="dfinput" /><i>（中文）</i></li>
        <li ><label>链接名称</label><input type="text" id="title_en" name="title_en" value="<?php echo $res['title_en'];?>" class="dfinput" /><i>（英文）</i></li>
        <li><label>链接地址</label><input type="text" id="linkurl" name="linkurl" value="<?php echo $res['linkurl'];?>" class="dfinput" /><i>（中文）</i></li>
        <li><label>链接地址</label><input type="text" id="linkurl_en" name="linkurl_en" value="<?php echo $res['linkurl_en'];?>" class="dfinput" /><i>（英文）</i></li>
        <li style="display:none;"><label>文件名</label><input name="filename" id="filename" type="text" class="dfinput" style="width:250px;" value="<?php echo $res['filename'];?>" /><input type="checkbox" name="crpy" value="" onclick="javascript:CreatePinYin()" />获取拼音<i>*（生成静态文件名）</i></li>
        <li style="display:none;">
            <label>缩略图</label>
            <input type="hidden" id="cls_imgX" name="cls_imgX" value="../../<?php echo $res['spic'];?>" size="53" class="tx1" />
            <iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=cls_imgX&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe>
            <i>
                <?php
                if ($res['spic'] != "")
                {
                ?>
                <a href="javascript:;" onMouseOver="document.getElementById('pic1').style.display='block';" onMouseOut="document.getElementById('pic1').style.display='none';">图片已上传</a>&nbsp;&nbsp;[<a href="ProFileDel.php?id=<?php echo $res['id'];?>&fld=spic" style="color:#FF0000;">删除</a>]
                <div id="pic1" style="position:absolute;z-index:1;display:none;"><img src="../../<?php echo $res['spic'];?>" border="0" width="100" style="border:1px solid #000000;" /></div>
                <?php
                }
                else
                {
                ?>
                图片暂无！
                <?php
                }
                ?>
                （中文）尺寸:160px X 160px
            </i>
        </li>
        <li style="display:none;">
            <label>缩略图</label>
            <input type="hidden" id="cls_imgD" name="cls_imgD" value="../../<?php echo $res['bpic'];?>" size="53" class="tx1" />
            <iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=cls_imgD&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe>
            <i>
                <?php
                if ($res['bpic'] != "")
                {
                ?>
                <a href="javascript:;" onMouseOver="document.getElementById('pic2').style.display='block';" onMouseOut="document.getElementById('pic2').style.display='none';">图片已上传</a>&nbsp;&nbsp;[<a href="ProFileDel.php?id=<?php echo $res['id'];?>&amp;fld=bpic" style="color:#FF0000;">删除</a>]
                <div id="pic2" style="position:absolute;z-index:1;display:none;"><img src="../../<?php echo $res['bpic'];?>" border="0" width="100" style="border:1px solid #000000;" /></div>
                <?php
                }
                else
                {
                ?>
                图片暂无！
                <?php
                }
                ?>
                （英文）尺寸:160px X 160px
            </i>
        </li>
        <li style="display:none;"><label>分类摘要</label><textarea id="text" name="text" cols="" rows="" class="textinput"><?php echo $res['text'];?></textarea><i>（中文）</i></li>
        <li style="display:none;"><label>分类摘要</label><textarea id="text_en" name="text_en" cols="" rows="" class="textinput"><?php echo $res['text_en'];?></textarea><i>（英文）</i></li>
        <li><label>通过审核</label><cate><input type="checkbox" id="Passed2" name="passed" value="1" <?php if ($res['passed'] != 0){echo "checked";} ?> /></cate><i>（如果选中的话将直接发布）</i></li>
        <li style="display:none;"><label>推荐显示</label><input type="checkbox" id="tj" name="tj" value="1" <?php if ($res['tj'] != 0){echo "checked";} ?> /><i>（如果选中的话将推荐显示）</i></li>
        <li><label>录入时间</label><input type="text" id="UpdateTime" name="UpdateTime" value="<?php echo $res['addTime'];?>" maxlength="50" class="dfinput" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" /><i></i></li>
        <li><label>&nbsp;</label><input type="submit" name="" value="确认保存" class="btn" /><input type="hidden" id="pid" name="pid" value="<?php echo $res['id'];?>" /><input type="hidden" id="page" name="page" value="<?php echo $page;?>" /></li>
    </ul>
    </form>
</div>
<?php
    }
}
?>
</body>
</html>
