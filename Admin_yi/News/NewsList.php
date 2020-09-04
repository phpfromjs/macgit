<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
$sjk = $data['classnews'];
?>
<?php
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
                    mysql_query("UPDATE ".$data['news']." SET tj=0 WHERE id='{$_GET['pid']}'", $conn) or die("ERROR: ".mysql_error());
                }
                else
                {
                    mysql_query("UPDATE ".$data['news']." SET tj=1 WHERE id='{$_GET['pid']}'", $conn) or die("ERROR: ".mysql_error());
                }
            }
            header("Location:".$_SESSION['url']."");
            break;
        case "isnew";
            if (isset($_GET['sign']))
            {
                $sign = $_GET['sign'];
                if ($sign == 1)
                {
                    mysql_query("UPDATE ".$data['news']." SET isnew=0 WHERE id='{$_GET['pid']}'", $conn) or die("ERROR: ".mysql_error());
                }
                else
                {
                    mysql_query("UPDATE ".$data['news']." SET isnew=1 WHERE id='{$_GET['pid']}'", $conn) or die("ERROR: ".mysql_error());
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
                        mysql_query("UPDATE ".$data['news']." SET passed=0 WHERE id='{$_GET['pid']}'", $conn) or die("ERROR: ".mysql_error());
                    }
                }
                else
                {
                    if (!empty($_GET['pid']))
                    {
                        mysql_query("UPDATE ".$data['news']." SET passed=1 WHERE id='{$_GET['pid']}'", $conn) or die("ERROR: ".mysql_error());
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
                $resul = mysql_query("SELECT * FROM ".$data['news']." WHERE id='{$_GET['pid']}'", $conn) or die("ERROR: ".mysql_error());
                $tt = mysql_fetch_array($resul);
                if (mysql_num_rows($resul) != 0)
                {
                    $p_sort = $tt['sort'];
                }
            }
            if (!empty($_GET['mid']))
            {
                $resull = mysql_query("SELECT * FROM ".$data['news']." WHERE id='{$_GET['mid']}'", $conn) or die("ERROR: ".mysql_error());
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
                    $px = "UPDATE ".$data['news']." SET sort='{$p_sort}' WHERE id='{$_GET['mid']}'";
                    mysql_query($px, $conn) or die("ERROR: ".mysql_error());
                }
            }
            if (!empty($_GET['pid']))
            {
                if ($m_sort != -1)
                {
                    mysql_query("UPDATE ".$data['news']." SET sort='{$m_sort}' WHERE id='{$_GET['pid']}'", $conn) or die("ERROR: ".mysql_error());
                }
            }
            header("Location:".$_SESSION['url']."");
            break;
    }
}
?>
<?php
$classid = $_GET['classid']; //大类ID号
$cid = $_GET['cid']; //小类ID号
$title = $_GET['title']; //文章标题
if (empty($_GET['title']))
{
    if ($classid == "" && $cid == "")
    {
        $sql = "SELECT * FROM ".$data['news']." WHERE id>0 ";
    }
    elseif ($classid != "" && $cid == "")
    {
        $sql = "SELECT * FROM ".$data['news']." WHERE bid=".$classid;
    }
    elseif ($classid != "" && $cid != "")
    {
        $sql = "SELECT * FROM ".$data['news']." WHERE bid=".$classid." AND classid=".$cid;
    }
}
else
{
    $sql = "SELECT * FROM ".$data['news']." WHERE title LIKE '%".$title."%'";
}
$sql = $sql." ORDER BY sort DESC";
$url = "";
if (!empty($_GET['page']))
{
    $url = $url."page=".$_GET['page']."&";
}
if (!empty($_GET['title']))
{
    $url = $url."title=".$_GET['title']."&";
}
if (!empty($_GET['classid']))
{
    $url = $url."classid=".$_GET['classid']."&";
}
if (!empty($_GET['cid']))
{
    $url = $url."cid=".$_GET['cid'];
}
if (!empty($url))
{
    $url = "?".$url;
}
$_SESSION['url'] = "NewsList.php".$url;
$resull = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻中心</title>
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
        <li><a href="#">新闻中心</a></li>
        <li><a href="#">新闻列表</a></li>
    </ul>
