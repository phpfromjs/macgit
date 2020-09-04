<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
$sjk=$data['classhotel'];
?>
<?php
if (!empty($_GET['action'])){
$action=$_GET['action'];
switch($action){
case "tj";
if (isset($_GET['sign'])){
$sign=$_GET['sign'];
if ($sign==1){
mysql_query("update ".$data['hotel']." set tj=0 where id='{$_GET['pid']}'",$conn) or die("ERROR: ".mysql_error());
}
else{
mysql_query("update ".$data['hotel']." set tj=1 where id='{$_GET['pid']}'",$conn) or die("ERROR: ".mysql_error());
}
}
header("Location:".$_SESSION['url']."");
break;
case "isnew";
if (isset($_GET['sign'])){
$sign=$_GET['sign'];
if ($sign==1){
mysql_query("update ".$data['hotel']." set isnew=0 where id='{$_GET['pid']}'",$conn) or die("ERROR: ".mysql_error());
}
else{
mysql_query("update ".$data['hotel']." set isnew=1 where id='{$_GET['pid']}'",$conn) or die("ERROR: ".mysql_error());
}
}
header("Location:".$_SESSION['url']."");
break;
case "zd";
$sqlzd="select * from ".$data['hotel']." order by sort desc";
$resulzd = mysql_query($sqlzd,$conn) or die("ERROR: ".mysql_error());
$ttzd=mysql_fetch_array($resulzd);
if (mysql_num_rows($resulzd) == 0){
					 $maxsort="1";
					 }
					 else{
					 $maxsort=$ttzd['sort']+1;
					 }
mysql_query("update ".$data['hotel']." set sort=".$maxsort." where id='{$_GET['pid']}'",$conn) or die("ERROR: ".mysql_error());
header("Location:".$_SESSION['url']."");
break;
case "sh";
if (!empty($_GET['sign'])){
$sign=$_GET['sign'];
if ($sign=="true"){
if (!empty($_GET['pid'])){
mysql_query("update ".$data['hotel']." set passed=0 where id='{$_GET['pid']}'",$conn) or die("ERROR: ".mysql_error());
}
}
else{
if (!empty($_GET['pid'])){
mysql_query("update ".$data['hotel']." set passed=1 where id='{$_GET['pid']}'",$conn) or die("ERROR: ".mysql_error());
}
}
}
header("Location:".$_SESSION['url']."");
break;
case "move";
$p_sort=-1;
$m_sort=-1;
if (!empty($_GET['pid'])){
$resul=mysql_query("select * from ".$data['hotel']." where id='{$_GET['pid']}'",$conn) or die("ERROR: ".mysql_error());
$tt=mysql_fetch_array($resul);
if (mysql_num_rows($resul) != 0) $p_sort=$tt['sort'];
}
if (!empty($_GET['mid'])){
$resull=mysql_query("select * from ".$data['hotel']." where id='{$_GET['mid']}'",$conn) or die("ERROR: ".mysql_error());
$ttt=mysql_fetch_array($resull);
if (mysql_num_rows($resull) != 0) $m_sort=$ttt['sort'];
}
if (!empty($_GET['mid'])){
if ($p_sort!=-1){
$px="update ".$data['hotel']." set sort='{$p_sort}' where id='{$_GET['mid']}'";
mysql_query($px,$conn) or die("ERROR: ".mysql_error());
}
}
if (!empty($_GET['pid'])){
if ($m_sort!=-1){
mysql_query("update ".$data['hotel']." set sort='{$m_sort}' where id='{$_GET['pid']}'",$conn) or die("ERROR: ".mysql_error());
}
}
header("Location:".$_SESSION['url']."");
break;
}
}?>
<?php
$m=0;
//递归输出下拉菜单
function getMenuTree($cid,$sTree,$sLab,$selectid,$conn,$date) {
$conn1=$conn;
$date1=$date;
global $m;
$m++;
$sql="select * from ".$date1." where prv_id='".$cid."' order by sort asc";
$resul=mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
if (mysql_num_rows($resul)==0 && $m==1) echo "该频道暂无栏目";
while($rs=mysql_fetch_array($resul)){
if(intval($selectid)==intval($rs['classid'])){
$strSel=" selected";
}
else
{
$strSel="";
}
$sTree=$sTree."<option value=".$rs['classid']." ".$strSel.">".$sLab."├─".$rs['class_name_cn']."</option>";
$sTree=getMenuTree($rs['classid'],$sTree,$sLab."&nbsp;&nbsp;",$selectid,$conn,$date);
}
echo $sTree;
}?>
<?php
//输入下级分类
function getNextCls($cid,$conn,$date){
$sql="select * from ".$date." where prv_id='".$cid."' order by sort asc";
$resul=mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
if (mysql_num_rows($resul)==0) echo "<li><font color=red>没有下级分类</font></li>";
while($rs=mysql_fetch_array($resul)){
$strCls=$strCls."<li><span><img src='../images/add.png'/></span><a href=?cid=".$rs['classid'].">".$rs['class_name_cn']."</a></li>";
}
echo $strCls;
}
?>
<?php
//递归输出分类路径
function getNav($cid,$strNav,$conn,$date){
$conn1=$conn;
$date1=$date;
$sql="select * from ".$date." where classid='".$cid."' order by sort asc";
$resul=mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
while($rs=mysql_fetch_array($resul)){
$strNav="<a href=?cid=".$rs['classid'].">".$rs['class_name_cn']."</a>&nbsp;&gt;&gt;&nbsp;".$strNav;
//$linkId=substr($rs['link_id'],0,strlen($rs['link_id'])-1);
//$linkId=substr($linkId,1,strlen($linkId));
//$arrId=explode("|",$linkId);
//if(count($arrId)>0){
//$tmpId=$arrId[count($arrId)-1];
if($rs['prv_id']!=0){
$getNav=getNav($rs['prv_id'],$strNav,$conn1,$date1);}
//}
else{
echo $strNav;
//$getNavv=$strNav;
}
}
}?>
<?php
$cid=$_GET['cid'];
$title=$_GET['title'];
$sql="select * from ".$data['hotel']." where id>0";
//分类条件
if(!empty($cid) && is_numeric($cid)){
$sql=$sql." and link_id like '%|".$cid."|%'";
}
else
{
$cid=0;
}
//搜索条件
if (!empty($title)){
$sql=$sql." and model like '%".$title."%'";
}
$sql=$sql." order by sort desc";
$url="";
if (!empty($_GET['page'])) $url=$url."page=".$_GET['page']."&";
if (!empty($_GET['title'])) $url=$url."title=".$_GET['title']."&";
if (!empty($_GET['cid'])) $url=$url."cid=".$_GET['cid'];
if (!empty($url)) $url="?".$url;
$_SESSION['url']="HotelList.php".$url;
$resull=mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>栏目列表</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript"> 
function CA(){ 
for(var i=0;i<document.del.ArticleID.length;i++){ 
var e=document.del.ArticleID[i]; 
if(e.name!='allbox') e.checked=document.del.allbox.checked; 
} 
} 
</script>
<SCRIPT language=javascript>
function unselectall()
{
    if(document.del.allbox.checked){
	document.del.allbox.checked = document.del.allbox.checked&0;
    } 	
}

