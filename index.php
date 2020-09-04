<?php include "./cn/inc/conn.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php include('./cn/inc/keywords.php');?>
		<script src="./cn/js/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="./cn/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="./cn/js/jquery.SuperSlide.2.1.1.js"></script>
		<script type="text/javascript" src="./cn/js/dropdown.js"></script>
		<link rel="stylesheet" type="text/css" href="./cn/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="./cn/css/header_footer.css">
		<link rel="stylesheet" type="text/css" href="./cn/css/index.css">
		<!--[if IE]>
        <script src="./cn/js/html5.js"></script>
        <![endif]-->
	</head>
	<body>
    <?php include('./cn/inc/header.php');?>
		<!--广告轮播-->
    <?php
    $sql = "SELECT * FROM ".$data['banner']." WHERE classid=1 ORDER BY sort ASC";
    $banner=get_all($sql);
    ?>
		<div id="carousel1" class="carousel slide" data-ride="carousel" data-interval="4500" data-pause="none">
			<ol class="carousel-indicators">
                <?php foreach ($banner as $key=>$val){?>
                    <li data-target="#carousel1" data-slide-to="<?php echo $key;?>" <?php if ($key==0){?>class="active"<?php }?>></li>
                <?php }?>
			</ol>
			<div class="carousel-inner">
                <?php foreach ($banner as $key=>$val){?>
                    <div class="item <?php if ($key==0){?>active<?php }?>">
                        <img src="../../<?php echo $val['spic'];?>" class="img-responsive" alt="banner图">
                    </div>
                <?php }?>
			</div>
		</div>
    <?php
    $sql = "SELECT * FROM ".$data['classpro']." WHERE prv_id=0 ORDER BY sort ASC LIMIT 0,7";
    $pro_class_index=get_all($sql);
    ?>
		<div class="pro">
			<div class="container">
				<ul class="list">
                    <?php foreach ($pro_class_index as $key=>$val){?>
					<li>
						<a href="./cn/pro/index.php?classid=<?php echo $val['classid'];?>">
							<img src="../../<?php echo $val['class_img'];?>" />
							<p>- <?php echo $val['class_name_cn'];?> -</p>
						</a>
					</li>
                    <?php }?>.
				</ul>
                <?php
                $sql = "SELECT * FROM ".$data['banner']." WHERE classid=6 ORDER BY sort ASC";
                $ad_banner=get_one($sql);
                ?>
				<div class="all">
					<div class="left">
						<a href="./cn/pro/index.php">
							<img src="../../<?php echo $ad_banner['spic'];?>" />
						</a>
					</div>
					<div class="right">
						<ul>
                            <?php
                            $sql = "SELECT * FROM ".$data['pro']." WHERE tj=1 ORDER BY sort ASC LIMIT 0,6";
                            $pro_index=get_all($sql);
                            ?>
                            <?php foreach ($pro_index as $key=>$val){?>
							<li>
								<a href="./cn/pro/show.php?id=<?php echo $val['id'];?>">
                                    <?php if ($val['spic']){?>
                                        <img src="../../<?php echo $val['spic']?>" alt="<?php echo $val['title'];?>"/>
                                    <?php }else{?>
                                        <img src="./cn/images/no_picture.gif" alt="<?php echo $val['title'];?>"/>
                                    <?php }?>
									<p class="p1">- <?php echo $val['title'];?> -</p>
									<p class="p2"><?php echo $val['text'];?></p>
								</a>
							</li>
                            <?php }?>
						</ul>
					</div>

				</div>
			</div>
		</div>
    <?php
    $sql = "SELECT * FROM ".$data['about']." WHERE classid=3 ORDER BY sort ASC LIMIT 0,3";
    $ad_index=get_all($sql);
    ?>
		<div class="adv">
			<div id="slideTxtBox">
				<div class="hd">
					<ul>
                        <?php foreach ($ad_index as $key=>$val){?>
						<li>
							<?php echo $val['text'];?>
						</li>
                        <?php }?>
					</ul>
				</div>
				<div class="bd">
                    <?php foreach ($ad_index as $key=>$val){?>
					<ul>
						<li>
                            <?php if ($val['content']){echo $val['content'];}else{echo "<p>资料待更新</p>";}?>
						</li>
					</ul>
                    <?php }?>
				</div>
			</div>
			<script type="text/javascript">
				jQuery("#slideTxtBox").slide();
			</script>
		</div>
    <?php
    $sql = "SELECT * FROM ".$data['about']." WHERE classid=2 ORDER BY sort ASC LIMIT 0,1";
    $about_index=get_one($sql);
    ?>
		<div class="about">
			<div class="container">
				<div class="left">
					<img src="../../<?php echo $about_index['spic'];?>" />
				</div>
				<div class="right">
					<p class="p1"><?php echo $about_index['title'];?></p>
					<hr />
					<p class="p2"><?php if ($about_index['content']){echo $about_index['content'];}else{echo "<p>资料待更新</p>";}?></p>
					<a href="./cn/about/index.php">查看更多</a>
				</div>
			</div>
		</div>
    <?php include("./cn/inc/link.php"); ?>
		<!--页脚-->
    <?php include("./cn/inc/footer.php"); ?>
	</body>
    <script>
        $('#nav').find('.navlist').eq(0).addClass('a1');
    </script>
</html>