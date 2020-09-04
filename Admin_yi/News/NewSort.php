<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
$sjk = $data['classnews'];
?>
<?php
$m = 0;
function ShowTree($parentID, $conn, $date)
{
    $conn1 = $conn;
    $date1 = $date;
    global $m;
    $m++;
    $sql = "SELECT * FROM ".$date1." WHERE prv_id=".$parentID." ORDER BY sort ASC";
    $resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
    if (mysql_num_rows($resul) == 0 && $m == 1)
    {
        echo "该频道暂无分类";
    }
    while ($rs = mysql_fetch_array($resul))
    {
        $prev_id = 0;
        $next_id = 0;
        $rs1 = "SELECT * FROM ".$date1." WHERE sort<".$rs['sort']." AND prv_id=".$parentID." ORDER BY sort DESC";
        $prev = mysql_query($rs1, $conn) or die("ERROR: ".mysql_error());
        $prevv = mysql_fetch_array($prev);
        if (mysql_num_rows($prev) != 0)
        {
            $prev_id = $prevv['classid'];
        }
        $rss = "SELECT * FROM ".$date1." WHERE sort>".$rs['sort']." AND prv_id=".$parentID." ORDER BY sort ASC";
        $next = mysql_query($rss, $conn) or die("ERROR: ".mysql_error());
        $nextt = mysql_fetch_array($next);
        if (mysql_num_rows($next) != 0)
        {
            $next_id = $nextt['classid'];
        }
        echo "<div>";
        for ($n = 1; $n <= $m; $n++)
        {
            if ($m == 1)
            {
                echo "<img src='../images/minus.gif' align='absmiddle' />";
            }
            elseif ($n == $m)
            {			  
                echo "<img src='../images/join.gif' align='absmiddle' /><img src='../images/minus.gif' align='absmiddle' />";
            }
            else
            {
                echo "<img src='../images/line.gif' align='absmiddle' />";
            }
        }
        if ($m >= 1)
        {
            $adnext = "";
        }
        else
        {
            $adnext = "&nbsp;<a href=?action=Addnext&prv_id=".$rs['classid']."&all_id=".$rs['all_id']."&level=".$m." class='a1'>添加</a>&nbsp;|&nbsp;";
        } 
        $ednext = "&nbsp;<a href=?action=editClass&pid=".$rs['classid']."&level=".$m." class='a2'>修改</a>&nbsp;|&nbsp;";
        $denext = "&nbsp;<a href=?action=del_myclass&pid=".$rs['classid']." onClick='return ConfirmDelBig();' class='a3'>删除</a>&nbsp;|&nbsp;";
        if ($prev_id != 0)
        {
            $strPrev = "&nbsp;<a href=?action=mv_myclass&pid=".$rs['classid']."&mID=".$prev_id." class='a4'>上移</a>&nbsp;";
        }
        else
        {
            $strPrev = "&nbsp;<b>上移</b>&nbsp;";
        }
        if ($next_id != 0)
        {
            $strNext = "&nbsp;<a href=?action=mv_myclass&pid=".$rs['classid']."&mID=".$next_id." class='a4'>下移</a>&nbsp;";
        }
        else
        {
            $strNext = "&nbsp;<b>下移</b>&nbsp;";
        }
        $mvnext = $strPrev."|".$strNext;			 
        if (!empty($rs['class_name_cn']))
        {
            echo "<b style='font-size:14px;'>".$rs['class_name_cn']."</b>&nbsp;&nbsp;<b class='red'>(ID:".$rs['classid'].")</b>&nbsp;&nbsp;".$adnext.$ednext.$denext.$mvnext."<b class='red'>(".$rs['sort'].")</b></div>";
        }
        else
        {
            echo "<b style='font-size:14px;'>".$rs['class_name_en']."</b>&nbsp;&nbsp;<b class='red'>(ID:".$rs['classid'].")</b>&nbsp;&nbsp;".$adnext.$ednext.$denext.$mvnext."<b class='red'>(".$rs['sort'].")</b></div>";
        }
        ShowTree($rs['classid'], $conn1, $date1);
        $m--;
    }
}
?>
<?php
$sql = "SELECT * FROM ".$data['classnews']." ORDER BY sort DESC";
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
<title>新闻中心</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.white {
    color: #FFFFFF;
}
.red {
    color: #FF0000;
}
.tree {
    font-size: 14px;
}
.tree div {
    height: 28px;
}
.tree a:link,a:visited {
    font-size: 12px;
    color: #0066FF;
}
.tree a:hover {
    font-size: 12px;
    color: #FF0000;
    text-decoration: none;
}
.tree span {
    font-size: 12px;
}
a.a1:link, a.a1:visited {
    color: #0099FF;
}
a.a1:hover {
    color: #FF0000;
    text-decoration: none;
}
a.a2:link, a.a2:visited {
    color: #0066FF;
}
a.a2:hover {
    color: #FF0000;
    text-decoration: none;
}
a.a3:link, a.a3:visited {
    color: #0033CC;
}
a.a3:hover {
    color: #FF0000;
    text-decoration: none;
}
a.a4:link, a.a4:visited {
    color: #7DB1FF;
}
a.a4:hover {
    color: #FF0000;
    text-decoration: none;
}
-->
</style>
<script type="text/javascript">
<!--
function check()
{
    if (document.myform.class_name.value == "" && document.myform.class_name_en.value == "")
    {
        alert("温馨提示\n\n请输入分类名称!");
        document.myform.class_name.focus();
        return false;
    }
}