</div>
<div class="rightinfo">
    <div class="tools">
        <form name="searchsoft" method="get" action="NewsList.php">
        <ul class="toolbar">
            <li class="click"><span><img src="../images/t01.png" /></span><a href="NewsAdd.php">添加</a></li>
            <li class="click"><span><img src="../images/ico06.png" width="29" height="25" /></span><input type="text" id="Title3" name="title" value="<?php echo $_GET['title']?>" class="dfinput3"><input type="submit" name="Query" value="搜索" class="btn2" style="cursor:pointer;" /></li>
            <?php
            $sql = "SELECT * FROM ".$data['classnews']." WHERE prv_id=0 ORDER BY sort ASC";
            $resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
            if (mysql_num_rows($resul) == 0)
            {
                echo "还没有任何分类，请首先添加分类。";
            }
            while ($rs = mysql_fetch_array($resul))
            {
                if ($rs['classid'] == $classid)
                {
                    if (!empty($rs['class_name_cn']))
                    {
                        echo "<li class='click'><a href='NewsList.php?classid=".$rs['classid']."'><span><img src='../images/add.png'/></span><font color='red'>".$rs['class_name_cn']."</font></a></li>";
                    }
                    else
                    {
                        echo "<li class='click'><a href='NewsList.php?classid=".$rs['classid']."'><span><img src='../images/add.png'/></span><font color='red'>".$rs['class_name_en']."</font></a></li>";
                    }
                }
                else
                {
                    if (!empty($rs['class_name_cn']))
                    {
                        echo "<li class='click'><span><img src='../images/add.png'/></span><a href='NewsList.php?classid=".$rs['classid']."'>".$rs['class_name_cn']."</a></li>";
                    }
                    else
                    {
                        echo "<li class='click'><span><img src='../images/add.png'/></span><a href='NewsList.php?classid=".$rs['classid']."'>".$rs['class_name_en']."</a></li>";
                    }
                }
            }
            ?>
            </li>
        </ul>
        </form>
    </div>
    <form name="del" method="post" action="NewsDel.php" onSubmit="return ConfirmDel();">
    <table class="tablelist">
        <thead>
            <tr>
                <th width="2%"><input type="checkbox" id="allbox" name="allbox" value="Check All" onClick="CA();"></th>
                <th width="3%">ID</th>
                <th width="9%" align="center">缩略图</th>
                <th width="27%">新闻名称</th>
                <th width="9%">序号</th>
                <th width="9%">所属类别</th>
                <th width="9%">排序</th>
                <th width="10%">发布时间</th>
                <th width="15%">是否审核</th>
                <th width="7%">操作</th>
            </tr>
        </thead>
        <tbody>
