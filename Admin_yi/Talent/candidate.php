<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<?php
if (!empty($_GET['action']))
{
    $action = $_GET['action'];
    switch($action)
    {
        case "sh";
            if (!empty($_GET['sign']))
            {
                $sign = $_GET['sign'];
                if ($sign == "true")
                {
                    if (!empty($_GET['pid']))
                    {
                        mysql_query("UPDATE ".$data['candidate']." SET passed=0 WHERE id='{$_GET['pid']}'", $conn) or die("ERROR: ".mysql_error());
                    }
                }
                else
                {
                    if (!empty($_GET['pid']))
                    {
                        mysql_query("UPDATE ".$data['candidate']." SET passed=1 WHERE id='{$_GET['pid']}'", $conn) or die("ERROR: ".mysql_error());
                    }
                }
            }
            header("Location:".$_SESSION['url']."");
            break;
        case "del";
            $allid = $_POST['ArticleID'];
            $id = $_GET['ArticleID'];
            if (!empty($allid))
            {
                $allidlist = implode(",", $allid);
                if (!empty($allidlist))
                {
                    $sql = "DELETE FROM ".$data['candidate']." WHERE id IN($allidlist)";
                    mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
                    echo "<script language='javascript'>window.alert('删除对象成功！'); location='candidate.php';</script>";
                    exit;
                }
            }
            if (!empty($id))
            {
                $sql = "DELETE FROM ".$data['candidate']." WHERE id='".$id."'";
                mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
                echo "<script language='javascript'>window.alert('删除对象成功！'); location='candidate.php';</script>";
                exit;
            }
            //header("Location:".$_SESSION['url']."");
            break;
    }
}
?>
<?php
if (empty($_GET['title']))
{
    $sql = "SELECT * FROM ".$data['candidate']." WHERE id>0 ORDER BY id DESC";
}
else
{
    $sql = "SELECT * FROM ".$data['candidate']." WHERE id>0 AND job LIKE '%".$_GET['title']."%' ORDER BY id DESC";
}
if (!empty($_GET['page']))
{
    if (!empty($_GET['title']))
    {
        $_SESSION['url'] = "candidate.php?page=".$_GET['page']."&title=".$_GET['title'];
    }
    else
    {
        $_SESSION['url'] = "candidate.php?page=".$_GET['page'];
    }
}
else
{
    if (!empty($_GET['title']))
    {
        $_SESSION['url'] = "candidate.php?title=".$_GET['title'];
    }
    else
    {
        $_SESSION['url'] = "candidate.php";
    }
}
$resull = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>在线应聘</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript">
function CA()
{
    for (var i = 0; i < document.del.ArticleID.length; i++)
    {
        var e = document.del.ArticleID[i];
        if (e.name != 'allbox')
        {
            e.checked = document.del.allbox.checked;
        }
    }
}

function unselectall()
{
    if (document.del.allbox.checked)
    {
        document.del.allbox.checked = document.del.allbox.checked&0;
    }
}
</script>
<script language="javascript">
function ConfirmDel()
{
    if (confirm("确定要删除选中的记录吗？一旦删除将不能恢复！"))
    {
        return true;
    }
    else
    {
        return false;
    }
}
</script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">在线应聘</a></li>
        <li><a href="#">应聘列表</a></li>
    </ul>
</div>
<div class="rightinfo">
    <div class="tools">
        <form name="forms" method="get" action="?">
        <ul class="toolbar">
            <li class="click"><span><img src="../images/ico06.png" width="29" height="25" /></span><input type="text" id="Title3" name="title" value="<?php echo $_GET['title']?>" class="dfinput3"><input type="submit" name="Query" value="搜索" class="btn2" style="cursor:pointer;" /></li>
        </ul>
        </form>
    </div>
    <form name="del" method="post" action="?action=del" onSubmit="return test();">
    <table class="tablelist">
        <thead>
            <tr>
                <th width="5%"><input type="checkbox" id="allbox" name="allbox" value="Check All" onClick="CA();"></th>
                <th width="5%">ID</th>
                <th width="19%">应聘职位</th>
                <th width="9%">姓名</th>
                <th width="10%">手机</th>
                <th width="13%">电子邮箱</th>
                <th width="14%">提交日期</th>
                <th width="9%">操作</th>
            </tr>
        </thead>
        <tbody>
<?php
$rs = mysql_fetch_array($resull);
$num_row = mysql_num_rows($resull);
$pagesize = 15;
$pages = intval($num_row/$pagesize);
if ($num_row % $pagesize)
{
    $pages++;
}
if (!empty($_GET['page']))
{
    $page = intval($_GET['page']);
    if ($page <= 0)
    {
        $page = 1;
    }
    if ($page > $pages)
    {
        $page = 1;
    }
}
else
{
    $page = 1;
}
$offset = $pagesize*($page-1);
if (empty($_GET['title']))
{
    $sql = "SELECT * FROM ".$data['candidate']." WHERE id>0 ORDER BY id DESC LIMIT $offset,$pagesize";
}
else
{
    $sql = "SELECT * FROM ".$data['candidate']." WHERE id>0 AND job LIKE '%".$_GET['title']."%' ORDER BY id DESC LIMIT $offset,$pagesize";
}
$resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
if (mysql_num_rows($resul) == 0)
{
    echo "<tr height='20'><td align='center' colspan='8' bgcolor='#ECF5FF' style='color:#FF0000;font-size:14px;'>";
    echo "没有符合条件的记录!";
    echo "</td></tr>";
}
else
{
    $i = 0;
    while ($title = mysql_fetch_array($resul))
    {
        $i++;
?>
            <tr>
                <td align="center"><input type="checkbox" id="ArticleID" name="ArticleID[<?php echo $i;?>]" value="<?php echo $title['id'];?>" onClick="unselectall()" /></td>
                <td align="center"><?php echo $title['id'];?></td>
                <td align="center"><?php echo $title['job'];?></td>
                <td align="center"><?php echo $title['name'];?></td>
                <td align="center"><?php echo $title['phone'];?></td>
                <td align="center"><?php echo $title['email'];?></td>
                <td align="center"><?php echo $title['addtime'];?></td>
                <td><a href="candidate_look.php?pID=<?php echo $title['id'];?>&page=<?php echo $page;?>">查看</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="candidate.php?ArticleID=<?php echo $title['id'];?>&action=del" onClick="return ConfirmDel();">删除</a></td>
            </tr>
<?php
    }
}
?>
        </tbody>
    </table>
    <p>&nbsp;</p>
    <div class="tools">
        <input type="image" src="../images/del_btn.jpg" name="" />
    </div>
    </form>
    <div style="clear:both;"></div>
    <?php require_once "../inc/page.php";?>
</div>
<script type="text/javascript">
$('.tablelist tbody tr:odd').addClass('odd');
</script>
</body>
</html>