function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.Name != "chkAll")
       e.checked = form.chkAll.checked;
    }
  }
function ConfirmDel()
{
   if(confirm("确定要删除选中的记录吗？一旦删除将不能恢复！"))
     return true;
   else
     return false;
	 
}
</SCRIPT>
</head>


<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">客户见证</a></li>
    <li><a href="#">栏目列表</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    
    <div class="tools">
    <form name="searchsoft" method="get" action="HotelList.php">
    	<ul class="toolbar">
        <li class="click"><a href="HotelAdd.php"><span><img src="../images/t01.png" /></span>添加</a></li>
        <li class="click"><span><img src="../images/ico06.png" width="29" height="25" /></span>
          <input name="title" type="text" class="dfinput3" id="Title3" value="<?php echo $_GET['title']?>"><input name="Query" type="submit" class="btn2" value="搜索" style="cursor:pointer;"/>
        </li>
        <li class="click">&nbsp;<select name="cid" id="cid" onChange="location.href='?cid='+this.options[this.selectedIndex].value;" style="font-size:14px; font-family:'微软雅黑'">
		  <option value="0">所有类别</option>
           <?php getMenuTree(0,$sTree,"",$cid,$conn,$sjk)?>
          </select></li>
        <li><span><img src='../images/loginsj.png'/></span>下级分类：</li>
		<?php getNextCls($cid,$conn,$sjk)?>
        </ul>
    </form>
    </div>
    
    <div style="clear:both"></div>
    <form name="del" method="Post" action="HotelDel.php" onSubmit="return ConfirmDel();">
    <table class="imgtable">
    
    <thead>
    <tr>
    <th width="3%"><input name="allbox" type="checkbox" id="allbox" onClick="CA();" value="Check All"></th>
    <th width="6%">ID</th>
    <th width="9%">缩略图</th>
    <th width="23%">栏目名称</th>
    <th width="11%">所属类别</th>
    <th width="7%">序号</th>
    <th width="10%">排序</th>
    <th width="13%">发布时间</th>
    <th width="10%">是否审核</th>
    <th width="8%">操作</th>
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
			  $sql="select * from ".$data['hotel']." where id>0";
