<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<?php
if (!empty($_GET['action'])){
$action=$_GET['action'];
switch($action){
case "sh";
if (!empty($_GET['sign'])){
$sign=$_GET['sign'];
if ($sign=="true"){
if (!empty($_GET['pid'])){
mysql_query("update ".$data['order']." set status=0 where id='{$_GET['pid']}'",$conn) or die("ERROR: ".mysql_error());
}
}
else{
if (!empty($_GET['pid'])){
mysql_query("update ".$data['order']." set status=1 where id='{$_GET['pid']}'",$conn) or die("ERROR: ".mysql_error());
}
}
}
header("Location:".$_SESSION['url']."");
break;
case "del";
$allid=$_POST['ArticleID'];
$id=$_GET['ArticleID'];
if (!empty($allid)){
$allidlist = implode(",", $allid);
if(!empty($allidlist)){
$sql = "delete from ".$data['order']." where id in($allidlist)"; 
mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
echo "<script language='javascript'> window.alert('删除对象成功！'); location='order.php';</script>";
exit;
}
}

if(!empty($id)){
$sql = "delete from ".$data['order']." where id='".$id."'"; 
mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
echo "<script language='javascript'> window.alert('删除对象成功！'); location='order.php';</script>";
exit;
}
//header("Location:".$_SESSION['url']."");
break;
}
}?>
<?php
if (empty($_GET['title'])){
$sql="select * from ".$data['order']." where id>0 order by id desc";
}
else
{
$sql="select * from ".$data['order']." where id>0 and ordernum like '%".$_GET['title']."%' order by id desc";
}
if (!empty($_GET['page'])){
if (!empty($_GET['title'])){
$_SESSION['url']="order.php?page=".$_GET['page']."&title=".$_GET['title'];
}
else{
$_SESSION['url']="order.php?page=".$_GET['page'];
}
}
else{
if (!empty($_GET['title'])){
$_SESSION['url']="order.php?title=".$_GET['title'];
}
else{
$_SESSION['url']="order.php";
}
}
$resull=mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>在线订购</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>

<script language="javascript"> 
function CA(){ 
for(var i=0;i<document.del.ArticleID.length;i++){ 
var e=document.del.ArticleID[i]; 
if(e.name!='allbox') e.checked=document.del.allbox.checked; 
} 
} 
function unselectall()
{
    if(document.del.allbox.checked){
	document.del.allbox.checked = document.del.allbox.checked&0;
    } 	
}
function test()
{ 
  if(!confirm('确认删除吗？')) return false;
}
</script>

</head>


<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">在线订购</a></li>
    <li><a href="#">订单列表</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    
    <div class="tools">
    <form name="forms" method="get" action="?">
    	<ul class="toolbar">
        <li class="click"><span><img src="../images/ico06.png" width="29" height="25" /></span>
          <input name="title" type="text" class="dfinput3" id="Title3" value="<?php echo $_GET['title']?>"><input name="Query" type="submit" class="btn2" value="搜索" style="cursor:pointer;"/>
        </li> 
        
        </ul>
      </form>  
    
    </div>
    
    <form name="del" method="post" action="?action=del" onSubmit="return test();">
    <table class="tablelist">
    	<thead>
    	<tr>
        <th width="2%"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>

        <th width="8%">产品型号</th>
         <th width="11%">产品数量</th>
        <th width="11%">交货日期</th>
        <th width="11%">联系人</th>
        <th width="17%">电话</th>
        <th width="11%">订单状态</th>
        <th width="7%">操作</th>
        </tr>
        </thead>
        <tbody>
<?php
		  $rs=mysql_fetch_array($resull);
$num_row = mysql_num_rows($resull);
$pagesize = 20;

$pages= intval($num_row/$pagesize);
			if($num_row % $pagesize)
			  {
				  $pages++;
			  }
			  if(!empty($_GET['page']))
			  {
				  $page = intval($_GET['page']);				  			  			 
					 if($page<=0){  
					$page=1;
					 }
					if($page>$pages){  
					$page=1;
					 }
			  }
			  else 
			  {
				  $page = 1;
			  }
			  $offset = $pagesize*($page-1);
if (empty($_GET['title'])){
$sql="select * from ".$data['order']." where id>0 order by id desc limit $offset,$pagesize";
}
else
{
$sql="select * from ".$data['order']." where id>0 and ordernum like '%".$_GET['title']."%' order by id desc limit $offset,$pagesize";
}
$resul=mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
if (mysql_num_rows($resul) == 0) {
					echo "<tr height='20'><td align=center colspan='9' bgcolor='#ECF5FF' style='color:#FF0000; font-size:14px '>";
					echo "没有符合条件的记录!";
					echo "</td></tr>";
				}
				else{
				$i=0;	
				while($title=mysql_fetch_array($resul)){
			  $i++;			
?>
        <tr>
        <td><input name='ArticleID[<?php echo $i;?>]' type='checkbox' onClick="unselectall()" id="ArticleID" value='<?php echo $title['id'];?>'></td>
        <td><?php echo $title['product'];?></td>
        <td><?php echo $title['quantity'];?></td>
        <td><?php echo $title['delivery'];?></td>
        <td><?php echo $title['userr'];?></td>
        <td><?php echo $title['phone'];?></td>
        <td><?php if ($title['status']==1){?>
              <a href="order.php?action=sh&amp;sign=true&amp;pid=<?php echo $title['id'];?>">已处理</a>
              <?php }
			  else
			  {?>
              <font color="#FF0000"><a href="order.php?action=sh&amp;sign=false&amp;pid=<?php echo $title['id'];?>"><b style="color:#FF0000">未处理</b></a></font>
              <?php }?></td>
        <td><a href="order_look.php?pID=<?php echo $title['id'];?>&page=<?php echo $page;?>">查看</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="order.php?ArticleID=<?php echo $title['id'];?>&action=del" onClick="return ConfirmDel();">删除</a></td>
        </tr> 
<?php
  }
}
?>
        
     
        </tbody>
    </table>
    <p>&nbsp;</p>
    <div class="tools">
       <input name="" src="../images/del_btn.jpg" type="image" /><input name="Action" type="hidden" id="Action" value="Del">
    </div>
    </form>
    <div style="clear:both"></div>
    
    <?php require_once "../inc/page.php";?>

    </div>
    

    </div>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>

</body>

</html>