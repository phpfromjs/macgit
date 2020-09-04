<?php
defined("_EXEC") or die("没有权限访问");
require_once "Controller.php";
require_once "Module.php";
$act = ($_GET['act'] != "") ? $_GET['act'] : "View_Index";
$_GET['channelName'] = base64_decode(str_replace(" ", "+", $_GET['channelName']));
//获取控制器
if ($_GET['ctr']!="")
{
    $path = "./".str_replace("_", "/", $_GET['ctr']).".php";
    if (file_exists($path))
    {
        require_once $path;
        new $_GET['ctr']($act);
    }
    else
    {
        echo '无法链接 '.$path.' 文件';
    }
}

?>