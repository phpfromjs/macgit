<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<?php
$allid = $_POST['ArticleID'];
$id = $_GET['ArticleID'];
if (!empty($allid))
{
    $allidlist = implode(",", $allid);
    if (!empty($allidlist))
    {
        $rs = "SELECT * FROM ".$data['banner']." WHERE id IN($allidlist)";
        $resul = mysql_query($rs, $conn) or die("ERROR: ".mysql_error());
        while ($title = mysql_fetch_array($resul))
        {
            $spic = "../../".$title['spic'];
            $bpic = "../../".$title['bpic'];
            delFile($spic);
            delFile($bpic);
            if (!empty($title['mpic']))
            {
                $arrPic = explode("|", $title['mpic']);
                $pCount = count($arrPic)+1;
                for ($a = 1; $a <= $pCount; $a++)
                {
                    delFile("../../".$arrPic[$a-1]);
                }
            }
        }
        $sql = "DELETE FROM ".$data['banner']." WHERE id IN($allidlist)";
        mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
        echo "<script language='javascript'>window.alert('删除对象成功！'); location='bannerList.php';</script>";
        exit;
    }
}
?>
<?php
if (!empty($id))
{
    $rs = "SELECT * FROM ".$data['banner']." WHERE id='".$id."'";
    $resul = mysql_query($rs, $conn) or die("ERROR: ".mysql_error());
    while ($title = mysql_fetch_array($resul))
    {
        $spic = "../../".$title['spic'];
        $bpic = "../../".$title['bpic'];
        delFile($spic);
        delFile($bpic);
        if (!empty($title['mpic']))
        {
            $arrPic = explode("|", $title['mpic']);
            $pCount = count($arrPic)+1;
            for ($a = 1; $a <= $pCount; $a++)
            {
                delFile("../../".$arrPic[$a-1]);
            }
        }
    }
    $sql = "DELETE FROM ".$data['banner']." WHERE id='".$id."'";
    mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
    echo "<script language='javascript'>window.alert('删除对象成功！'); location='bannerList.php';</script>";
    exit;
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
<script language='javascript'>window.alert('你还没有选择对象！'); history.go(-1);</script>