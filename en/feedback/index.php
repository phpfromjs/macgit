<?php include "../inc/conn.php";
if (!empty($_POST)) {
    $addTime = date("Y-m-d H:i:s");
    $language="English";//语言
    $company=$_POST['company'];
    $user = $_POST['user'];//用户名
    $fax=$_POST['fax'];
    $tel=$_POST['tel'];
    $phone = $_POST['phone'];//手机
    $email = $_POST['email'];//Email
    $content = $_POST['content'];//内容
    $ip = get_ip();//ip
    if (preg_match_all("/^0?(13[0-9]|15[0-35-9]|18[0-9]|14[57]|170)[0-9]{8}$/", $phone, $array)) {
        $sql = "INSERT INTO ".$data['feedback']." (title,company,user,fax,phone,email,content,addTime,ip) VALUES ('$language','$company','$user','$fax','$phone','$email','$content','$addTime','$ip')";
        $res = mysql_query($sql);
        if($res){
            echo "<script>alert('留言成功');location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('留言失败');history.go(-1);</script>";
            die;
        }
    }else{
        echo "<script>alert('请输入正确的手机号码！');history.go(-1)</script>";
    }
}
$sql = "SELECT * FROM ".$data['banner']." WHERE classid=4 ORDER BY sort ASC LIMIT 0,1";
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
		<div class="banner3" style="background: url(<?php echo "../../".$banner['spicen'];?>)no-repeat center"></div>
		<div class="detail">
			<div class="container">
				<div class="left">
					<p class="title">MESSAGE</p>
					<p class="nynav">
						<a href="index.php">ABOUT</a>
						<a href="index.php" class="a2">MESSAGE</a>
						<a href="../contact/index.php">CONTACT</a>
					</p>
                    <?php include('../inc/phone.php');?>
				</div>
				<div class="right">
					<div class="title">
						<p class="p1">MESSAGE</p>
						<p class="p2">CURRENT POSITION：
							<a href="../home/index.php">HOME</a> »
							<a href="index.php">MESSAGE</a>
						</p>
					</div>
					<div class="feedback">
                        <form action="index.php" method="post">
						<div class="row">
							<div class="col-md-6 col-xs-6 input">
                                Company：<input type="text" name="company" class="form" placeholder="" q/>
							</div>
							<div class="col-md-6 col-xs-6 input">
                                Linkman：<input type="text" name="user" class="form" placeholder="" required/>*
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-xs-6 input" style="margin-top: 10px;">
								Fax ：<input type="text" name="fax" class="form" placeholder="" />
							</div>
							<div class="col-md-6 col-xs-6 input" style="margin-top: 10px;">
								Phone：<input type="text" name="tel" class="form" placeholder="" required/>&nbsp;&nbsp;&nbsp;*
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-xs-6 input" style="margin-top: 10px;">
								Mobile：<input type="text" name="phone" class="form" placeholder="" required/>
							</div>
							<div class="col-md-6 col-xs-6 input" style="margin-top: 10px;">
								E-MAIL：<input type="text" name="email" class="form" placeholder="" required/>&nbsp;&nbsp;*
							</div>
						</div>
						<textarea rows="10" cols="100%" type="text" placeholder="Message content：" name="content" required></textarea>
						<button type="submit" class="btn1">SUBMIT</button>
                        </form>
					</div>
				</div>
			</div>
		</div>
    <?php include("../inc/link.php"); ?>
		<!--页脚-->
    <?php include("../inc/footer.php"); ?>
	</body>
    <script>
        $('#nav').find('.navlist').eq(3).addClass('a1');
    </script>
</html>