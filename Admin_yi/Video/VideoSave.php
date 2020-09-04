<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
//require_once("../inc/send_mail.php");
?>
<?php
if(!empty($_GET['action'])){
$action=$_GET['action'];
switch($action){
case "add";
$src=$_POST['src'];
$s=$_POST['s'];
$s_en=$_POST['s_en'];
$title=$_POST['title'];
$title_en=$_POST['title_en'];
$title_j=$_POST['title_j'];
$text=$_POST['text'];
$text_en=$_POST['text_en'];
$text_j=$_POST['text_j'];
$content=$_POST['content'];
$content_en=$_POST['content_en'];
$content_j=$_POST['content_j'];
$t=str_replace("../../","",$_POST['t']);
$t_en=$_POST['t_en'];
$t_j=$_POST['t_j'];
$k=str_replace("../../","",$_POST['k']);
$k_en=$_POST['k_en'];
$k_j=$_POST['k_j'];
$d=str_replace("../../","",$_POST['d']);
$d_en=$_POST['d_en'];
$d_j=$_POST['d_j'];
$yyff=$_POST['yyff'];
$yyff_en=$_POST['yyff_en'];
$yyff_j=$_POST['yyff_j'];
$wdxz=$_POST['wdxz'];
$wdxz_en=$_POST['wdxz_en'];
$nn=$_POST['nn'];
$nn_en=$_POST['nn_en'];
$nn_j=$_POST['nn_j'];
$spic=str_replace("../../","",$_POST['spic']);
$bpic=str_replace("../../","",$_POST['bpic']);
$sort=$_POST['sort'];
$model=$_POST['model'];
$hits=$_POST['hits'];
$price=$_POST['price'];
$price1=$_POST['price1'];
if (!empty($_POST['tj'])){
$tj=$_POST['tj'];}
else{
$tj=0;
}
$addTime=$_POST['UpdateTime'];
if (!empty($_POST['passed'])){
$passed=$_POST['passed'];}
else{
$passed=0;
}
if (!empty($_POST['isnew'])){
$isnew=$_POST['isnew'];}
else{
$isnew=0;
}
$cid=$_POST['classid'];
for($i=1;$i<=10;$i++){
		$pic=str_replace("../../","",$_POST['pic_'.$i]);
		if(!empty($pic)){
		$arrPic=$arrPic.$pic."|";
		}
		}
	if(!empty($arrPic)){
	$cd=strlen($arrPic)-1;
	$mpic=substr($arrPic,0,$cd);
	} 
$sql="select * from ".$data['classvideo']." where classid=".$cid;
$resul=mysql_query($sql,$conn) or die ("ERROR: ".mysql_error());
$rs=mysql_fetch_array($resul);
if(mysql_num_rows($resul)==0){
$cidd=$cid;
}
else{
if($rs['prv_id']==0){
$cidd=$cid;
}
else{
$cidd=$rs['prv_id'];
}
}
$link_id=$rs['link_id'];

//扩展分类
$gl=$_POST['gl'];
$gl=implode("|",$gl);
if(!empty($gl)){
$gl="|".$gl."|";
}
else
{
$gl="";
}
//扩展分类
$cid1=$_POST['classid1'];
$cid1=implode("|",$cid1);
if(!empty($cid1)){
$cid1="|".$cid1."|";
}
else
{
$cid1="";
}
$link_id1=$cid1;
$cid1=0;
//echo "preg";
//echo '<pre>',print_r($cid1,1),'</pre>';
//exit;
//$sql="select * from ".$data['classpro3']." where classid=".$cid1;
//$resul=mysql_query($sql,$conn) or die ("ERROR: ".mysql_error());
//$rs=mysql_fetch_array($resul);
//$link_id1=$rs['link_id'];



$string="insert into ".$data['video']."(hits,link_id,classid,bid,title,title_en,title_j,content,content_en,content_j,spic,bpic,sort,tj,passed,addTime,model,price,price1,text,text_en,text_j,mpic,yyff,yyff_en,yyff_j,wdxz,wdxz_en,classid1,link_id1,nn,nn_en,nn_j,t,t_en,t_j,k,k_en,k_j,d,d_en,d_j,s,s_en,gl,src,isnew) values('{$hits}','{$link_id}','{$cid}','{$cidd}','{$title}','{$title_en}','{$title_j}','{$content}','{$content_en}','{$content_j}','{$spic}','{$bpic}','{$sort}','{$tj}','{$passed}','{$addTime}','{$model}','{$price}','{$price1}','{$text}','{$text_en}','{$text_j}','{$mpic}','{$yyff}','{$yyff_en}','{$yyff_j}','{$wdxz}','{$wdxz_en}','{$cid1}','{$link_id1}','{$nn}','{$nn_en}','{$nn_j}','{$t}','{$t_en}','{$t_j}','{$k}','{$k_en}','{$k_j}','{$d}','{$d_en}','{$d_j}','{$s}','{$s_en}','{$gl}','{$src}','{$isnew}')";
mysql_query($string,$conn) or die("ERROR: ".mysql_error());

//发送邮件给客户
//        $getID=mysql_insert_id();
//	    $revMail ="tao.c@wiselite.com ";		
//		$subject="=?UTF-8?B?".base64_encode('晟泰电子有限公司添加了新产品')."?=";
//		$content = "<br>产品名称:".$title."<br><a href=http://127.0.0.1:8000/2012/stdz/cn/products/show_".$getID.".html>产品详细地址</a>";			
//$resull=mysql_query("select * from ".$data['user']." where passed=1 order by id desc",$conn) or die("ERROR: ".mysql_error());
//while($r=mysql_fetch_array($resull)){
//$toMail=$r['email'];
//$end = $sm->send( $toMail, $revMail, "{$subject}", "{$content}" );
//} 
//发送邮件给客
header("Location:VideoList.php");
exit;
break;


case "Modify";

$src=$_POST['src'];
$pid=$_POST['pid'];
$s=$_POST['s'];
$s_en=$_POST['s_en'];
$title=$_POST['title'];
$title_en=$_POST['title_en'];
$title_j=$_POST['title_j'];
$text=$_POST['text'];
$text_en=$_POST['text_en'];
$text_j=$_POST['text_j'];
$content=$_POST['content'];
$content_en=$_POST['content_en'];
$content_j=$_POST['content_j'];
$t=str_replace("../../","",$_POST['t']);
$t_en=$_POST['t_en'];
$t_j=$_POST['t_j'];
$k=str_replace("../../","",$_POST['k']);
$k_en=$_POST['k_en'];
$k_j=$_POST['k_j'];
$d=str_replace("../../","",$_POST['d']);
$d_en=$_POST['d_en'];
$d_j=$_POST['d_j'];
$yyff=$_POST['yyff'];
$yyff_en=$_POST['yyff_en'];
$yyff_j=$_POST['yyff_j'];
$wdxz=$_POST['wdxz'];
$wdxz_en=$_POST['wdxz_en'];
$nn=$_POST['nn'];
$nn_en=$_POST['nn_en'];
$nn_j=$_POST['nn_j'];
$spic=str_replace("../../","",$_POST['spic']);
$bpic=str_replace("../../","",$_POST['bpic']);
$sort=$_POST['sort'];
$model=$_POST['model'];
$hits=$_POST['hits'];
$price=$_POST['price'];
$price1=$_POST['price1'];
if (!empty($_POST['tj'])){
$tj=$_POST['tj'];}
else{
$tj=0;
}
$addTime=$_POST['UpdateTime'];
if (!empty($_POST['passed'])){
$passed=$_POST['passed'];}
else{
$passed=0;
}
if (!empty($_POST['isnew'])){
$isnew=$_POST['isnew'];}
else{
$isnew=0;
}
$cid=$_POST['classid'];
for($i=1;$i<=10;$i++){
		$pic=str_replace("../../","",$_POST['pic_'.$i]);
		if(!empty($pic)){
		$arrPic=$arrPic.$pic."|";
		}
		}
	if(!empty($arrPic)){
	$cd=strlen($arrPic)-1;
	$mpic=substr($arrPic,0,$cd);
	} 
$sql="select * from ".$data['classvideo']." where classid=".$cid;
$resul=mysql_query($sql,$conn) or die ("ERROR: ".mysql_error());
$rs=mysql_fetch_array($resul);
if(mysql_num_rows($resul)==0){
$cidd=$cid;
}
else{
if($rs['prv_id']==0){
$cidd=$cid;
}
else{
$cidd=$rs['prv_id'];
}
}
$link_id=$rs['link_id'];

//扩展分类
$gl=$_POST['gl'];
$gl=implode("|",$gl);
if(!empty($gl)){
$gl="|".$gl."|";
}
else
{
$gl="";
}
//扩展分类
$cid1=$_POST['classid1'];
$cid1=implode("|",$cid1);
if(!empty($cid1)){
$cid1="|".$cid1."|";
}
else
{
$cid1="";
}
$link_id1=$cid1;
$cid1=0;

////品牌型号
//$cid1=$_POST['classid1'];
//$sql="select * from ".$data['classpro3']." where classid=".$cid1;
//$resul=mysql_query($sql,$conn) or die ("ERROR: ".mysql_error());
//$rs=mysql_fetch_array($resul);
//$link_id1=$rs['link_id'];

$string="UPDATE ".$data['video']." set classid='$cid',bid='$cidd',link_id='$link_id',hits='$hits',title='$title',title_en='$title_en',title_j='$title_j',content='$content',content_en='$content_en',content_j='$content_j',spic='$spic',bpic='$bpic',sort='$sort',tj='$tj',passed='$passed',addTime='$addTime',model='$model',price='$price',price1='$price1',text='$text',text_en='$text_en',text_j='$text_j',mpic='$mpic',yyff='$yyff',yyff_en='$yyff_en',yyff_j='$yyff_j',wdxz='$wdxz',wdxz_en='$wdxz_en',classid1='$cid1',link_id1='$link_id1',nn='$nn',nn_en='$nn_en',nn_j='$nn_j',t='$t',t_en='$t_en',t_j='$t_j',k='$k',k_en='$k_en',k_j='$k_j',d='$d',d_en='$d_en',d_j='$d_j',s='$s',s_en='$s_en',gl='$gl',src='$src',isnew='$isnew'  where id=".$pid;

//echo $string;exit();
mysql_query($string,$conn) or die("ERROR: ".mysql_error());
header("Location:VideoList.php");
exit;
break;
}
}?>
