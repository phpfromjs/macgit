<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<?php
if (!empty($_GET['id']))
{
    $sql = "DELETE FROM ".$data['admin']." WHERE id='".$_GET['id']."'"; 
    mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
    echo "<script language='javascript'> window.alert('信息删除成功！'); location='AdminList.php';</script>";
    exit;
}
else
{
    echo "<script language='javascript'> window.alert('数据错误！'); location='AdminList.php';</script>";
    exit;
}
?>