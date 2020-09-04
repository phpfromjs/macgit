<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站首页信息</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../KindEditor/plugins/myplugins.css" />
<script type="text/javascript" charset="utf-8" src="../KindEditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="../KindEditor/plugins/myplugins.js"></script>
<script type="text/javascript">
KE.show({
    id: 'content',
    skinType: 'office',
    cssPath: '../css/index.css',
    resizeMode: ke_resize_dwn,
    items: ke_items_all
});
KE.show({
    id: 'content_en',
    skinType: 'office',
    cssPath: '../css/index.css',
    resizeMode: ke_resize_dwn,
    items: ke_items_all
});
KE.show({
    id: 'content_j',
    skinType: 'office',
    cssPath: '../css/index.css',
    resizeMode: ke_resize_dwn,
    items: ke_items_all
});
</script>
</head>
<body>
<?php
if ($_POST['action']=="add")
{
    $title = $_POST['title'];
	$content = $_POST['content'];
	$content_en = $_POST['content_en'];
	$content_j = $_POST['content_j'];
	$type = $_GET['type'];
	$type_en = $_GET['type']."_en";
	$type_j = $_GET['type']."_j";
	mysql_query("UPDATE ".$data['webinfo']." SET ".$type."='$content',".$type_en."='$content_en',".$type_j."='$content_j' ", $conn) or die("ERROR: ".mysql_error());
	echo "<script language='javascript'> window.alert('修改成功！'); location=iindex.phptype.";</script>";
}
?>
<?php
if (!empty($_GET['type']))
{
    $sql = "SELECT * FROM ".$data['webinfo']." ORDER BY id DESC";
    $result = mysql_query($sql,$conn) or die("ERROR:".mysql_error());
    $res = mysql_fetch_array($result);
    if (mysql_num_rows($result) != 0)
    {
?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">首页内容设置</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>
    <?php
    if ($_GET['type'] == "about")
    {
        echo "首页关于我们";
	}
    elseif($_GET['type'] == "culture")
    {
        echo "首页企业文化";
    }
    elseif($_GET['type'] == "contact")
    {
        echo "左侧联系我们";
	}
    elseif($_GET['type'] == "footer")
    {
        echo "底部版权信息";
	}
    else
    {
        echo "栏目信息";
    }
    ?>
    </span></div>
    <form name="myform" method="post" action="?type=<?php echo $_GET['type']?>">
    <ul class="forminfo">
        <li><label>信息标题</label><input name="title" type="text" class="dfinput" readonly="readonly" value="<?php
        if ($_GET['type'] == "about")
        {
            echo "首页关于我们";
        }
        elseif ($_GET['type'] == "culture")
        {
            echo "首页企业文化";
        }
        elseif ($_GET['type'] == "contact")
        {
            echo "左侧联系我们";
        }
        elseif ($_GET['type'] == "footer")
        {
            echo "底部版权信息";
        }
        else
        {
            echo "栏目信息";
        }
        ?>" /><i>标题不能超过30个字符</i></li>
        <li><label>信息内容<i><br />（中文）</i></label><textarea id="content" name="content" cols="" rows="" class="textinput2"><?php echo $res[$_GET['type']];?></textarea></li>
        <li><label>信息内容<i><br />（英文）</i></label><textarea id="content_en" name="content_en" cols="" rows="" class="textinput2"><?php echo $res[$_GET['type'].'_en'];?></textarea></li>
        <li style="display:none;"><label>信息内容<i>（繁体）</i></label><textarea id="content_j" name="content_j" cols="" rows="" class="textinput2"><?php echo $res[$_GET['type'].'_j'];?></textarea></li>
        <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存"/><input name="action" type="hidden" id="action" value="add" /></li>
    </ul>
    </form>
</div>
<?php
    }
}
?>
</body>
</html>
