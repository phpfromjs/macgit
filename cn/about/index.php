<?php include "../inc/conn.php";
$classid = 1;
if (empty($classid)) {
    foreach(getSub("classabout","  prv_id=0"," order by sort ASC limit 0,1") as $vk)
    {
        $classid = $vk['classid'];
    }
}else {
    $classid = $classid;
}

if (empty($classid)||$vps=getRow("classabout","classid=".$classid."  and prv_id=0"))
{
    $t= $vps['t'];
    $k= $vps['k'];
    $d= $vps['d'];
}
else
{
//    echo "<script language=javascript>history.go(-1);</script>";
//    exit;
}
$sql = "SELECT * FROM ".$data['classabout']." WHERE classid =".$classid." ORDER BY sort ASC";
$about_class_single=get_one($sql);
$sql = "SELECT * FROM ".$data['about']." WHERE classid=".$classid ." ORDER BY sort ASC LIMIT 0,1";
$about=get_one($sql);
$sql = "SELECT * FROM ".$data['banner']." WHERE classid=2 ORDER BY sort ASC LIMIT 0,1";
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
		<link rel="stylesheet" type="text/css" href="../css/about.css">
		<!--[if IE]>
        <script src="../js/html5.js"></script>
        <![endif]-->
	</head>
	<body>
    <?php include('../inc/header.php');?>
		<!--主体内容-->
		<div class="banner1" style="background: url(<?php echo "../../".$banner['spic'];?>)no-repeat center"></div>
		<div class="detail">
			<div class="container">
				<div class="left">
					<p class="title"><?php echo $about_class_single['class_name_cn'];?></p>
					<p class="nynav">
						<a href="index.php" class="a2"><?php echo $about_class_single['class_name_cn'];?></a>
						<a href="../feedback/index.php">在线留言</a>
						<a href="../contact/index.php">联系我们</a>
					</p>
                    <?php include('../inc/phone.php');?>
				</div>
				<div class="right">
					<div class="title">
						<p class="p1"><?php echo $about['title'];?></p>
						<p class="p2">您的位置： <a href="../home/index.php">网站首页</a> » <a href="index.php"><?php echo $about_class_single['class_name_cn'];?></a></p>
					</div>
					<div class="text">
                        <?php if ($about['content']){echo $about['content'];}else{echo "<p>资料待更新</p>";}?>
					</div>
				</div>
			</div>
		</div>
    <?php include("../inc/link.php"); ?>
		<!--页脚-->
    <?php include("../inc/footer.php"); ?>
	</body>
    <script>
        $('#nav').find('.navlist').eq(1).addClass('a1');
    </script>
</html>