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
    "webinfo" => $prefix."webinfo"
);

define("FCK_Path", 'fckeditor/'); //设置FCK编辑器路径
require_once '../inc/Ext/conn.php';
require_once 'sqlin.php';
?>
<?php
$sFile = 'http://'.$_SERVER['HTTP_HOST'];
$sFile1 = $_SERVER['REQUEST_URI'];
if (strstr($sFile1, "2014"))
{
    $sFile .= "/2014";
}

class Controller
{
    var $module;
    var $postfix;

    /**
     * 生成静态页
     * $sFilePath 模版URL
     * $FilePath 生成目标文件
     */
    function create_html($sFilePath, $FilePath)
    {
        $sFilePath = $sFilePath."&sjs=".rand(1000,10000);
        if (!function_exists('file_get_contents'))//看是否有定义函数
        {
            $content = file_get_contents($sFilePath);	//读取文件内容
            $fp = fopen("../../".$FilePath, "w");
            fwrite($fp, $content);
            fclose($fp);
        }
        else
        {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $sFilePath);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ch);
            $fp = fopen("../../".$FilePath, "w");
            fwrite($fp, $file_contents );
            fclose($fp);
            curl_close($ch);
        }
    }

    //删除目标文件
    function delFile($file)
    {
        if (!is_file("../../".$file))
        {
            return false;
        }
        @chmod("../../".$file, 0777);
        @unlink("../../".$file);
        return true;
    }
}
define('ROOT_PATH', str_replace('conn1.php', '', str_replace('\\', '/', __FILE__)));
require_once(ROOT_PATH.'Ext/myclass.php'); 
require_once(ROOT_PATH.'Ext/Module.php'); 
$db = Ext_Sql::getInstance();
$db->connect($database, $host, $user, $password);
$module = new Ext_Module();

?>