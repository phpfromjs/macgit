<?php include "../inc/conn.php";
$classid = $_GET["classid"];
if (empty($classid)) {
    foreach(getSub("classpro","  prv_id=0"," order by sort ASC limit 0,1") as $vk)
    {
        $classid = $vk['classid'];
    }
}else {
    $classid = $classid;
}

if (empty($classid)||$vps=getRow("classpro","classid=".$classid."  and prv_id=0"))
{
    $t= $vps['t_en'];
    $k= $vps['k_en'];
    $d= $vps['d_en'];
}
else
{
//    echo "<script language=javascript>history.go(-1);</script>";
//    exit;
}
$sql = "SELECT * FROM ".$data['classpro']." WHERE classid =".$classid." ORDER BY sort ASC";
$pro_class_single=get_one($sql);
$sql = "SELECT * FROM ".$data['classpro']." WHERE prv_id=0 ORDER BY sort ASC";
$pro_class=get_all($sql);
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
							<a href="index.php"><?php echo $pro_class_single['class_name_en'];?></a>
						</p>
					</div>
					<ul class="all">
                        <?php
                        $pagesize=12;    //每页数量
                        $start=($page>1) ? ($page-1)*$pagesize : 0 ;

                        $arr = getList('pro',$start,$pagesize," and title<>'' and passed=1 and classid=".$classid,' order by sort desc');

                        $num_row = $arr['countAll'];
                        $num_rows = $arr['countAlls'];
                        $pages= intval($num_row/$pagesize);
                        if($num_row % $pagesize)
                        {
                            $pages++;
                        }
                        $i=1;?>
                        <?php if (!empty($arr['list'])){
                        foreach($arr['list'] as $key=> $val){?>
						<li>
							<a href="show.php?id=<?php echo $val['id'];?>">
								<div class="img">
                                    <?php if ($val['spicen']){?>
                                        <img src="../../<?php echo $val['spicen']?>" alt="<?php echo $val['title_en'];?>"/>
                                    <?php }else{?>
                                        <img src="../images/no_picture.gif" alt="<?php echo $val['title_en'];?>"/>
                                    <?php }?>
                                </div>
								<p><?php echo $val['title_en'];?></p>
							</a>
						</li>
                            <?php
                        }
                        }else{
                            echo "null";
                        }?>
					</ul>
                    <?php include('../inc/pages.php');?>
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