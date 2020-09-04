<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
$sjk = $data['classgas'];
?>
<?php
$sql = "SELECT * FROM ".$data['gas']." ORDER BY sort DESC";
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
<?php
$m = 0;
function ShowTree($parentID, $conn, $date)
{
    $conn1 = $conn;
    $date1 = $date;
    global $m;
    $m++;
    $sql = "SELECT * FROM ".$date1." WHERE prv_id='".$parentID."' ORDER BY sort ASC";
    $resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
    if (mysql_num_rows($resul) == 0 && $m == 1)
    {
        echo "该频道暂无文章";
    }
    while ($rs = mysql_fetch_array($resul))
    {
        if ($rs['lx'] == 0)
        {
            $lx = "";
        }
        else
        {
            $lx = "";
        }
        if ($rs['classid'] == 0 || $rs['classid'] == 0)
        {
            echo "<optgroup label=".$rs['class_name_cn']."[".$lx."]>";
        }
        else
        {
            echo "<option value='".$rs['classid'] ."'>";
            for ($n = 1; $n <= $m; $n++)
            {
                if ($n == $m && $m == 1)
                {
                    echo "├";
                }
                elseif ($n == 1)
                {			  
                    echo "  ├";
                }
                elseif ($n == $m)
                {			  
                    echo "─";
                }
                else
                {
                    echo "─";
                }
            }
            if (!empty($rs['class_name_cn']))
            {
                echo $rs['class_name_cn']."<br>";
            }
            else
            {
                echo $rs['class_name_en']."<br>";
            }
       }
       ShowTree($rs['classid'], $conn1, $date1);
       $m--;
       if ($rs['classid'] == 11 || $rs['classid'] == 23)
       {
           echo "</optgroup>";
       }
       else
       {
            echo "</option>";
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>安全供气</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/laydate.js"></script>
<script type="text/javascript">
function ChangeInput(objSelect, objInput)
{
    if (!objInput)
    {
        return;
    }
    var str = objInput.value;
    var arr = str.split(",");
    for (var i = 0; i < arr.length; i++)
    {
        if (objSelect.value == arr[i])
        {
            return;
        }
    }
    if (objInput.value == '' || objInput.value == 0 || objSelect.value == 0)
    {
        objInput.value = objSelect.value
    }
    else
    {
        objInput.value += ','+objSelect.value
    }
}

function CheckForm()
{
    if (document.myform.title.value == "" && document.myform.title_en.value == "")
    {
        alert("文章名称全部不能为空！");
        document.myform.title.focus();
        return false;
    }
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
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">安全供气</a></li>
        <li><a href="#">添加文章</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>添加文章</span></div>
    <form method="post" name="myform" onSubmit="return CheckForm();" action="GasSave.php?action=add" target="_self">
    <ul class="forminfo">
        <li><label>所属类别</label><select name="classid" class="dfinput" style="width:180px;"><?php ShowTree(0, $conn, $sjk)?></select><i></i></li>
        <li><label>文章排序</label><input type="text" id="sort" name="sort" value="<?php echo $maxsort;?>" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=<?php echo $maxsort;?>;}" class="dfinput" style="width:100px;" /><i></i></li>
        <li><label>浏览次数</label><input type="text" id="hits" name="hits" value="0" class="dfinput" style="width:100px;" /><i></i></li>
        <li><label>文章名称</label><input type="text" id="title" name="title" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>文章名称</label><input type="text" id="title_en" name="title_en" class="dfinput" /><i>（英文）</i></li>
        <li style="display:none;"><label>缩略图</label><input type="hidden" id="cls_imgX" name="cls_imgX" class="dfinput" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=cls_imgX&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="23" style="top:2px;"></iframe><i>尺寸:362px X 195px</i></li>
        <li style="display:none;"><label>缩略图</label><input type="hidden" id="cls_imgD" name="cls_imgD" class="dfinput" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=cls_imgD&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="23" style="top:2px;"></iframe><i>尺寸:150px X 150px</i></li>
        <li><label>作者</label><input type="text" id="author" name="author" value="城市燃气" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>作者</label><input type="text" id="author_en" name="author_en" value="" class="dfinput" /><i>（英文）</i></li>
        <li><label>文章摘要</label><textarea id="text" name="text" cols="" rows="" class="textinput"></textarea><i>（中文）</i></li>
        <li style="display:none;"><label>文章摘要</label><textarea id="text_en" name="text_en" cols="" rows="" class="textinput"></textarea><i>（英文）</i></li>
        <li><label>文章内容<i><br />（中文）</i></label><textarea id="content" name="content" cols="" rows="" class="textinput2"></textarea></li>
        <li style="display:none;"><label>文章内容<i><br />（英文）</i></label><textarea id="content_en" name="content_en" cols="" rows="" class="textinput2"></textarea></li>
        <li><b>SEO信息设置</b></li>
        <li><label>网页标题</label><input type="text" id="t" name="t" class="dfinput2" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页标题</label><input type="text" id="t_en" name="t_en" class="dfinput2" /><i>（英文）</i></li>
        <li><label>网页关键字</label><input type="text" id="k" name="k" class="dfinput2" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页关键字</label><input type="text" id="k_en" name="k_en" class="dfinput2" /><i>（英文）</i></li>
        <li><label>网页描述</label><textarea id="d" name="d" cols="" rows="" class="textinput"></textarea><i>（中文）</i></li>
        <li style="display:none;"><label>网页描述</label><textarea id="d_en" name="d_en" cols="" rows="" class="textinput"></textarea><i>（英文）</i></li>
        <li><label>通过审核</label><cate><input type="checkbox" id="Passed2" name="passed" value="1" checked="checked" /></cate><i>（如果选中的话将直接发布）</i></li>
        <li><label>推荐显示</label><input type="checkbox" id="tj" name="tj" value="1" /><i>（如果选中的话将首页显示）</i></li>
        <li><label>置顶显示</label><input type="checkbox" id="isnew" name="isnew" value="1" /><i>（如果选中的话将置顶显示）</i></li>
        <li><label>录入时间</label><input type="text" id="UpdateTime" name="UpdateTime" value="<?php echo date("Y-m-d H:i:s");?>" maxlength="50" class="dfinput" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" /><i></i></li>
        <li><label>&nbsp;</label><input type="submit" name="" value="确认保存" class="btn" /></li>
    </ul>
    </form>
</div>
</body>
</html>
