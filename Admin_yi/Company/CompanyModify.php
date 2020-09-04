<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
$sjk = $data['classcompany'];
?>
<?php
if (!empty($_GET['pID']))
{
    $id = $_GET['pID'];
    $page = $_GET['page'];
    $sql = "SELECT * FROM ".$data['company']." WHERE id='$id'";
    $result = mysql_query($sql, $conn) or die("ERROR:".mysql_error());
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
                echo $rs['class_name_cn']."<br>";
                ShowTree($rs['classid'], $conn1, $date1);
                $m--;
                echo "</option>";
            }
        }
        $m1 = 0;
        $pp1 = $res['classid1'];
        function ShowTree1($parentID, $conn, $date)
        {
            $conn1 = $conn;
            $date1 = $date;
            global $m1;
            global $pp1;
            $m1++;
            $sql = "SELECT * FROM ".$date1." WHERE prv_id='".$parentID."' ORDER BY sort ASC";
            $resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
            if (mysql_num_rows($resul) == 0 && $m1 == 1)
            {
                echo "该频道暂无分类";
            }
            while ($rs = mysql_fetch_array($resul))
            {
                if (intval($rs['classid']) == intval($pp1))
                {
                    $sele = "selected='selected'";
                }
                else
                {
                    $sele = "";
                }
                echo "<option value='".$rs['classid'] ."'".$sele.">";
                for ($n = 1; $n <= $m1; $n++)
                {
                    if ($n == $m1 && $m1 == 1)
                    {
                        echo "├";
                    }
                    elseif ($n == 1)
                    {			  
                        echo "  ├";
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
<title>客户服务</title>
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
    if (document.myform.title.value == "")
    {
        alert("分类名称不能为空！");
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
</script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">客户服务</a></li>
        <li><a href="#">修改内容</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>修改内容</span></div>
    <form method="POST" name="myform" onSubmit="return CheckForm();" action="CompanySave.php?action=Modify">
    <ul class="forminfo">
        <li><label>所属类别</label><select name="classid" class="dfinput" style="width:180px;"><?php ShowTree(0, $conn, $sjk)?></select><i></i></li>
        <li><label>内容排序</label><input type="text" id="sort" name="sort" value="<?php echo $res['sort'];?>" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=<?php echo $res['sort'];?>;}" class="dfinput" style="width:100px;" /><i></i></li>
        <li><label>浏览次数</label><input type="text" id="hits" name="hits" value="<?php echo $res['hits'];?>" class="dfinput" style="width:100px;" /><i></i></li>
        <li><label>内容名称</label><input type="text" id="title" name="title" value="<?php echo $res['title'];?>" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>内容名称</label><input type="text" id="title_en" name="title_en" value="<?php echo $res['title_en'];?>" class="dfinput" /><i>（英文）</i></li>
        <li style="display:none;"><label>内容型号</label><input type="text" id="model" name="model" value="<?php echo $res['model'];?>" class="dfinput" /><i></i></li>
        <li style="display:none;"><label>市场价格</label><input type="text" id="price" name="price" value="<?php echo $res['price'];?>" class="dfinput" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=1;}" /><i>（必须是数字）</i></li>
        <li style="display:none;"><label>促销价格</label><input type="text" id="price1" name="price1" value="<?php echo $res['price1'];?>" class="dfinput" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=1;}" /><i>（必须是数字）</i></li>
        <li>
            <label>内容图片</label>
            <input type="hidden" id="spic" name="spic" value="../../<?php echo $res['spic'];?>" size="53" class="tx1" />
            <iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=spic&uppath=proimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe>
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
            <label>内容图片</label>
            <input type="hidden" id="bpic" name="bpic" value="../../<?php echo $res['bpic'];?>" size="53" class="tx1" />
            <iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=bpic&uppath=proimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe>
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
        <?php
        if (!empty($res['mpic']))
        {
            $arrPic = explode("|", $res['mpic']);
            $pCount = count($arrPic)+1;
            for ($a = 1; $a <= $pCount; $a++)
            {
                $arrImg[$a] = $arrPic[$a-1];
            }
        }
        else
        {
            $pCount = 0;
        }
        ?>
        <?php
        for ($i = 1; $i <= 4; $i++)
        {
        ?>
        <li id="myTR_<?php echo $i;?>" style="display:none;">
            <label>更多图片</label>
            <input type="hidden" id="pic_<?php echo $i;?>" name="pic_<?php echo $i;?>" value="<?php echo $arrImg[$i];?>" size="53" class="tx1" />
            <iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=pic_<?php echo $i;?>&uppath=proimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="23" style="top:2px;"></iframe>
            <i>
                <?php
                if (!empty($arrImg[$i]))
                {
                ?>
                <a href="javascript:;" onMouseOver="document.getElementById('viewPic<?php echo $i;?>').style.display='block';" onMouseOut="document.getElementById('viewPic<?php echo $i;?>').style.display='none';">图片已上传</a>
                <div id="viewPic<?php echo $i;?>" style="position:absolute;z-index:1;display:none;"><img src="../../<?php echo $arrImg[$i];?>" width="100" border="0" style="border:1px solid #000000;" /></div>
                <?php
                }
                else
                {
                ?>
                图片暂无！
                <?php
                }
                ?>
                <?php
                if (!empty($arrImg[$i]))
                {
                ?>
                <a href="ProFileDel1.php?id=<?php echo $res['id'];?>&pic=<?php echo $arrImg[$i];?>">删除文件</a>
                <?php
                }
                else
                {
                ?>
                <input type="button" id="buttondel<?php echo $i;?>" name="buttondel<?php echo $i;?>" value="删除" onclick="DelFile(<?php echo $i;?>);pic_<?php echo $i;?>.value='';" />
                <?php
                }
                ?>
                尺寸:160px* 160px
            </i>
        </li>
        <?php
        }
        ?>
        <li style="display:none;"><label>内容参数</label><textarea id="text" name="text" cols="" rows="" class="textinput"><?php echo $res['text'];?></textarea><i>（中文）</i></li>
        <li style="display:none;"><label>内容参数</label><textarea id="text_en" name="text_en" cols="" rows="" class="textinput"><?php echo $res['text_en'];?></textarea><i>（英文）</i></li>
        <li><label>内容详情<i><br />（中文）</i></label><textarea id="content" name="content" cols="" rows="" class="textinput2"><?php echo $res['content'];?></textarea></li>
        <li style="display:none;"><label>内容详情<i><br />（英文）</i></label><textarea id="content_en" name="content_en" cols="" rows="" class="textinput2"><?php echo $res['content_en'];?></textarea></li>
        <li><b>SEO信息设置</b></li>
        <li><label>网页标题</label><input type="text" id="t" name="t" value="<?php echo $res['t'];?>" class="dfinput2" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页标题</label><input type="text" id="t_en" name="t_en" value="<?php echo $res['t_en'];?>" class="dfinput2" /><i>（英文）</i></li>
        <li><label>网页关键字</label><input type="text" id="k" name="k" value="<?php echo $res['k'];?>" class="dfinput2" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页关键字</label><input type="text" id="k_en" name="k_en" value="<?php echo $res['k_en'];?>" class="dfinput2" /><i>（英文）</i></li>
        <li><label>网站描述</label><textarea id="d" name="d" cols="" rows="" class="textinput"><?php echo $res['d'];?></textarea><i>（中文）</i></li>
        <li style="display:none;"><label>网站描述</label><textarea id="d_en" name="d_en" cols="" rows="" class="textinput"><?php echo $res['d_en'];?></textarea><i>（英文）</i></li>
        <li><label>通过审核</label><cate><input type="checkbox" id="Passed2" name="passed" value="1" <?php if ($res['passed'] != 0){echo "checked";} ?> /></cate><i>（如果选中的话将直接发布）</i></li>
        <li style="display:none;"><label>推荐显示</label><input type="checkbox" id="tj" name="tj" value="1" <?php if ($res['tj'] != 0){echo "checked";} ?> /><i>（如果选中的话将推荐显示）</i></li>
        <li style="display:none;"><label>置顶显示</label><input type="checkbox" id="isnew" name="isnew" value="1" <?php if ($res['isnew'] != 0){echo "checked";} ?> /><i>（如果选中的话将置顶显示）</i></li>
        <li><label>录入时间</label><input type="text" id="UpdateTime" name="UpdateTime" value="<?php echo $res['addTime'];?>" class="dfinput" /><i></i></li>
        <li><label>&nbsp;</label><input type="hidden" id="pid" name="pid" value="<?php echo $res['id'];?>" /><input type="submit" name="" value="确认保存" class="btn" /></li>
    </ul>
    </form>
</div>
<?php
    }
}
?>
</body>
</html>
