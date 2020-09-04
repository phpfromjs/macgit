<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../css/css.css" type="text/css">
<?php
$username = $_POST['uid'];
$realname = $_POST['realname'];
$depart = $_POST['depart'];
$openflag = $_POST['openflag'];
$Password = md5($_POST['pwd1']);
?>
<?php
if (!empty($_POST['action']))
{
    $action = $_POST['action'];
    switch($action)
    {
        case "add";
            $string = "INSERT INTO ".$data['admin']."(openflag,username,realname,depart,Password) VALUES('{$openflag}','{$username}','{$realname}','{$depart}','{$Password}')";
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:AdminList.php");
            break;
        case "modify";
            $pid = $_POST['pid'];
            if (!empty($_POST['pwd1']))
            {
                $string = "UPDATE ".$data['admin']." SET openflag='$openflag',realname='$realname',depart='$depart',Password='$Password' WHERE id=".$pid;
                mysql_query($string, $conn) or die("ERROR: ".mysql_error());
                header("Location:AdminList.php");
                exit;
            }
            else
            {
                $string = "UPDATE ".$data['admin']." SET openflag='$openflag',realname='$realname',depart='$depart' WHERE id=".$pid;
                mysql_query($string, $conn) or die("ERROR: ".mysql_error());
                header("Location:AdminList.php");
                exit;
            }
            break;
    }
}
?>
