<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
$sjk = $data['classlogistics'];
$sjk1 = $data['classlogistics3'];
?>
<?php
$sql = "SELECT * FROM ".$data['logistics']." ORDER BY sort DESC";
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
        echo "该频道暂无分类";
    }
    while ($rs = mysql_fetch_array($resul))
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
        echo $rs['class_name_cn']."<br>";
        ShowTree($rs['classid'], $conn1, $date1);
        $m--;
        echo "</option>";
    }
}
$m1 = 0;
function ShowTree1($parentID, $conn, $date)
{
    $conn1 = $conn;
    $date1 = $date;
    global $m1;
    $m1++;
    $sql = "SELECT * FROM ".$date1." WHERE prv_id='".$parentID."' ORDER BY sort ASC";
    $resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
    if (mysql_num_rows($resul) == 0 && $m1 == 1)
    {
        echo "该频道暂无分类";
    }
    while ($rs = mysql_fetch_array($resul))
    {
        echo "<option value='".$rs['classid'] ."'>";
        for ($n = 1; $n <= $m1; $n++)
        {
            if ($n == $m1 && $m1 == 1)
            {
                echo "├";
            }
            elseif ($n == 1)
            {
                echo "&nbsp;&nbsp;";
            }
            elseif ($n == $m1)
            {
                echo "─";
            }
            else
            {
                echo "─";
            }
        }
        echo $rs['class_name_cn']."<br>";
        ShowTree1($rs['classid'], $conn1, $date1);
        $m1--;
        echo "</option>";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>产品中心</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
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
    if (document.myform.title.value == "")
    {
        alert("产品名称不能为空！");
        document.myform.title.focus();
        return false;
    }
    return true;
}

function AddFile()
{
    for (var Key = 1; Key <= 4; Key++)
    {
        if (document.getElementById("myTR_"+Key).style.display == 'none')
        {
            document.getElementById("myTR_"+Key).style.display = '';
            break;
        }
    }
}

function DelFile(Key)
{
    document.all("myTR_"+Key).style.display = 'none';
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
KindEditor.ready(function(K){
    editor = K.create('textarea[name="text"]', {
        uploadJson : '../kindeditor/php/upload_json.php',
        fileManagerJson : '../kindeditor/php/file_manager_json.php',
        allowFileManager : true
    });
});
KindEditor.ready(function(K){
    editor = K.create('textarea[name="proshow"]', {
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
        <li><a href="#">产品中心</a></li>
        <li><a href="#">添加产品</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>添加产品</span></div>
    <form method="post" name="myform" onSubmit="return CheckForm();" action="logisticsSave.php?action=add" target="_self">
    <ul class="forminfo">
        <li><label>所属类别</label><select name="classid" class="dfinput" style="width:180px;"><?php ShowTree(0, $conn, $sjk)?></select><i></i></li>
        <li><label>排序</label><input type="text" id="sort" name="sort" value="<?php echo $maxsort;?>" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=<?php echo $maxsort;?>;}" class="dfinput" style="width:100px;" /><i></i></li>
        <li><label>浏览次数</label><input type="text" id="hits" name="hits" value="0" class="dfinput" style="width:100px;" /><i></i></li>
        <li style="display:none;">
            <label>所属品牌</label>
            <select name="brandid" class="dfinput" style="width:180px;">
            <?
            $sqlclass = "SELECT * FROM ".$data['classvideo']." WHERE class_name_cn<>'' ORDER BY sort ASC";
            $resultclass = mysql_query($sqlclass);
            $rowclass = mysql_num_rows($resultclass);
            if ($rowclass < 1)
            {
                echo "<option value='0'>暂无品牌</option>";
            }
            else
            {
                echo "<option value='0'>选择品牌</option>";
                while ($rsclass = mysql_fetch_array($resultclass))
                {
                    echo "<option value=".$rsclass["classid"].">".$rsclass["class_name_cn"]."</option>";
                }
            }
            ?>
            </select>
            <i></i>
        </li>
        <li><label>产品名称</label><input type="text" id="title" name="title" class="dfinput" /><i>（中文）</i></li>
        <li><label>产品名称</label><input type="text" id="title_en" name="title_en" class="dfinput" /><i>（英文）</i></li>
        <li  style="display: none"><label>产品简介</label><input type="text" id="model" name="model" class="dfinput" /><i>（中文）</i></li>
        <li style="display: none"><label>产品简介</label><input type="text" id="model_en" name="model_en" class="dfinput" /><i>（英文）</i></li>
        <li ><label>价格</label><input type="text" id="price" name="price" value="" class="dfinput" /><i>（中文）</i></li>
        <li ><label>价格</label><input type="text" id="price1" name="price1" value="" class="dfinput"  /><i>（英文）</i></li>
        <li ><label>启运地</label><input type="text" id="chandi" name="chandi" value="" class="dfinput" /><i>（中文）</i></li>
        <li ><label>启运地</label><input type="text" id="chandien" name="chandien" value="" class="dfinput"  /><i>（英文）</i></li>
        <li ><label>目的地</label><input type="text" id="caizhi" name="caizhi" value="" class="dfinput" /><i>（中文）</i></li>
        <li ><label>目的地</label><input type="text" id="caizhien" name="caizhien" value="" class="dfinput"  /><i>（英文）</i></li>
        <li ><label>业务范围</label><input type="text" id="workarea" name="workarea" value="" class="dfinput" /><i>（中文）</i></li>
        <li ><label>业务范围</label><input type="text" id="workareaen" name="workareaen" value="" class="dfinput"  /><i>（英文）</i></li>
        <li><label>缩略图</label><input type="hidden" id="spic" name="spic" class="dfinput" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=spic&uppath=proimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe><i>中文</i></li>
        <li><label>缩略图</label><input type="hidden" id="spicen" name="spicen" class="dfinput" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=spicen&uppath=proimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe><i>英文</i></li>
        <li style="display: none"><label>产品大图</label><input type="hidden" id="bpic" name="bpic" class="dfinput" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=bpic&uppath=proimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe><i>中文</i></li>
        <li style="display: none"><label>产品大图</label><input type="hidden" id="bpicen" name="bpicen" class="dfinput" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=bpicen&uppath=proimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe><i>英文</i></li>
        <?php
        for($i = 1; $i <= 2; $i++)
        {
        ?>
        <li  style="display: none" id="myTR_">
            <label>更多图片</label>
            <input type="hidden" id="pic_<?php echo $i;?>" name="pic_<?php echo $i;?>" class="dfinput" />
            <iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=pic_<?php echo $i;?>&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe><i>尺寸:564 X 564px</i>
            <input type="button" id="buttondel<?php echo $i;?>" name="buttondel<?php echo $i;?>" value="删除" onClick="DelFile(<?php echo $i;?>);pic_<?php echo $i;?>.value='';">
        </li>
        <?php
        }
        ?>
        <li style="display: none"><label>产品参数<i><br />（中文）</i></label><textarea id="text" name="text" cols="" rows="" class="textinput2" style="height:250px;"></textarea></li>
        <li style="display: none"><label>产品参数</label><textarea id="text_en" name="text_en" cols="" rows="" class="textinput2" style="height:250px;"></textarea><i>（英文）</i></li>
        <li ><label>产品详情<i><br />（中文）</i></label><textarea id="content" name="content" cols="" rows="" class="textinput2"></textarea></li>
        <li ><label>产品详情<i><br />（英文）</i></label><textarea id="content_en" name="content_en" cols="" rows="" class="textinput2"></textarea></li>
        <li style="display: none"><label>产品展示<i><br />（中文）</i></label><textarea id="proshow" name="proshow" cols="" rows="" class="textinput2"></textarea></li>
        <li style="display: none"><b>SEO信息设置</b></li>
        <li ><label>网页标题</label><input type="text" id="t" name="t" class="dfinput2" /><i>（中文）</i></li>
        <li ><label>网页标题</label><input type="text" id="t_en" name="t_en" class="dfinput2" /><i>（英文）</i></li>
        <li ><label>网页关键字</label><input type="text" id="k" name="k" class="dfinput2" /><i>（中文）</i></li>
        <li ><label>网页关键字</label><input type="text" id="k_en" name="k_en" class="dfinput2" /><i>（英文）</i></li>
        <li ><label>网站描述</label><textarea id="d" name="d" cols="" rows="" class="textinput"></textarea><i>（中文）</i></li>
        <li ><label>网站描述</label><textarea id="d_en" name="d_en" cols="" rows="" class="textinput"></textarea><i>（英文）</i></li>
        <li><label>通过审核</label><cate><input type="checkbox" id="Passed2" name="passed" value="1" checked="checked" /></cate><i>（如果选中的话将直接发布）</i></li>
        <li ><label>推荐显示</label><input type="checkbox" id="tj" name="tj" value="1" /><i>（如果选中的话将推荐显示）</i></li>
        <li style="display:none;"><label>置顶显示</label><input type="checkbox" id="isnew" name="isnew" value="1" /><i>（如果选中的话将置顶显示）</i></li>
        <li><label>录入时间</label><input type="text" id="UpdateTime" name="UpdateTime" value="<?php echo date("Y-m-d H:i:s");?>" maxlength="50" class="dfinput" /><i></i></li>
        <li><label>&nbsp;</label><input type="submit" name="" value="确认保存" class="btn" /></li>
    </ul>
    </form>
</div>
</body>
</html>
