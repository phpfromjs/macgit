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
    $consultline = $_POST['consultline'];
    //20170830
    $companycn = $_POST['companycn'];
    $companyen = $_POST['companyen'];
    $checkurl = $_POST['checkurl'];
    $checkurlen = $_POST['checkurlen'];
    $addresscn = $_POST['addresscn'];
    $addressen = $_POST['addressen'];
    $telephonecn = $_POST['telephonecn'];
    $telephoneen = $_POST['telephoneen'];
    $mobilephonecn = $_POST['mobilephonecn'];
    $mobilephoneen = $_POST['mobilephoneen'];
    $emailcn = $_POST['emailcn'];
    $emailen = $_POST['emailen'];
    $faxcn = $_POST['faxcn'];
    $faxen = $_POST['faxen'];
    $logo_cn= str_replace("../../", "", $_POST['logo_cn']);
    $logo_en= str_replace("../../", "", $_POST['logo_en']);
    $qq= $_POST['qq'];
    $url = $_POST['url'];
    $icp = $_POST['icp'];
    $icpen = $_POST['icpen'];
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
    mysql_query("UPDATE ".$data['webinfo']." SET openflag='$openflag',siteurl='$siteurl',sitemail='$sitemail',sitephone='$sitephone',consultline='$consultline',companycn='$companycn',companyen='$companyen',checkurl='$checkurl',checkurlen='$checkurlen',addresscn='$addresscn',addressen='$addressen',telephonecn='$telephonecn',telephoneen='$telephoneen',mobilephonecn='$mobilephonecn',mobilephoneen='$mobilephoneen',emailcn='$emailcn',emailen='$emailen',faxcn='$faxcn',faxen='$faxen',logo_cn='$logo_cn',logo_en='$logo_en',qq='$qq',url='$url',icp='$icp',icpen='$icpen',wechatcode='$wechatcode',selfwechatcode='$selfwechatcode',wexplain='$wexplain',copyright='$copyright',title='$title',title_en='$title_en',title_j='$title_j',keyword='$keyword',keyword_en='$keyword_en',keyword_j='$keyword_j',descript='$descript',descript_en='$descript_en',descript_j='$descript_j' ", $conn) or die("ERROR: ".mysql_error());
    echo "<script language='javascript'>window.alert('修改成功！'); location='index.php';</script>";
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
    $sql = "SELECT * FROM ".$data['webinfo']." ORDER BY id DESC";
    $result = mysql_query($sql, $conn) or die("Error:".mysql_error());
    $res = mysql_fetch_array($result);
    if (mysql_num_rows($result) != 0)
    {
    ?>
    <form name="myform" method="post" action="index.php">
    <ul class="forminfo">
        <li style="display: none"><label>是否开启</label><cite><input type="radio" name="openflag" value="1" <?php if ($res['openflag'] == 1){echo "checked";} ?> />是&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="openflag" value="0" <?php if ($res['openflag'] == 0){echo "checked";} ?> />否</cite></li>
        <li><label>网站域名</label><input type="text" id="siteurl" name="siteurl" value="<?php echo $res['siteurl'];?>" class="dfinput" /><i></i></li>
        <li ><label>咨询热线</label><input type="text" id="sitephone" name="sitephone" value="<?php echo $res['sitephone'];?>" class="dfinput" /><i></i></li>
        <li ><label>咨询热线</label><input type="text" id="consultline" name="consultline" value="<?php echo $res['consultline'];?>" class="dfinput" /><i></i></li>
        <li><label>公司名称</label><input type="text" id="companycn" name="companycn" value="<?php echo $res['companycn'];?>" class="dfinput" /><i>（中文）</i></li>
        <li><label>公司名称</label><input type="text" id="companyen" name="companyen" value="<?php echo $res['companyen'];?>" class="dfinput" /><i>（英文）</i></li>
        <li style="display:none;"><label>货件查询链接</label><input type="text" id="checkurl" name="checkurl" value="<?php echo $res['checkurl'];?>" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>货件查询链接</label><input type="text" id="checkurlen" name="checkurlen" value="<?php echo $res['checkurlen'];?>" class="dfinput" /><i>（英文）</i></li>
        <li><label>地址</label><input type="text" id="addresscn" name="addresscn" value="<?php echo $res['addresscn'];?>" class="dfinput" /><i>（中文）</i></li>
        <li><label>地址</label><input type="text" id="addressen" name="addressen" value="<?php echo $res['addressen'];?>" class="dfinput" /><i>（英文）</i></li>
        <li><label>电话</label><input type="text" id="telephonecn" name="telephonecn" value="<?php echo $res['telephonecn'];?>" class="dfinput" /><i>（中文）</i></li>
        <li><label>电话</label><input type="text" id="telephoneen" name="telephoneen" value="<?php echo $res['telephoneen'];?>" class="dfinput" /><i>（英文）</i></li>
        <li style="display:none;"><label>手机</label><input type="text" id="mobilephonecn" name="mobilephonecn" value="<?php echo $res['mobilephonecn'];?>" class="dfinput" /><i>（中文）</i></li>
        <li style="display:none;"><label>手机</label><input type="text" id="mobilephoneen" name="mobilephoneen" value="<?php echo $res['mobilephoneen'];?>" class="dfinput" /><i>（英文）</i></li>
        <li><label>邮箱</label><input type="text" id="emailcn" name="emailcn" value="<?php echo $res['emailcn'];?>" class="dfinput" /><i>（中文）</i></li>
        <li><label>邮箱</label><input type="text" id="emailen" name="emailen" value="<?php echo $res['emailen'];?>" class="dfinput" /><i>（英文）</i></li>
        <li style="display: none"><label>传真</label><input type="text" id="faxcn" name="faxcn" value="<?php echo $res['faxcn'];?>" class="dfinput" /><i>（中文）</i></li>
        <li style="display: none"><label>传真</label><input type="text" id="faxen" name="faxen" value="<?php echo $res['faxen'];?>" class="dfinput" /><i>（英文）</i></li>
        <li ><label>logo</label><input type="hidden" id="logo_cn" name="logo_cn" class="dfinput"  value="../../<?php echo $res['logo_cn'];?>"/><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=logo_cn&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="23" style="top:2px;"></iframe><i><?php
                if ($res['logo_cn'] != "")
                {
                    ?>
                    <a href="javascript:;" onMouseOver="document.getElementById('logo1').style.display='block';" onMouseOut="document.getElementById('logo1').style.display='none';">图片已上传</a>&nbsp;&nbsp;[<a href="ProFileDel.php?id=<?php echo $res['id'];?>&fld=logo_cn" style="color:#FF0000;">删除</a>]
                    <div id="logo1" style="position:absolute;z-index:1;display:none;"><img src="../../<?php echo $res['logo_cn'];?>" width="100" border="0" style="border:1px solid #000000;" /></div>
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
        <li ><label>logo</label><input type="hidden" id="logo_en" name="logo_en" class="dfinput" value="../../<?php echo $res['logo_en'];?>"/><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=logo_en&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="23" style="top:2px;"></iframe><i>   <?php
                if ($res['logo_en'] != "")
                {
                    ?>
                    <a href="javascript:;" onMouseOver="document.getElementById('logo2').style.display='block';" onMouseOut="document.getElementById('logo2').style.display='none';">图片已上传</a>&nbsp;&nbsp;[<a href="ProFileDel.php?id=<?php echo $res['id'];?>&fld=logo_en" style="color:#FF0000;">删除</a>]
                    <div id="logo2" style="position:absolute;z-index:1;display:none;"><img src="../../<?php echo $res['logo_en'];?>" width="100" border="0" style="border:1px solid #000000;" /></div>
                    <?php
                }
                else
                {
                    ?>
                    图片暂无！
                    <?php
                }
                ?>
                （英文）尺寸:160px X 160px</i></li>
        <li style="display: none"><label>QQ</label><input type="text" id="qq" name="qq" value="<?php echo $res['qq'];?>" class="dfinput" /><i></i></li>
        <li style="display: none"><label>网址</label><input type="text" id="url" name="url" value="<?php echo $res['url'];?>" class="dfinput" /><i></i></li>
        <li><label>备案号</label><input type="text" id="icp" name="icp" value="<?php echo $res['icp'];?>" class="dfinput" /><i>（中文）</i></li>
        <li><label>备案号</label><input type="text" id="icpen" name="icpen" value="<?php echo $res['icpen'];?>" class="dfinput" /><i>（英文）</i></li>
        <li style="display:none;"><label>微信二维码</label><input type="hidden" id="wechatcode" name="wechatcode" class="dfinput"  value="../../<?php echo $res['wechatcode'];?>"/><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=wechatcode&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="23" style="top:2px;"></iframe><i><?php
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
        <li style="display:none;"><label>个人微信</label><input type="hidden" id="selfwechatcode" name="selfwechatcode" class="dfinput" value="../../<?php echo $res['selfwechatcode'];?>"/><iframe id="UploadFiles" src="../upfile/upload.php?formname=myform&editname=selfwechatcode&uppath=pic&filelx=jpg" frameborder="0" scrolling="No" width="280" height="23" style="top:2px;"></iframe><i>   <?php
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
                （英文）尺寸:160px X 160px</i></li>
        <li style="display:none;"><label>网站邮箱</label><input type="text" id="sitemail" name="sitemail" value="<?php echo $res['sitemail'];?>" class="dfinput" /><i></i></li>
        <li ><label>版权信息</label><textarea id="copyright" name="copyright" cols="" rows="" class="textinput"><?php echo $res['copyright'];?></textarea><i>（中文）</i></li>
        <li ><label>版权信息</label><textarea id="wexplain" name="wexplain" cols="" rows="" class="textinput"><?php echo $res['wexplain'];?></textarea><i>（英文）</i></li>
        <li><b>SEO信息设置</b></li>
        <li><label>网站标题</label><input type="text" id="title" name="title" value="<?php echo $res['title'];?>" class="dfinput" /><i> &nbsp;一般不超过80个字符</i></li>
        <li ><label>网站标题</label><input type="text" id="title_en" name="title_en" value="<?php echo $res['title_en'];?>" class="dfinput" /><i>（英文）</i></li>
        <li style="display:none;"><label>网站标题</label><input type="text" id="title_j" name="title_j" value="<?php echo $res['title_j'];?>" class="dfinput" /><i>（繁体）</i></li>
        <li><label>网站关键字</label><input type="text" id="keyword" name="keyword" value="<?php echo $res['keyword'];?>" class="dfinput2" /><i> &nbsp;多个关键字用“|”隔开，一般不超过100个字符</i></li>
        <li ><label>网站关键字</label><input type="text" id="keyword_en" name="keyword_en" value="<?php echo $res['keyword_en'];?>" class="dfinput2" /><i>（英文）</i></li>
        <li style="display:none;"><label>网站关键字</label><input type="text" id="keyword_j" name="keyword_j" value="<?php echo $res['keyword_j'];?>" class="dfinput2" /><i>（繁体）</i></li>
        <li><label>网站描述</label><textarea name="descript" cols="" rows="" class="textinput"><?php echo $res['descript'];?></textarea><i>一般不超过200个字符（英文）</i></li>
        <li ><label>网站描述</label><textarea name="descript_en" cols="" rows="" class="textinput"><?php echo $res['descript_en'];?></textarea><i>（英文）</i></li>
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