function check2()
{
    if (document.form2.class_name2.value == "")
    {
        alert("温馨提示\n\n请输入分类名称!");
        document.form2.class_name2.focus();
        return false;
    }
}

function ConfirmDelBig()
{
    if (confirm("确定要删除吗?同时还删除下级分类与相应分类"))
    {
        return true;
    }
    else
    {
        return false;
    }
}
-->
</script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="../js/pinyin.js"></script>
<script type="text/javascript">
function CreatePinYin()
{
    if (document.myform.crpy.checked == true)
    {
        var kk = $("#class_name").val();
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
        <li><a href="#">新闻中心</a></li>
        <li><a href="#">类别管理</a></li>
    </ul>
</div>
<div class="formbody">
<?php
$action = $_GET['action'];
switch($action)
{
    case "";
?>
    <div class="formtitle"><span>类别管理</span><a href="?action=Add_classD" style="text-decoration:none;padding-left:80px;">添加一级分类</a></div>
    <div class="tree"><?php ShowTree(0, $conn, $sjk)?></div>
    <?php
        break;
    case "Add_classD";
    ?>
    <div class="formtitle"><span>添加一级分类</span></div>
    <form name="myform" method="post" action="NewSort.php?action=add_myclass" onSubmit="return check();">
    <ul class="forminfo">
        <li><label>分类排序</label><input type="text" id="sort" name="sort" value="<?php echo $maxsort;?>" maxlength="4" onKeyUp="if (event.keyCode != 37 && event.keyCode != 39) value = value.replace(/\D/g,'');"onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))" class="dfinput" style="width:120px;" /><i>只能是数字</i></li>
        <li><label>分类名称</label><input type="text" id="class_name" name="class_name" value="" class="dfinput" /><i>（中文）</i></li>
        <li ><label>分类名称</label><input type="text" id="class_name_en" name="class_name_en" value="" class="dfinput" /><i>（英文）</i></li>
        <li style="display:none;"><label>分类图片</label><input type="hidden" id="class_img" name="class_img" size="53" class="tx1" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=class_img&uppath=classimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe><i>（中文）尺寸:980px X 300px</i></li>
        <li style="display:none;"><label>分类图片</label><input type="hidden" id="class_img_en" name="class_img_en" size="53" class="tx1" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=class_img_en&uppath=classimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe><i>（英文）尺寸:980px X 300px</i></li>
        <li style="display: none"><b>SEO信息设置</b></li>
        <li style="display: none"><label>网页标题</label><input type="text" id="t" name="t" value="" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页标题</label><input type="text" id="t_en" name="t_en" value="" class="dfinput" /><i>（英文）</i></li>
        <li style="display: none"><label>网页关键字</label><input type="text" id="k" name="k" value="" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页关键字</label><input type="text" id="k_en" name="k_en" value="" class="dfinput" /><i>（英文）</i></li>
        <li style="display: none"><label>网站描述</label><textarea id="d" name="d" cols="" rows="" class="textinput"></textarea><i>（中文）</i></li>
        <li style="display:none;"><label>网站描述</label><textarea id="d_en" name="d_en" cols="" rows="" class="textinput"></textarea><i>（英文）</i></li>
        <li><label>&nbsp;</label><input type="submit" name="" value="确认保存" class="btn" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="" value="返&nbsp;&nbsp;回" class="btn" onclick="javascript:history.back(-1)" /></li>
    </ul>
    </form>
    <?php
        break;
    case "Addnext";
        $prv_id = $_GET['prv_id'];
        $all_id = $_GET['all_id'];
        $level = $_GET['level'];
        $px = "SELECT * FROM ".$data['classnews']." WHERE prv_id=".$prv_id." ORDER BY sort DESC";
        $result = mysql_query($px, $conn) or die("ERROR: ".mysql_error());
        $pxx = mysql_fetch_array($result);
        if (mysql_num_rows($result) == 0)
        {
            $maxsortt = "1";
        }
        else
        {
            $maxsortt = $pxx['sort']+1;
        }
    ?>
    <div class="formtitle"><span>添加二级分类</span></div>
    <form name="myform" method="post" action="NewSort.php?action=add_myclassNext" onSubmit="return check();">
    <input type="hidden" name="prv_id" value="<?php echo $prv_id;?>">
    <input type="hidden" name="all_id" value="<?php echo $all_id;?>">
    <input type="hidden" name="ctype" value="next">
    <ul class="forminfo">
        <li><label>分类排序</label><input type="text" id="sort" name="sort" value="<?php echo $maxsort;?>" maxlength="4" onKeyUp="if (event.keyCode != 37 && event.keyCode != 39) value = value.replace(/\D/g,'');"onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))" class="dfinput" style="width:120px;" /><i>只能是数字</i></li>
        <li><label>分类名称</label><input type="text" id="class_name" name="class_name" value="" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>分类名称</label><input type="text" id="class_name_en" name="class_name_en" value="" class="dfinput" /><i>（英文）</i></li>
        <li style="display:none;"><label>分类图片</label><input type="hidden" id="class_img" name="class_img" size="53" class="tx1" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=class_img&uppath=classimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe><i>（中文）尺寸:980px X 300px</i></li>
        <li style="display:none;"><label>分类图片</label><input type="hidden" id="class_img_en" name="class_img_en" size="53" class="tx1" /><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=class_img_en&uppath=classimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe><i>（英文）尺寸:980px X 300px</i></li>
        <li><b>SEO信息设置</b></li>
        <li><label>网页标题</label><input type="text" id="t" name="t" value="" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页标题</label><input type="text" id="t_en" name="t_en" value="" class="dfinput" /><i>（英文）</i></li>
        <li><label>网页关键字</label><input type="text" id="k" name="k" value="" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页关键字</label><input type="text" id="k_en" name="k_en" value="" class="dfinput" /><i>（英文）</i></li>
        <li><label>网站描述</label><textarea id="d" name="d" cols="" rows="" class="textinput"></textarea><i>（中文）</i></li>
        <li style="display:none;"><label>网站描述</label><textarea id="d_en" name="d_en" cols="" rows="" class="textinput"></textarea><i>（英文）</i></li>
        <li><label>&nbsp;</label><input type="submit" name="" value="确认保存" class="btn" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="" value="返&nbsp;&nbsp;回" class="btn" onclick="javascript:history.back(-1)" /></li>
    </ul>
    </form>
    <?php
        break;
    case "editClass";
    ?>
    <?php
        $pid = $_GET['pid'];
        if (!empty($pid) && is_numeric($pid))
        {
            $level = $_GET['level'];
            $sql = "SELECT * FROM ".$data['classnews']." WHERE classid=".$pid;
            $resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
            if (mysql_num_rows($resul) != 0)
            {
                $rs = mysql_fetch_array($resul);
    ?>
    <div class="formtitle"><span>修改分类</span></div>
    <form name="myform" method="post" action="NewSort.php?action=edit_myclass" onSubmit="return check();">
    <input type="hidden" name="pid" value="<?php echo $pid;?>">
    <ul class="forminfo">
        <li><label>分类排序</label><input type="text" id="sort" name="sort" value="<?php echo $rs['sort'];?>" maxlength="4" onKeyUp="if (event.keyCode != 37 && event.keyCode != 39) value = value.replace(/\D/g,'');"onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))" class="dfinput" style="width:120px;" /><i>只能是数字</i></li>
        <li><label>分类名称</label><input type="text" id="class_name" name="class_name" value="<?php echo $rs['class_name_cn'];?>" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>分类名称</label><input type="text" id="class_name_en" name="class_name_en" value="<?php echo $rs['class_name_en'];?>" class="dfinput" /><i>（英文）</i></li>
        <li style="display:none;">
            <label>分类图片</label>
            <input type="hidden" id="class_img" name="class_img" value="../../<?php echo $rs['class_img'];?>" size="53" class="tx1" />
            <iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=class_img&uppath=classimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe>
            <i>
                <?php
                if ($rs['class_img'] != "")
                {
                ?>
                <a href="javascript:;" onMouseOver="document.getElementById('pic1').style.display='block';" onMouseOut="document.getElementById('pic1').style.display='none';">图片已上传</a>&nbsp;&nbsp;[<a href="NewSort.php?action=del_files&pid=<?php echo $rs['classid'];?>&amp;fld=class_img" style="color:#FF0000;">删除</a>]
                <div id="pic1" style="position:absolute;z-index:1;display:none;"><img src="../../<?php echo $rs['class_img'];?>" width="100" border="0" style="border:1px solid #000000;" /></div>
                <?php
                }
                else
                {
                ?>
                图片暂无！
                <?php
                }
                ?>
                （中文）尺寸:980px X 300px
            </i>
        </li>
        <li style="display:none;">
            <label>分类图片</label>
            <input type="hidden" id="class_img_en" name="class_img_en" value="../../<?php echo $rs['class_img_en'];?>" size="53" class="tx1" />
            <iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=class_img_en&uppath=classimg&filelx=jpg" frameborder="0" scrolling="No" width="280" height="30" style="top:2px;"></iframe>
            <i>
                <?php
                if ($rs['class_img_en'] != "")
                {
                ?>
                <a href="javascript:;" onMouseOver="document.getElementById('pic2').style.display='block';" onMouseOut="document.getElementById('pic2').style.display='none';">图片已上传</a>&nbsp;&nbsp;[<a href="NewSort.php?action=del_files&pid=<?php echo $rs['classid'];?>&amp;fld=class_img_en" style="color:#FF0000;">删除</a>]
                <div id="pic2" style="position:absolute;z-index:1;display:none;"><img src="../../<?php echo $rs['class_img_en'];?>" width="100" border="0" style="border:1px solid #000000;" /></div>
                <?php
                }
                else
                {
                ?>
                图片暂无！
                <?php
                }
                ?>
                （英文）尺寸:980px X 300px
            </i>
        </li>
        <li><b>SEO信息设置</b></li>
        <li><label>网页标题</label><input type="text" id="t" name="t" value="<?php echo $rs['t'];?>" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页标题</label><input type="text" id="t_en" name="t_en" value="<?php echo $rs['t_en'];?>" class="dfinput" /><i>（英文）</i></li>
        <li><label>网页关键字</label><input type="text" id="k" name="k" value="<?php echo $rs['k'];?>" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>网页关键字</label><input type="text" id="k_en" name="k_en" value="<?php echo $rs['k_en'];?>" class="dfinput" /><i>（英文）</i></li>
        <li><label>网站描述</label><textarea id="d" name="d" cols="" rows="" class="textinput"><?php echo $rs['d'];?></textarea><i>（中文）</i></li>
        <li style="display:none;"><label>网站描述</label><textarea id="d_en" name="d_en" cols="" rows="" class="textinput"><?php echo $rs['d_en'];?></textarea><i>（英文）</i></li>
        <li><label>&nbsp;</label><input type="submit" name="" value="确认保存" class="btn" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="" value="返&nbsp;&nbsp;回" class="btn" onclick="javascript:history.back(-1)" /></li>
    </ul>
    </form>
    <?php
            }
            else
            {
                echo "<script>alert('没有找到数据!');history.back();</script>";
            }
        }
        else
        {
            echo "<script>alert('参数错误!');history.back();</script>";
        }
        break;
    case "add_myclass";
        $title = $_POST['class_name'];
        $title_en = $_POST['class_name_en'];
        $title_j = $_POST['class_name_j'];
        $sort = $_POST['sort'];
        $img = str_replace("../../", "", $_POST['class_img']);
        $img_en = str_replace("../../", "", $_POST['class_img_en']);
        $img_j = str_replace("../../", "", $_POST['class_img_j']);
        $p = str_replace("../../", "", $_POST['p']);
        $p_en = str_replace("../../", "", $_POST['p_en']);
        $p_j = str_replace("../../", "", $_POST['p_j']);
        $t = $_POST['t'];
        $t_en = $_POST['t_en'];
        $t_j = $_POST['t_j'];
        $k = $_POST['k'];
        $k_en = $_POST['k_en'];
        $k_j = $_POST['k_j'];
        $d = $_POST['d'];
        $d_en = $_POST['d_en'];
        $d_j = $_POST['d_j'];
        $sql = "SELECT * FROM ".$data['classnews']." WHERE class_name_cn='".$title."'";
        $resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
        if (mysql_num_rows($resul) == 0)
        {
            $string = "INSERT INTO ".$data['classnews']." (prv_id,all_id,class_name_cn,class_name_en,class_name_j,sort,class_img,class_img_en,class_img_j,t,t_en,t_j,k,k_en,k_j,d,d_en,d_j,p,p_en,p_j) VALUES('0','0','$title','$title_en','$title_j','$sort','$img','$img_en','$img_j','{$t}','{$t_en}','{$t_j}','{$k}','{$k_en}','{$k_j}','{$d}','{$d_en}','{$d_j}','{$p}','{$p_en}','{$p_j}')";
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            $sq = "SELECT * FROM ".$data['classnews']." WHERE class_name_cn='".$title."'";
            $pp = mysql_query($sq, $conn) or die("ERROR: ".mysql_error());
            $tt = mysql_fetch_array($pp);
            if (mysql_num_rows($pp) != 0)
            {
                $temp = $tt['classid'];
                $temp2 = "|".$tt['classid']."|";
                $sq1 = "UPDATE ".$data['classnews']." SET all_id='$temp',link_id='$temp2' WHERE class_name_cn='".$title."'";
                mysql_query($sq1, $conn) or die("ERROR: ".mysql_error());
                echo "<script>alert('状态：添加成功');location.href='NewSort.php';</script>";
            }
        }
        else
        {
            echo "<script>alert('此分类已存在!');history.back();</script>";
        }
        break;
    case "edit_myclass";
        $title = $_POST['class_name'];
        $title_en = $_POST['class_name_en'];
        $title_j = $_POST['class_name_j'];
        $sort = $_POST['sort'];
        $pid = $_POST['pid'];
        $img = str_replace("../../", "", $_POST['class_img']);
        $img_en = str_replace("../../", "", $_POST['class_img_en']);
        $img_j = str_replace("../../", "", $_POST['class_img_j']);
        $p = str_replace("../../", "", $_POST['p']);
        $p_en = str_replace("../../", "", $_POST['p_en']);
        $p_j = str_replace("../../", "", $_POST['p_j']);
        $t = $_POST['t'];
        $t_en = $_POST['t_en'];
        $t_j = $_POST['t_j'];
        $k = $_POST['k'];
        $k_en = $_POST['k_en'];
        $k_j = $_POST['k_j'];
        $d = $_POST['d'];
        $d_en = $_POST['d_en'];
        $d_j = $_POST['d_j'];
        $sq = "SELECT * FROM ".$data['classnews']." WHERE classid=".$pid;
        $pp = mysql_query($sq, $conn) or die("ERROR: ".mysql_error());
        if (mysql_num_rows($pp) != 0)
        {
            $sq1 = "UPDATE ".$data['classnews']." SET class_name_cn='$title',class_name_en='$title_en',class_name_j='$title_j',sort='$sort',class_img='$img',class_img_en='$img_en',class_img_j='$img_j',t='$t',t_en='$t_en',t_j='$t_j',k='$k',k_en='$k_en',k_j='$k_j',d='$d',d_en='$d_en',d_j='$d_j',p='$p',p_en='$p_en',p_j='$p_j' WHERE classid=".$pid;
            mysql_query($sq1, $conn) or die("ERROR: ".mysql_error());
            echo "<script>alert('修改成功');location.href='NewSort.php';</script>";
        }
        else
        {
            echo "<script>alert('没有找到数据!');location.href='NewSort.php';</script>";
        }
        break;
    case "del_myclass";
        if (!empty($_GET['pid']))
        {
            //删除当前类
            $rs = "SELECT * FROM ".$data['classnews']." WHERE classid=".$_GET['pid'];
            $resul = mysql_query($rs, $conn) or die("ERROR: ".mysql_error());
            while ($title = mysql_fetch_array($resul))
            {
                $spic = "../../".$title['class_img'];
                delFile($spic);
            }
            $sql = "DELETE FROM ".$data['classnews']." WHERE classid=".$_GET['pid']; 
            mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
            //删除子类
            $rs = "SELECT * FROM ".$data['classnews']." WHERE prv_id=".$_GET['pid'];
            $resul = mysql_query($rs, $conn) or die("ERROR: ".mysql_error());
            while ($title = mysql_fetch_array($resul))
            {
                $spic = "../../".$title['class_img'];
                delFile($spic);
            }
            $sql = "DELETE FROM ".$data['classnews']." WHERE prv_id=".$_GET['pid']; 
            mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
            echo "<script language='javascript'>window.alert('删除对象成功！'); location='NewSort.php';</script>";
        }
        else
        {
            echo "<script language='javascript'>window.alert('数据丢失！'); location='NewSort.php';</script>";
        }
        break;
    case "mv_myclass";
        $p_sort = -1;
        $m_sort = -1;
        if (!empty($_GET['pid']))
        {
            $resul = mysql_query("SELECT * FROM ".$data['classnews']." WHERE classid='{$_GET['pid']}'", $conn) or die("ERROR: ".mysql_error());
            $tt = mysql_fetch_array($resul);
            if (mysql_num_rows($resul) != 0)
            {
                $p_sort = $tt['sort'];
            }
        }
        if (!empty($_GET['mID']))
        {
            $resull = mysql_query("SELECT * FROM ".$data['classnews']." WHERE classid='{$_GET['mID']}'", $conn) or die("ERROR: ".mysql_error());
            $ttt = mysql_fetch_array($resull);
            if (mysql_num_rows($resull) != 0)
            {
                $m_sort = $ttt['sort'];
            }
        }
        if (!empty($_GET['mID']))
        {
            if ($p_sort != -1)
            {
                $px = "UPDATE ".$data['classnews']." SET sort='{$p_sort}' WHERE classid='{$_GET['mID']}'";
                mysql_query($px, $conn) or die("ERROR: ".mysql_error());
            }
        }
        if (!empty($_GET['pid']))
        {
            if ($m_sort != -1)
            {
                mysql_query("UPDATE ".$data['classnews']." SET sort='{$m_sort}' WHERE classid='{$_GET['pid']}'", $conn) or die("ERROR: ".mysql_error());
            }
        }
        header("Location:NewSort.php");
        break;
    case "del_files";
        if (!empty($_GET['pid']) && is_numeric($_GET['pid']))
        {
            $sql = "SELECT * FROM ".$data['classnews']." WHERE classid=".$_GET['pid'];
            $resul = mysql_query($sql, $conn) or die("ERROR:".mysql_error());
            $rse = mysql_fetch_array($resul);
            if (mysql_num_rows($resul) != 0)
            {
                if (!empty($_GET['fld']))
                {
                    $pic = "../../".$rse[$_GET['fld']];
                    delFile($pic);
                    $hpic = "";
                    if ($_GET['fld'] == "class_img")
                    {
                        $sqll="UPDATE ".$data['classnews']." SET class_img='$hpic' WHERE classid=".$_GET['pid'];
                    }
                    else
                    {
                        $sqll = "UPDATE ".$data['classnews']." SET ".$_GET['fld']."='$hpic' WHERE classid=".$_GET['pid'];
                    }
                    mysql_query($sqll, $conn) or die("ERROR:".mysql_error());
                    echo "<script language='javascript'>history.go(-1);</script>";
                }
                else
                {
                    echo "<script language='javascript'>window.alert('不能确定要删除的字段名！'); history.go(-1);</script>";
                }
            }
            else
            {
                echo "<script language='javascript'>window.alert('没有找到数据！'); history.go(-1);</script>";
            }
        }
        else
        {
            echo "<script language='javascript'>window.alert('不能确定ID号！'); history.go(-1);</script>";
        }
        break;
    case "add_myclassNext";
        $title = $_POST['class_name'];
        $title_en = $_POST['class_name_en'];
        $sort = $_POST['sort'];
        $ctype = $_POST['ctype'];
        $prv_id = $_POST['prv_id'];
        $all_id = $_POST['all_id'];
        $img = str_replace("../../", "", $_POST['class_img']);
        $sql = "SELECT * FROM ".$data['classnews']." WHERE class_name_cn='".$title."' AND prv_id=".$prv_id;
        $resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
        if (mysql_num_rows($resul) == 0)
        {
            $string = "INSERT INTO ".$data['classnews']."(prv_id,all_id,class_name_cn,class_name_en,sort,class_img) VALUES('$prv_id','$all_id','$title','$title_en','$sort','$img')";
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            $sq = "SELECT * FROM ".$data['classnews']." WHERE classid='".$prv_id."'";
            $pp = mysql_query($sq, $conn) or die("ERROR: ".mysql_error());
            $tt = mysql_fetch_array($pp);
            if (mysql_num_rows($pp) != 0)
            {
                $temp = $tt['link_id'];
            }
            $sqd = "SELECT * FROM ".$data['classnews']." ORDER BY classid DESC";
            $ppp = mysql_query($sqd, $conn) or die("ERROR: ".mysql_error());
            $ttt = mysql_fetch_array($ppp);
            if (mysql_num_rows($ppp) != 0)
            {
                $temp2 = $ttt['classid'];
                $templink = $temp.$temp2."|";
                $sq1 = "UPDATE ".$data['classnews']." SET link_id='$templink' WHERE classid=".$temp2;
                mysql_query($sq1, $conn) or die("ERROR: ".mysql_error());
                echo "<script>alert('状态：添加成功');location.href='NewSort.php';</script>";
            }
        }
        else
        {
            echo "<script>alert('此分类已存在!');history.back();</script>";
        }
        break;
    ?>
<?php
}
?>
<?php
function delFile($file)
{
    if (!is_file($file))
    {
        return false;
    }
    @chmod($file, 0777);
    @unlink($file);
    return true;
}
?>
</div>
</body>
</html>