//分类条件
if(!empty($cid) && is_numeric($cid)){
$sql=$sql." and link_id like '%|".$cid."|%'";
$sqll=$sqll." and link_id like '%|".$cid."|%'";
}
else
{
$cid=0;
}
//搜索条件
if (!empty($title)){
$sql=$sql." and model like '%".$title."%'";
$sqll=$sqll." and model like '%".$title."%'";
}
$sql=$sql." order by sort desc limit $offset,$pagesize";
$resul=mysql_query($sql,$conn) or die("ERROR: ".mysql_error());
if (mysql_num_rows($resul) == 0) {
					echo "<tr height='45'><td align=center colspan='8' bgcolor='#ECF5FF' style='color:#FF0000; font-size:14px '>";
					echo "数据库中没有符合条件的记录!";
					echo "</td></tr>";
				}
				else{
				$i=0;
				while($title=mysql_fetch_array($resul)){
			  $i++;
			  $prev_id=0;
			  $next_id=0;
			  $rs="select * from ".$data['hotel']." where sort>".$title['sort'].$sqll." order by sort asc";
			  $prev=mysql_query($rs,$conn) or die("ERROR: ".mysql_error());
			  $prevv=mysql_fetch_array($prev);
			  if (mysql_num_rows($prev) != 0) $prev_id=$prevv['id']; 
			  $rss="select * from ".$data['hotel']." where sort<".$title['sort'].$sqll." order by sort desc";
			  $next=mysql_query($rss,$conn) or die("ERROR: ".mysql_error());
			  $nextt=mysql_fetch_array($next);
			  if (mysql_num_rows($next) != 0) $next_id=$nextt['id']; 

?>
    <tr>
    <td height="40"><input name="ArticleID[<?php echo $i;?>]" onClick="unselectall()" id="ArticleID" type="checkbox" value="<?php echo $title['id'];?>" /></td>
    <td class="imgtd"><?php echo $title['id'];?></td>
    <td class="imgtd"><img src="../../<?php echo $title['spic'];?>" width="100" /></td>
    <td><B><?php echo $title['title'];?></B></td>
    <td><?php 
	  $sqlclass="select * from ".$data['classhotel']." where classid=".$title['classid']."";
	  $resultclass = mysql_query($sqlclass);
	  $rowclass = mysql_num_rows($resultclass);
	  if($rowclass < 1){
		echo "暂无分类信息";
	  }
	  else
	  {
		$rsclass=mysql_fetch_array($resultclass);
		$p_prv_id = $rsclass["prv_id"];
		$classname = $rsclass["class_name_cn"];
		//echo $rsclass["class_name_cn"];
	  }
	  if($p_prv_id != 0 ) {
		  $sqlclass2="select * from ".$data['classhotel']." where classid=".$p_prv_id."";
		  $resultclass2 = mysql_query($sqlclass2);
		  $rowclass2 = mysql_num_rows($resultclass2);
		  if($rowclass2 < 1){
			echo "暂无分类信息";
		  }
		  else{
			$rsclass2=mysql_fetch_array($resultclass2);
			$classname2 = $rsclass2["class_name_cn"];
			//echo $rsclass["class_name_cn"];
		  }
	   echo $classname2. "-->" .$classname ;
	  }else{
	    echo $classname ;	  
	  }
	?></td>
    <td><?php echo $title['sort'];?></td>
    <td>&nbsp;<?php if($prev_id!=0){?>
              <a href="HotelList.php?action=move&pid=<?php echo $title['id'];?>&mid=<?php echo $prev_id;?>&page=<?php echo $page;?>">上移</a>
              <?php }
			  else {?>
              上移
              <?php }?>
              <?php if($next_id!=0){?>
              <a href="HotelList.php?action=move&pid=<?php echo $title['id'];?>&mid=<?php echo $next_id;?>&page=<?php echo $page;?>">下移</a>
              <?php }
			  else {?>
              下移
              <?php }?></td>
              <td><?php echo $title['addTime'];?></td>
    <td><!--<?php if ($title['isnew']==1){?>
              <a href="HotelList.php?action=isnew&amp;sign=1&amp;pid=<?php echo $title['id'];?>">已置顶</a>
              <?php }
			  else
			  {?>
              <a href="HotelList.php?action=isnew&amp;sign=0&amp;pid=<?php echo $title['id'];?>"><font style="color:#FF0000">非置顶</font></a>
              <?php }?>&nbsp;&nbsp;&nbsp;&nbsp;-->
			  <?php if ($title['tj']==1){?>
              <a href="HotelList.php?action=tj&amp;sign=1&amp;pid=<?php echo $title['id'];?>">已推荐</a>
              <?php }
			  else
			  {?>
              <a href="HotelList.php?action=tj&amp;sign=0&amp;pid=<?php echo $title['id'];?>"><font style="color:#FF0000">非推荐</font></a>
              <?php }?>&nbsp;&nbsp;&nbsp;&nbsp;
             <?php if ($title['passed']==1){?>
              <a href="HotelList.php?action=sh&amp;sign=true&amp;pid=<?php echo $title['id'];?>">已审核</a>
              <?php }
			  else
			  {?>
              <a href="HotelList.php?action=sh&amp;sign=false&amp;pid=<?php echo $title['id'];?>"><font style="color:#FF0000">未审核</font></a>
              <?php }?></td>
    <td><a href="HotelModify.php?pID=<?php echo $title['id'];?>&page=<?php echo $page;?>">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="HotelDel.php?ArticleID=<?php echo $title['id'];?>" onClick="return ConfirmDel();">删除</a></td>
    </tr>
<?php
}}?> 

    
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
    
    
    
<script type="text/javascript">
	$('.imgtable tbody tr:odd').addClass('odd');
	</script>
    
</body>

</html>
