<?php include "../inc/conn.php";
$id=$_GET['id'];
if ($pro=getRow("pro","id=".$id." "))
{
    $t= $pro['t_en'];
    $k= $pro['k_en'];
    $d= $pro['d_en'];
    $pro_class_single = getRow("classpro","classid=".$pro['classid']);
}
else
{
//    echo "<script language=javascript>history.go(-1);</script>";
//    exit;
}
$classid=$pro['classid'];
$sql = "SELECT * FROM ".$data['classpro']." WHERE prv_id=0 ORDER BY sort ASC";
$pro_class=get_all($sql);
//更新浏览次数
$hits = (Int)$pro['hits'] + 1;
$sql = "update  ".$data['pro']." set `hits`=".$hits." WHERE ID=".$id;
$res = mysql_query($sql);
$sql = "SELECT * FROM ".$data['banner']." WHERE classid=3 ORDER BY sort ASC LIMIT 0,1";
$banner=get_one($sql);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php include('../inc/keywords.php');?>
		<script src="../js/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/jquery.SuperSlide.2.1.1.js"></script>
		<script type="text/javascript" src="../js/dropdown.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="../css/header_footer.css">
		<link rel="stylesheet" type="text/css" href="../css/public.css">
		<link rel="stylesheet" type="text/css" href="../css/product.css">
		<!--[if IE]>
        <script src="../js/html5.js"></script>
        <![endif]-->
	</head>
	<body>
    <?php include('../inc/header.php');?>
		<!--主体内容-->
		<div class="banner2" style="background: url(<?php echo "../../".$banner['spicen'];?>)no-repeat center"></div>
		<div class="detail">
			<div class="container">
				<div class="left">
					<p class="title">PRODUCT</p>
					<p class="nynav">
                        <?php foreach ($pro_class as $key=>$val){?>
                            <a href="index.php?classid=<?php echo $val['classid'];?>" <?php if ($classid==$val['classid']){?>class="a2"<?php }?>><?php echo $val['class_name_en'];?></a>
                        <?php }?>
					</p>
                    <?php include('../inc/phone.php');?>
				</div>
				<div class="right">
					<div class="title">
						<p class="p1"><?php echo $pro_class_single['class_name_en'];?></p>
						<p class="p2">CURRENT POSITION：
							<a href="../home/index.php">HOME</a> »
							<a href="index.php">PRODUCT</a> »
							<a href="index.php?classid=<?php echo $pro_class_single['classid'];?>"><?php echo $pro_class_single['class_name_en'];?></a>
						</p>
					</div>
					<div class="text">
						<p class="p1"><?php echo $pro['title_en'];?></p>
						<p class="p2">AUTHOR：<?php if (!empty( $pro['author'])){echo $pro['author'];}else{echo "admin";}?>&nbsp;&nbsp;&nbsp;DATA：<?php echo date("Y-m-d",strtotime($pro['addTime']));?>&nbsp;&nbsp;&nbsp;VIEWS：<?php echo $pro['hits'];?></p>
						<p style="text-align: center;"><?php if (!empty($pro['content_en'])){echo $pro['content_en'];}else{echo "数据待更新";}?></p>
					</div>
                    <?php get_chapter($id,$data['pro'],$pro['classid']) ?>
				</div>
			</div>
		</div>
    <?php include("../inc/link.php"); ?>
		<!--页脚-->
    <?php include("../inc/footer.php"); ?>
	</body>
    <script>
        $('#nav').find('.navlist').eq(2).addClass('a1');
    </script>
</html>