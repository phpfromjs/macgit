<?php
require_once("../inc/AdminCheck.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
</head>
<body>
<?php
function getDirSize($dir)
{
    $sizeResult = 0;
    $handle = opendir($dir);
    while (false !== ($FolderOrFile = readdir($handle)))
    {
        if ($FolderOrFile != "." && $FolderOrFile != "..") 
        {
            if (is_dir("$dir/$FolderOrFile"))
            {
                $sizeResult += getDirSize("$dir/$FolderOrFile"); 
            }
            else
            {
                $sizeResult += filesize("$dir/$FolderOrFile"); 
            }
        }    
    }
    closedir($handle);
    return $sizeResult;
}

//单位自动转换函数
function getRealSize($size)
{
    $kb = 1024; //Kilobyte
    $mb = 1024 * $kb; //Megabyte
    $gb = 1024 * $mb; //Gigabyte
    $tb = 1024 * $gb; //Terabyte

    if ($size < $kb)
    {
        return $size." B";
    }
    else if ($size < $mb)
    {
        return round($size/$kb, 2)." KB";
    }
    else if ($size < $gb)
    {
        return round($size/$mb, 2)." MB";
    }
    else if($size < $tb)
    {
        return round($size/$gb, 2)." GB";
    }
    else
    {
        return round($size/$tb, 2)." TB";
    }
}
//echo getRealSize(getDirSize(dirname($_SERVER['SCRIPT_FILENAME']).'/include/'));
?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
    </ul>
</div>
<div class="mainindex">
    <div class="welinfo">
        <span><img src="../images/sun.png" alt="天气" /></span>
        <b><?php echo $_SESSION['Admin']['Name'];?>
<script language="javaScript">
now = new Date(),hour = now.getHours() 
if (hour < 6){document.write("凌晨好！")} 
else if (hour < 9){document.write("早上好！")} 
else if (hour < 12){document.write("上午好！")} 
else if (hour < 14){document.write("中午好！")} 
else if (hour < 17){document.write("下午好！")} 
else if (hour < 19){document.write("傍晚好！")} 
else if (hour < 22){document.write("晚上好！")} 
else {document.write("夜里好！")}
</script>欢迎使用网站后台管理系统</b>
    </div>
    <div class="welinfo">
        <span><img src="../images/time.png" alt="时间" /></span>
        <i>您上次登录的时间：<?php echo $_SESSION['Admin']['LastLogoutTime'];?></i>（不是您登录的？<a href="../loginout.php" target="_top">请点这里</a>）
    </div>
    <div class="xline"></div>
    <div class="uimakerinfo"><b>系统信息&nbsp;&nbsp;技术支持：<a href="http://www.gdwl.net.cn/" target="_blank">网联科技</a></b></div>
    <div style="padding-left:24px;">
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr class="tr_southidc">
                <td width="30%" height="30">上线时间：<font class="t4"><?php echo $_SESSION['Admin']['sj'];?></font></td>
                <td width="70%">当前IP：<font class="t4"><?php echo $_SERVER['REMOTE_ADDR'];?></font></td>
            </tr>
            <tr class="tr_southidc">
                <td height="30">身份过期：<font class="t4">30分钟</font></td>
                <td>
                    现在时间：<font class="t4">
                    <?php
                    //简单实现时间加减
                    $tomorrow = mktime(date("H")+8,date("i"),date("s"),date("m"),date("d"),date("Y"));
                    echo date("Y-m-d H:i:s",$tomorrow);
                    ?>
                    </font>
                </td>
            </tr>
            <tr class="tr_southidc">
                <td height="30">上线次数： <font class="t4"><?php echo $_SESSION['Admin']['LoginTimes'];?></font></td>
                <td><font class="t4"> 最后退出时间:<?php echo $_SESSION['Admin']['LastLogoutTime'];?></font></td>
            </tr>
            <tr class="tr_southidc">
                <td height="30">服务器版本号：<font class="t4"><?php echo php_uname();?></font></td>
                <td>服务器运行方式：<font class="t4"> <?php echo php_sapi_name() ;?></font></td>
            </tr>
            <tr class="tr_southidc">
                <td height="30">PHP版本：<font class="t4"><?php echo PHP_VERSION;?></font></td>
                <td>Zend版本：<font class="t4"><?php echo Zend_Version();?></font></td>
            </tr>
            <tr class="tr_southidc">
                <td height="30">PHP安装路径：<?php echo DEFAULT_INCLUDE_PATH;?></td>
                <td>当前文件绝对路径：<?php echo __FILE__;?></td>
            </tr>
            <tr class="tr_southidc">
                <td height="30">服务器域名：<?php echo $_SERVER["HTTP_HOST"];?></td>
                <td>服务器IP：<?php echo GetHostByName($_SERVER['SERVER_NAME']);?></td>
            </tr>
            <tr class="tr_southidc">
                <td height="30">服务器解译引擎：<?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
                <td>服务器系统目录：<?php echo $_SERVER['SystemRoot'];?></td>
            </tr>
            <tr class="tr_southidc">
                <td height="30">服务器语言：<?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];?></td>
                <td>服务器Web端口：<?php echo $_SERVER['SERVER_PORT'];?></td>
            </tr>
            <tr class="tr_southidc">
                <td height="60" colspan="2" style="font-size:18px;font-weight:bold;">空间当前使用情况：已经使用&nbsp;<b style="color:#FF0000;font-size:20px;"><?php echo getRealSize(getDirSize(dirname($_SERVER['SCRIPT_FILENAME']).'../../../'));?></b></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
