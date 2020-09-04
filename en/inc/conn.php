<?php
session_start();
date_default_timezone_set('PRC'); //设置时区中国
$lifeTime = 24 * 60 * 60; //一天
setcookie(session_name(), session_id(), time() + $lifeTime, "/");
define("_EXEC", 1); //定义权限设置
header("Content-Type:text/html; charset=utf-8"); //设置页面编码
defined("_EXEC") or die("没有权限访问");
error_reporting("E_ALL"); //显示错误
define('XINC_PATH', str_replace("\\", '/', dirname(__FILE__)));//cn/inc
define('XROOT_PATH', dirname(XINC_PATH));//cn
require(XROOT_PATH.'/../inc/mysql_data.php'); //引入数据库配置文件
if(is_file($_SERVER['DOCUMENT_ROOT'].'/safe/360webscan.php'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/safe/360webscan.php');
} // 注意文件路径
/* add by wengwenjin 安全文件 end */
define('dbprefix', 'wl_');
//$data为数据库数组
$data = array(
    "about" => $prefix."about",
    "classabout" => $prefix."classabout",
    "logistics" => $prefix."logistics",
    "classlogistics" => $prefix."classlogistics",
    "banner" => $prefix."banner",
    "classbanner" => $prefix."classbanner",
    "admin" => $prefix."admin",
    "candidate" => $prefix."candidate",
    "case" => $prefix."case",
    "classcase" => $prefix."classcase",
    "classcompany" => $prefix."classcompany",
    "classdown" => $prefix."classdown",
    "classgas" => $prefix."classgas",
    "classhotel" => $prefix."classhotel",
    "classnews" => $prefix."classnews",
    "classpicture" => $prefix."classpicture",
    "classpro" => $prefix."classpro",
    "classrecruit" => $prefix."classrecruit",
    "classvideo" => $prefix."classvideo",
    "company" => $prefix."company",
    "download" => $prefix."download",
    "feedback" => $prefix."feedback",
    "gas" => $prefix."gas",
    "guanggao" => $prefix."guanggao",
    "home" => $prefix."home",
    "hotel" => $prefix."hotel",
    "news" => $prefix."news",
    "order" => $prefix."order",
    "picture" => $prefix."picture",
    "pro" => $prefix."pro",
    "recruit" => $prefix."recruit",
    "user" => $prefix."user",
    "video" => $prefix."video",
    "contact" => $prefix."contact",
    "link" => $prefix."link",
    "keyword" => $prefix."keyword",
    "wapinfo" => $prefix."wapinfo",
    "webinfo" => $prefix."webinfo"
);

require_once 'Ext/myclass.php';
$db = Ext_Sql::getInstance();
$db->connect($database, $host, $user, $password);
require_once 'public.php'; //公共函数
$db->query("SELECT * FROM ".$data['webinfo']);
$webinfort = $db->getRow();
if ($db->num_rows() != 0)
{
    $about = $webinfort['about']; //首页关于我们
    $culture = $webinfort['culture']; //首页企业文化
    $contact = $webinfort['contact']; //首页联系我们
    $footer = $webinfort['footer']; //底部版权信息
    $sitephone = $webinfort['sitephone']; //服务热线
    $checkurl=$webinfort['checkurl'];//货件查询链接
    $checkurlen=$webinfort['checkurlen'];//货件查询链接
    $companycn=$webinfort['companycn'];//公司名称
    $companyen=$webinfort['companyen'];//公司名称
    $address = $webinfort['address']; //地址
    $telephone = $webinfort['telephone']; //电话
    $logo_cn = $webinfort['logo_cn']; //logo
    $logo_en = $webinfort['logo_en']; //logo
    $fax = $webinfort['fax']; //传真
    $qq = $webinfort['qq']; //qq
    $url = $webinfort['url']; //网址
    $icp = $webinfort['icp']; //备案号
    $wechatcode = $webinfort['wechatcode']; //公众平台二维码
    $selfwechatcode = $webinfort['selfwechatcode']; //个人平台二维码
    $sitemail = $webinfort['sitemail'];
    $wexplain = $webinfort['wexplain'];
    $copyright = $webinfort['copyright'];
    $titlett = $webinfort['title_en']; //网站标题
    $keyword = $webinfort['keyword_en']; //网站关键字
    $descript = $webinfort['descript_en']; //网站描述
}
$db->query("SELECT * FROM ".$data['wapinfo']);
$wapinfort = $db->getRow();
if ($db->num_rows() != 0)
{
    $about = $wapinfort['about']; //首页关于我们
    $culture = $wapinfort['culture']; //首页企业文化
    $contact = $wapinfort['contact']; //首页联系我们
    $footer = $wapinfort['footer']; //底部版权信息
    $sitephone = $wapinfort['sitephone']; //服务热线
    $address = $wapinfort['address']; //地址
    $telephone = $wapinfort['telephone']; //电话
    $fax = $wapinfort['fax']; //传真
    $url = $wapinfort['url']; //网址
    $icp = $wapinfort['icp']; //备案号
    $wechatcode = $wapinfort['wechatcode']; //公众平台二维码
    $selfwechatcode = $wapinfort['selfwechatcode']; //个人平台二维码
    $sitemail = $wapinfort['sitemail'];
    $wexplain = $wapinfort['wexplain'];
    $copyright = $wapinfort['copyright'];
    $titlett = $wapinfort['title']; //网站标题
    $keyword = $wapinfort['keyword']; //网站关键字
    $descript = $wapinfort['descript']; //网站描述
}
?>
<?php
function cutout($String, $Length, $Append = false)
{
    if (strlen($String) <= $Length)
    {
        return $String;
    }
    else
    {
        $I = 0;
        while ($I < $Length)
        {
            $StringTMP = substr($String, $I, 1);
            if (ord($StringTMP) >= 224)
            {
                $StringTMP = substr($String, $I, 3);
                $I = $I + 3;
            }
            elseif (ord($StringTMP) >= 192)
            {
                $StringTMP = substr($String, $I, 2);
                $I = $I + 2; 
            }
            else
            { 
                $I = $I + 1;
            }
            $StringLast[] = $StringTMP;
        }
        $StringLast = implode("", $StringLast);
        if ($Append)
        {
            $StringLast .= "...";
        }
        return $StringLast;
    }
}

//读取
function query($sql)
{
    $q = @mysql_query($sql) or die("error".mysql_error());
    return $q;
}

//删除 更新
function execute($sql)
{
    $q = @mysql_query($sql) or die("error".mysql_error());
}

//返回列表
function fetch($result)
{
    $f = @mysql_fetch_array($result);
    return $f;
}

//判断是否有记录
function isrecord($res)
{
    $n = @mysql_num_rows($res);
    if ($n > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

//返回一条记录true,false
function tf($sql)
{
    $q = @mysql_query($sql) or die("error".mysql_error());
    $n = @mysql_num_rows($q);
    if ($n > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

//信息判断，返回上一页。
//$msg 信息显示
function gotos($msg)
{
    echo "<script language=javascript>alert('$msg');</script>";
    echo "<script language=javascript>history.go(-1);</script>";
    exit;
}

//信息判断，返回指定页
//$msg 信息显示
//url 跳转地址
function gotourl($msg, $url)
{
    echo "<script language=javascript>alert('$msg');</script>";
    echo "<script language=javascript>this.location.href='$url';</script>";
}

function gourl($url)
{
    echo "<script language=javascript>this.location.href='$url';</script>";
    exit;
}

//获取IP地址
function getip()
{
    if (!empty($_SERVER["HTTP_CLIENT_IP"]))
    {
        $cip = $_SERVER["HTTP_CLIENT_IP"];
	}
    else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    else if(!empty($_SERVER["REMOTE_ADDR"]))
    {
        $cip = $_SERVER["REMOTE_ADDR"];
    }
    else
    {
        $cip = "无法获取！";
    }
    return $cip;
}

$url_this = $_SERVER['PHP_SELF'];
$url_thisp = explode("/", $url_this);
$pCountp = count($url_thisp)-1;
//echo $url_thisp[$pCountp];
?>
<?php require "sqlin.php";?>
<?php
if (!empty($_GET['classid']))
{
    $classid=(int)$_GET['classid'];
}
else
{
    $classid = 0;
}
if (!empty($_GET['id']))
{
    $id = (int)$_GET['id'];
}
else
{
    $id = 0;
}
if (!empty($_GET['page']))
{
    $page = (int)$_GET['page'];
}
else
{
    $page = 1;
}
if (!empty($_GET['px']))
{
    $px = (int)$_GET['px'];
}
else
{
    $px = 1;
}
if (!empty($_GET['xs']))
{
    $xs = (int)$_GET['xs'];
}
else
{
    $xs = 1;
}

//判断下级分类是否有
function prvid($prv, $dates)
{
    global $data;
    $sql = "SELECT * FROM ".$data[$dates]." WHERE prv_id=".$prv." ORDER BY sort ASC";
    $resul = query($sql);
    if (isrecord($resul))
    {
        return true;  
    }
    else
    {
        return false;
    }
}

//递归输出分类路径
function getNav($cid, $strNav, $dates)
{
    global $data;
    $sql = "SELECT * FROM ".$data[$dates]." WHERE classid='".$cid."' ORDER BY sort ASC";
    $resul = query($sql);
    while ($rs = fetch($resul))
    {
        if (prvid($rs['classid'], $dates))
        {
            $surt = "index1";
        }
        else
        {
            $surt = "index2";
        }
        if (empty($strNav))
        {
            $strNav = "&nbsp;&gt;&nbsp;".$rs['class_name_cn']."&nbsp";
        }
        else
        {
            $strNav = "".$rs['class_name_cn']."&nbsp;&gt;&nbsp;".$strNav;
        }
        if ($rs['prv_id'] != 0)
        {
            $getNav = getNav($rs['prv_id'], $strNav, $dates);
        }
        else
        {
            echo $strNav;
        }
    }
}

//获取src
function build_src($get,$cs)
{
    $temp = '';
    if (!is_array($get))
    {
        return false;
    }
    foreach ($get as $key => $v)
    {
        if ($key <> $cs)
        {
            $temp.=$key."=".$v."&";
        }
    }
    if (!empty($temp))
    {
        $temp = "?".substr($temp, 0, strlen($temp)-1);
    }
    else
    {
        $temp = "";
    }
    return $temp;
}

?>
