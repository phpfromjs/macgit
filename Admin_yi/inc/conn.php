<?php
defined("_EXEC") or die("没有权限访问");
error_reporting("E_ALL");
session_start();
$lifeTime = 24 * 60 * 60; //一天
setcookie(session_name(), session_id(), time() + $lifeTime, "/");
date_default_timezone_set('PRC'); //设置时区中国
define('XINC_PATH', str_replace("\\", '/', dirname(__FILE__)));
define('XROOT_PATH', dirname(dirname(XINC_PATH)));
require(XROOT_PATH.'/inc/mysql_data.php'); //引入数据库配置文件
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
    "webinfo" => $prefix."webinfo",
);

define("FCK_Path", 'fckeditor/'); //设置FCK编辑器路径
require_once 'inc/Ext/conn.php';
require_once 'sqlin.php';

?>