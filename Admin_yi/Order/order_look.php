<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<?php
if(!empty($_GET['pID'])){
  $id=$_GET['pID'];
  $page=$_GET['page'];
  $sql="select * from ".$data['order']." where id='$id'";
  $result=mysql_query($sql,$conn) or die("Error:".mysql_error());
  $res=mysql_fetch_array($result);
  if (mysql_num_rows($result)!=0){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>订单中心</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">订单中心</a></li>
    <li><a href="#">查看订单</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>订单信息</span></div>
    <form name="myform" method="post" action="?" >
    <input type=hidden name=page value="<?php echo $page;?>">
    <input type=hidden name=action value="check">
    <input type=hidden name=id value="<?php echo $id;?>">
    <ul class="forminfo">
    <!--<li><label>订单号</label><?php echo $res['ordernum'];?><i></i></li>-->
    
    <li><label>产品型号</label><?php echo $res['product'];?></li>
    
    <li><label>产品数量</label><?php echo $res['quantity'];?></li>
    
    <li><label>交货日期</label><?php echo $res['delivery'];?></li>
    
    <li><label>订单状态</label><?php if($res['status']==1){
	  echo "已处理";}
	  else{
	  echo "<font color=#FF0000>未处理</font>";
	  }
	  ?></li>
    
    
    
    <li><label>公司名称</label><?php echo $res['company'];?></li>
    
    <li><label>订购人</label><?php echo $res['userr'];?></li>
    
    <li><label>电话</label><?php echo $res['phone'];?></li>
    
    <li><label>传真</label><?php echo $res['fax'];?></li>
    
    <li><label>付款方式</label><?php echo $res['price'];?></li>
    
    <li><label>联系地址</label><?php echo $res['address'];?></li>
    
    <li><label>E-mail</label><?php echo $res['email'];?></li>
    
    <li><label>订单备注</label><?php echo $res['content'];?></li>
    
    <li><label>下单时间</label><?php echo $res['addtime'];?></li>
    
    
    
    <li><label>&nbsp;</label><input name="" onClick="javascript:window.history.back(-1);"  type="button" class="btn" value="返&nbsp;&nbsp;&nbsp;&nbsp;回"/></li>
    </ul>
    </form>
    
    </div>
<?php
  }
}
?>

</body>

</html>
