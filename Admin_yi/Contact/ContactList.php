<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<?php
if (isset($_GET['qy']))
{
    if (!empty($_GET['qy']))
    {
        $_SESSION['qy'] = $_GET['qy'];
    }
    else
    {
        $_SESSION['qy'] = 0;
    }
}
if (!empty($_GET['action']))
{
    $action = $_GET['action'];
    switch($action)
    {
        case "tj";
            if (isset($_GET['sign']))
            {
                $sign = $_GET['sign'];
                if ($sign == 1)
                {
                    mysql_query("UPDATE ".$data['contact']." SET tj=0 WHERE id='{$_GET['pid']}' AND qy=".$_SESSION['qy']."", $conn) or die("ERROR: ".mysql_error());
                }
                else
                {
                    mysql_query("UPDATE ".$data['contact']." SET tj=1 WHERE id='{$_GET['pid']}' AND qy=".$_SESSION['qy']."", $conn) or die("ERROR: ".mysql_error());
                }
            }
            header("Location:".$_SESSION['url']."");
            break;
        case "sh";
            if (!empty($_GET['sign']))
            {
                $sign = $_GET['sign'];
                if ($sign == "true")
                {
                    if (!empty($_GET['pid']))
                    {
                        mysql_query("UPDATE ".$data['contact']." SET passed=0 WHERE id='{$_GET['pid']}' AND qy=".$_SESSION['qy']."", $conn) or die("ERROR: ".mysql_error());
                    }
                }
                else
                {
                    if (!empty($_GET['pid']))
                    {
                        mysql_query("UPDATE ".$data['contact']." SET passed=1 WHERE id='{$_GET['pid']}' AND qy=".$_SESSION['qy']."", $conn) or die("ERROR: ".mysql_error());
                    }
                }
            }
            header("Location:".$_SESSION['url']."");
            break;
        case "move";
            $p_sort = -1;
            $m_sort = -1;
            if (!empty($_GET['pid']))
            {
                $resul = mysql_query("SELECT * FROM ".$data['contact']." WHERE id='{$_GET['pid']}' AND qy=".$_SESSION['qy']."", $conn) or die("ERROR: ".mysql_error());
                $tt = mysql_fetch_array($resul);
                if (mysql_num_rows($resul) != 0)
                {
                    $p_sort = $tt['sort'];
                }
            }
            if (!empty($_GET['mid']))
            {
                $resull = mysql_query("SELECT * FROM ".$data['contact']." WHERE id='{$_GET['mid']}' AND qy=".$_SESSION['qy']."", $conn) or die("ERROR: ".mysql_error());
                $ttt = mysql_fetch_array($resull);
                if (mysql_num_rows($resull) != 0)
                {
                    $m_sort = $ttt['sort'];
                }
            }
            if (!empty($_GET['mid']))
            {
                if ($p_sort != -1)
                {
                    $px = "UPDATE ".$data['contact']." SET sort='{$p_sort}' WHERE id='{$_GET['mid']}' AND qy=".$_SESSION['qy']."";
                    mysql_query($px, $conn) or die("ERROR: ".mysql_error());
                }
            }
            if (!empty($_GET['pid']))
            {
                if ($m_sort != -1)
                {
                    mysql_query("UPDATE ".$data['contact']." SET sort='{$m_sort}' WHERE id='{$_GET['pid']}' AND qy=".$_SESSION['qy']."", $conn) or die("ERROR: ".mysql_error());
                }
            }
            header("Location:".$_SESSION['url']."");
            break;
    }
}
?>
<?php
if (empty($_GET['title']))
{
    $sql = "SELECT * FROM ".$data['contact']." WHERE id>0 AND qy=".$_SESSION['qy']." ORDER BY sort ASC";
}
else
{
    $sql = "SELECT * FROM ".$data['contact']." WHERE id>0 AND title LIKE '%".$_GET['title']."%' AND qy=".$_SESSION['qy']." ORDER BY sort ASC";
}
if (!empty($_GET['page']))
{
    if (!empty($_GET['title']))
    {
        $_SESSION['url'] = "ContactList.php?page=".$_GET['page']."&title=".$_GET['title'];
    }
    else
    {
        $_SESSION['url'] = "ContactList.php?page=".$_GET['page'];
    }
}
else
{
    if (!empty($_GET['title']))
    {
        $_SESSION['url'] = "ContactList.php?title=".$_GET['title'];
    }
    else
    {
        $_SESSION['url'] = "ContactList.php";
    }
}
$resull = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>分类列表</title>
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
        <li><a href="#">联系我们</a></li>
        <li><a href="#">分类列表</a></li>
    </ul>
