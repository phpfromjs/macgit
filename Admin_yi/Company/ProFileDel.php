<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<?php
if (!empty($_GET['id']))
{
    $sql = "SELECT * FROM ".$data['pro']." WHERE id=".$_GET['id'];
    $resul = mysql_query($sql, $conn) or die("ERROR:".mysql_error());
    $rse = mysql_fetch_array($resul);
    if (mysql_num_rows($resul) != 0)
    {
        if (!empty($_GET['fld']))
        {
            $pic = "../../".$rse[$_GET['fld']];
            delFile($pic);
            $hpic = "";
            if ($_GET['fld'] == "spic")
            {
                $sqll = "UPDATE ".$data['pro']." SET spic='$hpic' WHERE id=".$_GET['id'];
            }
            else
            {
                $sqll = "UPDATE ".$data['pro']." SET ".$_GET['fld']."='$hpic' WHERE id=".$_GET['id'];
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