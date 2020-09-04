<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站基本信息</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
if ($_POST['action'] == "add")
{
    $openflag = $_POST['openflag'];
    $siteurl = $_POST['siteurl'];
    $sitephone = $_POST['sitephone'];
    //20170830
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    $fax = $_POST['fax'];
    $url = $_POST['url'];
    $icp = $_POST['icp'];
    $wechatcode= str_replace("../../", "", $_POST['wechatcode']);
    $selfwechatcode= str_replace("../../", "", $_POST['selfwechatcode']);
    //20180830
    $sitemail = $_POST['sitemail'];
    $wexplain = $_POST['wexplain'];
    $copyright = $_POST['copyright'];
    $title = $_POST['title'];
    $title_en = $_POST['title_en'];
    $title_j = $_POST['title_j'];
    $keyword = $_POST['keyword'];
    $keyword_en = $_POST['keyword_en'];
    $keyword_j = $_POST['keyword_j'];
    $descript = $_POST['descript'];
    $descript_en = $_POST['descript_en'];
    $descript_j = $_POST['descript_j'];
    mysql_query("UPDATE ".$data['wapinfo']." SET openflag='$openflag',siteurl='$siteurl',sitemail='$sitemail',sitephone='$sitephone',address='$address',telephone='$telephone',fax='$fax',url='$url',icp='$icp',wechatcode='$wechatcode',selfwechatcode='$selfwechatcode',wexplain='$wexplain',copyright='$copyright',title='$title',title_en='$title_en',title_j='$title_j',keyword='$keyword',keyword_en='$keyword_en',keyword_j='$keyword_j',descript='$descript',descript_en='$descript_en',descript_j='$descript_j' ", $conn) or die("ERROR: ".mysql_error());
    echo "<script language='javascript'>window.alert('修改成功！'); location=index.php;</script>";
}
?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">系统设置</a></li>
        <li><a href="#">网站基本信息</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>基本信息</span></div>
    <?php
    $sql = "SELECT * FROM ".$data['wapinfo']." ORDER BY id DESC";
    $result = mysql_query($sql, $conn) or die("Error:".mysql_error());
    $res = mysql_fetch_array($result);
    if (mysql_num_rows($result) != 0)
    {
    ?>
    <form name="myform" method="post" action="index.php">
    <ul class="forminfo">
        <li style="display: none"><label>是否开启</label><cite><input type="radio" name="openflag" value="1" <?php if ($res['openflag'] == 1){echo "checked";} ?> />是&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="openflag" value="0" <?php if ($res['openflag'] == 0){echo "checked";} ?> />否</cite></li>
        <li><label>网站域名</label><input type="text" id="siteurl" name="siteurl" value="<?php echo $res['siteurl'];?>" class="dfinput" /><i></i></li>
        <li><label>服务热线</label><input type="text" id="sitephone" name="sitephone" value="<?php echo $res['sitephone'];?>" class="dfinput" /><i></i></li>
        <li><label>地址</label><input type="text" id="address" name="address" value="<?php echo $res['address'];?>" class="dfinput" /><i></i></li>
        <li><label>电话</label><input type="text" id="telephone" name="telephone" value="<?php echo $res['telephone'];?>" class="dfinput" /><i></i></li>
        <li><label>传真</label><input type="text" id="fax" name="fax" value="<?php echo $res['fax'];?>" class="dfinput" /><i></i></li>
        <li><label>网址</label><input type="text" id="url" name="url" value="<?php echo $res['url'];?>" class="dfinput" /><i></i></li>
        <li><label>备案号</label><input type="text" id="icp" name="icp" value="<?php echo $res['icp'];?>" class="dfinput" /><i></i></li>
        <li><label>公众平台二维码</label><input type="hidden" id="wechatcode" name="wechatcode" class="dfinput"  value="../../<?php echo $res['wechatcode'];?>"/><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=wechatcode&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="23" style="top:2px;"></iframe><i><?php
                if ($res['wechatcode'] != "")
                {
                    ?>
                    <a href="javascript:;" onMouseOver="document.getElementById('pic').style.display='block';" onMouseOut="document.getElementById('pic').style.display='none';">图片已上传</a>&nbsp;&nbsp;[<a href="ProFileDel.php?id=<?php echo $res['id'];?>&fld=wechatcode" style="color:#FF0000;">删除</a>]
                    <div id="pic" style="position:absolute;z-index:1;display:none;"><img src="../../<?php echo $res['wechatcode'];?>" width="100" border="0" style="border:1px solid #000000;" /></div>
                    <?php
                }
                else
                {
                    ?>
                    图片暂无！
                    <?php
                }
                ?>
                （中文）尺寸:160px X 160px</i></li>
        <li ><label>个人微信二维码</label><input type="hidden" id="selfwechatcode" name="selfwechatcode" class="dfinput" value="../../<?php echo $res['selfwechatcode'];?>"/><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=selfwechatcode&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="23" style="top:2px;"></iframe><i>   <?php
                if ($res['selfwechatcode'] != "")
                {
                    ?>
                    <a href="javascript:;" onMouseOver="document.getElementById('pic1').style.display='block';" onMouseOut="document.getElementById('pic1').style.display='none';">图片已上传</a>&nbsp;&nbsp;[<a href="ProFileDel.php?id=<?php echo $res['id'];?>&fld=selfwechatcode" style="color:#FF0000;">删除</a>]
                    <div id="pic1" style="position:absolute;z-index:1;display:none;"><img src="../../<?php echo $res['selfwechatcode'];?>" width="100" border="0" style="border:1px solid #000000;" /></div>
                    <?php
                }
                else
                {
                    ?>
                    图片暂无！
                    <?php
                }
                ?>
                （中文）尺寸:160px X 160px</i></li>
        <li style="display:none;"><label>网站邮箱</label><input type="text" id="sitemail" name="sitemail" value="<?php echo $res['sitemail'];?>" class="dfinput" /><i></i></li>
        <li style="display:none;"><label>版权信息</label><textarea id="wexplain" name="wexplain" cols="" rows="" class="textinput"><?php echo $res['wexplain'];?></textarea><i></i></li>
        <li><label>版权信息</label><textarea id="copyright" name="copyright" cols="" rows="" class="textinput"><?php echo $res['copyright'];?></textarea><i></i></li>
        <li><b>SEO信息设置</b></li>
        <li><label>网站标题</label><input type="text" id="title" name="title" value="<?php echo $res['title'];?>" class="dfinput" /><i> &nbsp;一般不超过80个字符</i></li>
        <li style="display:none;"><label>网站标题</label><input type="text" id="title_en" name="title_en" value="<?php echo $res['title_en'];?>" class="dfinput" /><i>（英文）</i></li>
        <li style="display:none;"><label>网站标题</label><input type="text" id="title_j" name="title_j" value="<?php echo $res['title_j'];?>" class="dfinput" /><i>（繁体）</i></li>
        <li><label>网站关键字</label><input type="text" id="keyword" name="keyword" value="<?php echo $res['keyword'];?>" class="dfinput2" /><i> &nbsp;多个关键字用“|”隔开，一般不超过100个字符</i></li>
        <li style="display:none;"><label>网站关键字</label><input type="text" id="keyword_en" name="keyword_en" value="<?php echo $res['keyword_en'];?>" class="dfinput2" /><i>（英文）</i></li>
        <li style="display:none;"><label>网站关键字</label><input type="text" id="keyword_j" name="keyword_j" value="<?php echo $res['keyword_j'];?>" class="dfinput2" /><i>（繁体）</i></li>
        <li><label>网站描述</label><textarea name="descript" cols="" rows="" class="textinput"><?php echo $res['descript'];?></textarea><i>一般不超过200个字符</i></li>
        <li style="display:none;"><label>网站描述</label><textarea name="descript_en" cols="" rows="" class="textinput"><?php echo $res['descript_en'];?></textarea><i>（英文）</i></li>
        <li style="display:none;"><label>网站描述</label><textarea name="descript_j" cols="" rows="" class="textinput"><?php echo $res['descript_j'];?></textarea><i>（繁体）</i></li>
        <li><label>&nbsp;</label><input type="submit" name="" value="确认保存" class="btn" /><input type="hidden" id="action" name="action" value="add" /></li>
    </ul>
    </form>
    <?php
    }
    ?>
</div>
</body>
</html>