</div>
<div class="rightinfo">
    <div class="tools">
        <form name="searchsoft" method="get" action="ContactList.php">
        <ul class="toolbar">
            <li class="click"><a href="ContactAdd.php?qy=3"><span><img src="../images/t01.png" /></span>添加</a></li>
            <li class="click"><span><img src="../images/ico06.png" width="29" height="25" /></span><input type="text" id="Title3" name="title" value="<?php echo $_GET['title']?>" class="dfinput3"><input type="submit" name="Query" value="搜索" class="btn2" style="cursor:pointer;" /></li>
        </ul>
        </form>
    </div>
    <form name="del" method="post" action="ContactDel.php" onSubmit="return ConfirmDel();">
    <table class="tablelist">
        <thead>
            <tr>
                <th width="5%"><input type="checkbox" id="allbox" name="allbox" value="Check All" onClick="CA();"></th>
                <th width="5%">ID</th>
                <th width="30%">分类名称</th>
                <th width="10%">序号</th>
                <th width="10%">排序</th>
                <th width="10%">发布时间</th>
                <th width="10%">是否审核</th>
                <th width="20%">操作</th>
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
    $sql = "SELECT * FROM ".$data['contact']." WHERE id>0 AND qy=".$_SESSION['qy']." ORDER BY sort ASC LIMIT $offset,$pagesize";
}
else
{
    $sql = "SELECT * FROM ".$data['contact']." WHERE id>0 AND title LIKE '%".$_GET['title']."%' AND qy=".$_SESSION['qy']." ORDER BY sort ASC LIMIT $offset,$pagesize";
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
        $prev_id = 0;
        $next_id = 0;
        $rs = "SELECT * FROM ".$data['contact']." WHERE sort<".$title['sort']." AND qy=".$_SESSION['qy']." ORDER BY sort DESC";
        $prev = mysql_query($rs, $conn) or die("ERROR: ".mysql_error());
        $prevv = mysql_fetch_array($prev);
        if (mysql_num_rows($prev) != 0)
        {
            $prev_id = $prevv['id'];
        }
        $rss = "SELECT * FROM ".$data['contact']." WHERE sort>".$title['sort']." AND qy=".$_SESSION['qy']." ORDER BY sort ASC";
        $next = mysql_query($rss, $conn) or die("ERROR: ".mysql_error());
        $nextt = mysql_fetch_array($next);
        if (mysql_num_rows($next) != 0)
        {
            $next_id = $nextt['id'];
        }
?>
            <tr>
                <td align="center"><input type="checkbox" id="ArticleID" name="ArticleID[<?php echo $i;?>]" value="<?php echo $title['id'];?>" onClick="unselectall()" /></td>
                <td align="center"><?php echo $title['id'];?></td>
                <td align="center"><?php if(!empty($title['title'])){echo $title['title'];}else{echo $title['title_en'];}?></td>
                <td align="center"><?php echo $title['sort'];?></td>
                <td align="center">
                    <?php
                    if ($prev_id != 0)
                    {
                    ?>
                    <a href="ContactList.php?action=move&pid=<?php echo $title['id'];?>&mid=<?php echo $prev_id;?>&page=<?php echo $page;?>">上移</a>
                    <?php
                    }
                    else
                    {
                    ?>
                    上移
                    <?php
                    }
                    ?>
                    <?php
                    if ($next_id != 0)
                    {
                    ?>
                    <a href="ContactList.php?action=move&pid=<?php echo $title['id'];?>&mid=<?php echo $next_id;?>&page=<?php echo $page;?>">&nbsp;&nbsp;下移</a>
                    <?php
                    }
                    else
                    {
                    ?>
                    &nbsp;&nbsp;下移
                    <?php
                    }
                    ?>
                </td>
                <td align="center"><?php echo $title['addTime'];?></td>
                <td align="center">
                    <?php
                    if ($title['passed'] == 1)
                    {
                    ?>
                    <a href="ContactList.php?action=sh&amp;sign=true&amp;pid=<?php echo $title['id'];?>">已审核</a>
                    <?php
                    }
                    else
                    {
                    ?>
                    <font color="#FF0000"><a href="ContactList.php?action=sh&amp;sign=false&amp;pid=<?php echo $title['id'];?>"><font style="color:#FF0000;">未审核</font></a></font>
                    <?php
                    }
                    ?>
                </td>
                <td align="center"><a href="ContactModify.php?pID=<?php echo $title['id'];?>&page=<?php echo $page;?>" class="tablelink">查看</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="ContactDel.php?ArticleID=<?php echo $title['id'];?>" onClick="return ConfirmDel();" class="tablelink" style="color:#FF0000;">删除</a></td>
            </tr>
<?php
    }
}
?>
        </tbody>
    </table>
    <p>&nbsp;</p>
    <div class="tools">
        <input type="image" src="../images/del_btn.jpg" name="" /><input type="hidden" id="Action" name="Action" value="Del">
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