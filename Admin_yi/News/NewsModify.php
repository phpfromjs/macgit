<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
$sjk = $data['classnews'];
?>
<?php
if (!empty($_GET['pID']))
{
    $id = $_GET['pID'];
    $page = $_GET['page'];
    $sql = "SELECT * FROM ".$data['news']." WHERE id='$id'";
    $result = mysql_query($sql, $conn) or die("Error:".mysql_error());
    $res = mysql_fetch_array($result);
    if (mysql_num_rows($result) != 0)
    {
?>
<?php
        $m = 0;
        $pp = $res['classid'];
        function ShowTree($parentID, $conn, $date)
        {
            $conn1 = $conn;
            $date1 = $date;
            global $m;
            global $pp;
            $m++;
            $sql = "SELECT * FROM ".$date1." WHERE prv_id='".$parentID."' ORDER BY sort ASC";
            $resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
            if (mysql_num_rows($resul) == 0 && $m == 1)
            {
                echo "该频道暂无分类";
            }
            while ($rs = mysql_fetch_array($resul))
            {
                if (intval($rs['classid']) == intval($pp))
                {
                    $sele = "selected='selected'";
                }
                else
                {
                    $sele = "";
                }
                if ($rs['lx'] == 0)
                {
                    $lx = "无图";
                }
                else
                {
                    $lx = "有图";
                }
                if ($rs['classid'] == 0 || $rs['classid'] == 0)
                {
                    echo "<optgroup label=".$rs['class_name_cn'].">";
                }
                else
                {
                    echo "<option value='".$rs['classid'] ."'".$sele.">";
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
<title>新闻中心</title>
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
        alert("新闻名称全部不能为空！");
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
        <li><a href="#">新闻中心</a></li>
        <li><a href="#">修改新闻</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>修改新闻</span></div>
    <form method="post" name="myform" onSubmit="return CheckForm();" action="NewsSave.php?action=modify" target="_self">
    <input type="hidden" id="pid" name="pid" value="<?php echo $res['id'];?>" />
    <ul class="forminfo">
        <li><label>所属类别</label><select name="classid" class="dfinput" style="width:180px;"><?php ShowTree(0, $conn, $sjk)?></select><i></i></li>
        <li><label>新闻排序</label><input type="text" id="sort" name="sort" value="<?php echo $res['sort'];?>" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=<?php echo $res['sort'];?>;}" class="dfinput" style="width:100px;" /><i></i></li>
        <li><label>浏览次数</label><input type="text" id="hits" name="hits" value="<?php echo $res['hits'];?>" class="dfinput" style="width:100px;" /><i></i></li>
        <li><label>新闻名称</label><input type="text" id="title" name="title" value="<?php echo $res['title'];?>" class="dfinput" /><i>（中文）</i></li>
        <li ><label>新闻名称</label><input type="text" id="title_en" name="title_en" value="<?php echo $res['title_en'];?>" class="dfinput" /><i>（英文）</i></li>
        <li style="display: none">
            <label>缩略图</label>
            <input type="hidden" id="cls_imgX" name="cls_imgX" value="../../<?php echo $res['spic'];?>" size="53" class="tx1" />
            <iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=cls_imgX&uppath=newimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe>
            <i>
                <?php
                if ($res['spic'] != "")
                {
                ?>
                <a href="javascript:;" onMouseOver="document.getElementById('pic1').style.display='block';" onMouseOut="document.getElementById('pic1').style.display='none';">图片已上传</a>&nbsp;&nbsp;[<a href="ProFileDel.php?id=<?php echo $res['id'];?>&fld=spic" style="color:#FF0000;">删除</a>]
                <div id="pic1" style="position:absolute;z-index:1;display:none;"><img src="../../<?php echo $res['spic'];?>" width="100" border="0" style="border:1px solid #000000;" /></div>
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
            <iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=cls_imgD&uppath=newimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe>
            <i>
                <?php
                if ($res['bpic'] != "")
                {
                ?>
                <a href="javascript:;" onMouseOver="document.getElementById('pic2').style.display='block';" onMouseOut="document.getElementById('pic2').style.display='none';">图片已上传</a>&nbsp;&nbsp;[<a href="ProFileDel.php?id=<?php echo $res['id'];?>&fld=bpic" style="color:#FF0000;">删除</a>]
                <div id="pic2" style="position:absolute;z-index:1;display:none;"><img src="../../<?php echo $res['bpic'];?>" width="100" border="0" style="border:1px solid #000000;" /></div>
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
        <li style="display: none"><label>作者</label><input type="text" id="author" name="author" value="<?php echo $res['author'];?>" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>作者</label><input type="text" id="author_en" name="author_en" value="<?php echo $res['author_en'];?>" class="dfinput" /><i>（英文）</i></li>
        <li style="display: none"><label>新闻摘要</label><textarea id="text" name="text" cols="" rows="" class="textinput"><?php echo $res['text'];?></textarea><i>（中文）</i></li>
        <li style="display:none;"><label>新闻摘要</label><textarea id="text_en" name="text_en" cols="" rows="" class="textinput"><?php echo $res['text_en'];?></textarea><i>（英文）</i></li>
        <li><label>新闻内容<i><br />（中文）</i></label><textarea id="content" name="content" cols="" rows="" class="textinput2"><?php echo $res['content'];?></textarea></li>
        <li ><label>新闻内容<i><br />（英文）</i></label><textarea id="content_en" name="content_en" cols="" rows="" class="textinput2"><?php echo $res['content_en'];?></textarea></li>
        <li style="display: none"><b>SEO信息设置</b></li>
        <li style="display: none"><label>网页标题</label><input type="text" id="t" name="t" value="<?php echo $res['t'];?>" class="dfinput2" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页标题</label><input type="text" id="t_en" name="t_en" value="<?php echo $res['t_en'];?>" class="dfinput2" /><i>（英文）</i></li>
        <li style="display: none"><label>网页关键字</label><input type="text" id="k" name="k" value="<?php echo $res['k'];?>" class="dfinput2" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页关键字</label><input type="text" id="k_en" name="k_en" value="<?php echo $res['k_en'];?>" class="dfinput2" /><i>（英文）</i></li>
        <li style="display: none"><label>网页描述</label><textarea id="d" name="d" cols="" rows="" class="textinput"><?php echo $res['d'];?></textarea><i>（中文）</i></li>
        <li style="display:none;"><label>网页描述</label><textarea id="d_en" name="d_en" cols="" rows="" class="textinput"><?php echo $res['d_en'];?></textarea><i>（英文）</i></li>
        <li><label>通过审核</label><cate><input type="checkbox" id="Passed2" name="passed" value="1" <?php if ($res['passed'] != 0){echo "checked";} ?> /></cate><i>（如果选中的话将直接发布）</i></li>
        <li style="display: none"><label>推荐显示</label><input type="checkbox" id="tj" name="tj" value="1" <?php if ($res['tj'] != 0){echo "checked";} ?> /><i>（如果选中的话将首页显示）</i></li>
        <li style="display: none"><label>置顶显示</label><input type="checkbox" id="isnew" name="isnew" value="1" <?php if ($res['isnew'] != 0){echo "checked";} ?> /><i>（如果选中的话将置顶显示）</i></li>
        <li><label>录入时间</label><input type="text" id="UpdateTime" name="UpdateTime" value="<?php echo $res['addTime'];?>" maxlength="50" class="dfinput" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" /><i></i></li>
        <li><label>&nbsp;</label><input type="submit" name="" value="确认保存" class="btn" /></li>
    </ul>
    </form>
</div>
<?php
    }
}
?>
</body>
</html>
