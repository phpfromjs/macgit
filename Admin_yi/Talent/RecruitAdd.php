<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
$sjk = $data['classrecruit'];
?>
<?php
$sql = "SELECT * FROM ".$data['recruit']." ORDER BY sort DESC";
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
        echo "该频道暂无招聘信息";
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
<title>招聘职位</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/laydate.js"></script>
<script language = "javascript">
function CheckForm()
{
    if (document.myform.job.value == "")
    {
        alert("职位全部不能为空！");
        document.myform.job.focus();
        return false;
    }
    return true;
}
</script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">招聘职位</a></li>
        <li><a href="#">添加职位</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>添加职位</span></div>
    <form method="post" id="myform" name="myform" action="RecruitSave.php?action=add" onSubmit="return CheckForm();" >
    <ul class="forminfo">
        <li><label>招聘类别</label><select name="classid" class="dfinput" style="width:180px;"><?php ShowTree(0, $conn, $sjk)?></select><i></i></li>
        <li><label>职位排序</label><input type="text" id="sort" name="sort" value="<?php echo $maxsort;?>" onBlur="javascript:if(isNaN(this.value)){alert('必须是数字!');this.value=<?php echo $maxsort;?>;}" class="dfinput" style="width:100px;" /><i></i></li>
        <li><label>浏览次数</label><input type="text" id="hits" name="hits" value="0" class="dfinput" style="width:100px;" /><i></i></li>
        <li><label>职位名称</label><input type="text" id="job" name="job" class="dfinput" /><i></i></li>
        <li><label>工作性质</label><input type="text" id="nature" name="nature" class="dfinput" /><i></i></li>
        <li><label>工作地点</label><input type="text" id="place" name="place" class="dfinput" /><i></i></li>
        <li><label>薪资范围</label><input type="text" id="salary" name="salary" class="dfinput" /><i></i></li>
        <li><label>招聘人数</label><input type="text" id="num" name="num" class="dfinput" /><i></i></li>
        <li><label>发布时间</label><input type="text" id="UpdateTime" name="UpdateTime" value="<?php echo date("Y-m-d H:i:s");?>" maxlength="50" class="dfinput" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" /><i></i></li>
        <li><label>截止时间</label><input type="text" id="deadline" name="deadline" value="<?php echo date("Y-m-d H:i:s");?>" maxlength="50" class="dfinput" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" /><i></i></li>
        <li><label>工作职责<i></i></label><textarea id="content" name="content" cols="" rows="" class="textinput"></textarea></li>
        <li><label>任职资格<i></i></label><textarea id="office" name="office" cols="" rows="" class="textinput"></textarea></li>
        <li><label>通过审核</label><cate><input type="checkbox" id="Passed2" name="passed" value="1" checked="checked" /></cate><i>（如果选中的话将直接发布）</i></li>
        <li><label>&nbsp;</label><input type="submit" name="" value="确认保存" class="btn" /></li>
    </ul>
    </form>
</div>
</body>
</html>