<?php
$rs = mysql_fetch_array($resull);
$num_row = mysql_num_rows($resull);
$pagesize = 10;
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
    if ($classid == "" && $cid == "")
    {
        $sql = "SELECT * FROM ".$data['news']." WHERE id>0 ";
    }
    elseif ($classid != "" && $cid == "")
    {
        $sql = "SELECT * FROM ".$data['news']." WHERE bid=".$classid;
    }
    elseif ($classid != "" && $cid != "")
    {
        $sql = "SELECT * FROM ".$data['news']." WHERE bid=".$classid." AND classid=".$cid;
    }
}
else
{
    $sql = "SELECT * FROM ".$data['news']." WHERE title LIKE '%".$title."%'";
}
$sql = $sql." ORDER BY sort DESC LIMIT $offset,$pagesize";
$resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
if (mysql_num_rows($resul) == 0)
{
    echo "<tr height='45'><td align='center' colspan='9' bgcolor='#ECF5FF' style='color:#FF0000;font-size:14px;'>";
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
        $rs = "SELECT * FROM ".$data['news']." WHERE sort>".$title['sort']." ORDER BY sort ASC";
        $prev = mysql_query($rs, $conn) or die("ERROR: ".mysql_error());
        $prevv = mysql_fetch_array($prev);
        if (mysql_num_rows($prev) != 0)
        {
            $prev_id = $prevv['id'];
        }
        $rss = "SELECT * FROM ".$data['news']." WHERE sort<".$title['sort']." ORDER BY sort DESC";
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
                <td class="imgtd" align="center"><?php if (!empty($title['spic'])){?><img src="../../<?php echo $title['spic'];?>" width="50" /><?php }else{?><img src="../images/no_picture.gif" height="50" /><?php }?></td>
                <td><?php if (!empty($title['title'])){echo $title['title'];}else{echo $title['title_en'];}?></td>
                <td align="center"><?php echo $title['sort'];?></td>
                <td align="center">
                    <?php 
                    $sqlclass = "SELECT * FROM ".$data['classnews']." WHERE classid=".$title['classid']."";
                    $resultclass = mysql_query($sqlclass);
                    $rowclass = mysql_num_rows($resultclass);
                    if ($rowclass < 1)
                    {
                        echo "暂无分类信息";
                    }
                    else
                    {
                        $rsclass = mysql_fetch_array($resultclass);
                        $p_prv_id = $rsclass["prv_id"];
                        $classname = $rsclass["class_name_cn"];
                    }
                    if ($p_prv_id != 0)
                    {
                        $sqlclass2 = "SELECT * FROM ".$data['classnews']." WHERE classid=".$p_prv_id."";
                        $resultclass2 = mysql_query($sqlclass2);
                        $rowclass2 = mysql_num_rows($resultclass2);
                        if ($rowclass2 < 1)
                        {
                            echo "暂无分类信息";
                        }
                        else
                        {
                            $rsclass2 = mysql_fetch_array($resultclass2);
                            $classname2 = $rsclass2["class_name_cn"];
                        }
                        echo $classname2. "-->" .$classname;
                    }
                    else
                    {
                        echo $classname;	  
                    }
                    ?>
                </td>
                <td align="center">
                    <?php
                    if ($prev_id != 0)
                    {
                    ?>
                    <a href="NewsList.php?action=move&pid=<?php echo $title['id'];?>&mid=<?php echo $prev_id;?>&page=<?php echo $page;?>">上移</a>
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
                    <a href="NewsList.php?action=move&pid=<?php echo $title['id'];?>&mid=<?php echo $next_id;?>&page=<?php echo $page;?>">&nbsp;&nbsp;下移</a>
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
                    if ($title['isnew'] == 1)
                    {
                    ?>
                    <a href="NewsList.php?action=isnew&amp;sign=1&amp;pid=<?php echo $title['id'];?>">已置顶</a>
                    <?php
                    }
                    else
                    {
                    ?>
                    <font color="#FF0000"><a href="NewsList.php?action=isnew&amp;sign=0&amp;pid=<?php echo $title['id'];?>"><b style="color:#FF0000;">非置顶</b></a></font>
                    <?php
                    }
                    ?>&nbsp;&nbsp;
                    <?php
                    if ($title['tj'] == 1)
                    {
                    ?>
                    <a href="NewsList.php?action=tj&amp;sign=1&amp;pid=<?php echo $title['id'];?>">推荐</a>
                    <?php
                    }
                    else
                    {
                    ?>
                    <font color="#FF0000"><a href="NewsList.php?action=tj&amp;sign=0&amp;pid=<?php echo $title['id'];?>"><b style="color:#FF0000;">非推荐</b></a></font>
                    <?php
                    }
                    ?>&nbsp;&nbsp;
                    <?php
                    if ($title['passed'] == 1)
                    {
                    ?>
                    <a href="NewsList.php?action=sh&amp;sign=true&amp;pid=<?php echo $title['id'];?>">已审核</a>
                    <?php
                    }
                    else
                    {
                    ?>
                    <font color="#FF0000"><a href="NewsList.php?action=sh&amp;sign=false&amp;pid=<?php echo $title['id'];?>"><b style="color:#FF0000;">未审核</b></a></font>
                    <?php
                    }
                    ?>
                </td>
                <td align="center"><a href="NewsModify.php?pID=<?php echo $title['id'];?>&page=<?php echo $page;?>" class="tablelink">查看</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="NewsDel.php?ArticleID=<?php echo $title['id'];?>" onClick="return ConfirmDel();" class="tablelink" style="color:#FF0000;">删除</a></td>
            </tr>
<?php
    }
}
?>
        </tbody>
    </table>
    <p>&nbsp;</p>
    <div class="tools">
        <input type="image" name="" src="../images/del_btn.jpg" /><input type="hidden" id="Action" name="Action" value="Del">
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
