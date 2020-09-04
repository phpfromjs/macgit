<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<?php
$ArticleID = $_GET['id'];
if (empty($ArticleID) || !is_numeric($ArticleID))
{
    echo "不能确定ArticleID的值 [<a href='javascript:history.back();'>返回</a>]";
}
$pic = $_GET['pic'];
if (empty($pic))
{
    echo "不能确定小图的值 [<a href='javascript:history.back();'>返回</a>]";
}
$rs = "SELECT * FROM ".$data['picture']." WHERE id='".$ArticleID."'";
$resul = mysql_query($rs, $conn) or die("ERROR: ".mysql_error());
$rs = mysql_fetch_array($resul);
if (mysql_num_rows($resul) != 0)
{
    $filename = "../../".$pic;
    delFile($filename);
    $pic1 = $pic."|";
    $pic2 = "|".$pic;
    if (strpos($rs['mpic'], $pic1) > -1)
    {
        $mpic = str_replace($pic1, "", $rs['mpic']);
        mysql_query("UPDATE ".$data['picture']." SET mpic='$mpic' WHERE id='{$ArticleID}'", $conn) or die("ERROR: ".mysql_error());
    }
    elseif (strpos($rs['mpic'], $pic2) > -1)
    {
        $mpic = str_replace($pic2, "", $rs['mpic']);
        mysql_query("UPDATE ".$data['picture']." SET mpic='$mpic' WHERE id='{$ArticleID}'", $conn) or die("ERROR: ".mysql_error());
    }
    else
    {
        $mpic = str_replace($pic, "", $rs['mpic']);
        mysql_query("UPDATE ".$data['picture']." SET mpic='$mpic' WHERE id='{$ArticleID}'", $conn) or die("ERROR: ".mysql_error());
    }
}
else
{
    echo "找不到此记录，可能已经被删除 [<a href='javascript:history.back();'>返回</a>]";
}
echo "<script language='javascript'>history.go(-1);</script>";
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