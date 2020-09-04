<?php include "../inc/conn.php";
if ($contact=getSingle("contact",'passed=1'," ORDER BY sort DESC LIMIT 0,1"))
{
    $t= $contact['t'];
    $k= $contact['k'];
    $d= $contact['d'];
}
else
{
    echo "<script language=javascript>history.go(-1);</script>";
    exit;
}
$sql = "SELECT * FROM ".$data['banner']." WHERE classid=5 ORDER BY sort ASC LIMIT 0,1";
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
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=eYWcrSI09OYj9GOeeMRpujYDpYX8Zees"></script>
		<!--[if IE]>
        <script src="../js/html5.js"></script>
        <![endif]-->
	</head>
	<body>
    <?php include('../inc/header.php');?>
		<!--主体内容-->
		<div class="banner4" style="background: url(<?php echo "../../".$banner['spic'];?>)no-repeat center"></div>
		<div class="detail">
			<div class="container">
				<div class="left">
					<p class="title">留言中心</p>
					<p class="nynav">
						<a href="index.php">公司简介</a>
						<a href="../feedback/index.php">在线留言</a>
						<a href="index.php" class="a2">联系我们</a>
					</p>
                    <?php include('../inc/phone.php');?>
				</div>
				<div class="right">
					<div class="title">
						<p class="p1">联系方式</p>
						<p class="p2">您的位置：
							<a href="../home/index.php">网站首页</a> »
							<a href="index.php">联系方式</a>
						</p>
					</div>
					<div class="map">
						<div class="erweima">
							<img src="../../<?php echo $contact['spic'];?>" />
							<div class="text">
								<p class="p1"><?php echo $contact['CompanyNameCn'];?></p>
								<p class="p2"><?php echo $contact['text'];?></p>
							</div>
						</div>
						<ul>
							<li>
								<img src="../images/icon17.png" />
								<p class="p1">地 址</p>
								<p class="p2"><?php echo $contact['AddressCn'];?></p>
							</li>
							<li>
								<img src="../images/icon18.png" />
								<p class="p1">移动电话</p>
								<p class="p2"><?php echo $contact['mobilephone1'];?></p>
								<p class="p2"><?php echo $contact['mobilephone2'];?></p>
							</li>
							<li>
								<img src="../images/icon19.png" />
								<p class="p1">固定电话</p>
								<p class="p2"><?php echo $contact['TelePhone'];?></p>
							</li>
							<li>
								<img src="../images/icon20.png" />
								<p class="p1">邮 箱</p>
								<p class="p2"><?php echo $contact['emailcn'];?></p>
							</li>
						</ul>
					</div>
					<div class="allmap" id="dituContent"></div>
				</div>
			</div>
		</div>
    <?php include("../inc/link.php"); ?>
		<!--页脚-->
    <?php include("../inc/footer.php"); ?>
		<script type="text/javascript">
			//创建和初始化地图函数：
			function initMap() {
				createMap(); //创建地图
				setMapEvent(); //设置地图事件
				addMapControl(); //向地图添加控件
				addMarker(); //向地图中添加marker
			}

			//创建地图函数：
			function createMap() {
				var map = new BMap.Map("dituContent"); //在百度地图容器中创建一个地图
                var point = new BMap.Point(<?php echo $contact['Longitude'];?>,<?php echo $contact['Latitude'];?>); //定义一个中心点坐标
				map.centerAndZoom(point, 18); //设定地图的中心点和坐标并将地图显示在地图容器中
				window.map = map; //将map变量存储在全局
			}

			//地图事件设置函数：
			function setMapEvent() {
				map.enableDragging(); //启用地图拖拽事件，默认启用(可不写)
				map.enableScrollWheelZoom(); //启用地图滚轮放大缩小
				map.enableDoubleClickZoom(); //启用鼠标双击放大，默认启用(可不写)
				map.enableKeyboard(); //启用键盘上下左右键移动地图
			}

			//地图控件添加函数：
			function addMapControl() {
				//向地图中添加缩放控件
				var ctrl_nav = new BMap.NavigationControl({
					anchor: BMAP_ANCHOR_TOP_LEFT,
					type: BMAP_NAVIGATION_CONTROL_LARGE
				});
				map.addControl(ctrl_nav);
				//向地图中添加缩略图控件
				var ctrl_ove = new BMap.OverviewMapControl({
					anchor: BMAP_ANCHOR_BOTTOM_RIGHT,
					isOpen: 1
				});
				map.addControl(ctrl_ove);
				//向地图中添加比例尺控件
				var ctrl_sca = new BMap.ScaleControl({
					anchor: BMAP_ANCHOR_BOTTOM_LEFT
				});
				map.addControl(ctrl_sca);
			}

			//标注点数组
			var markerArr = [{
				title: "<?php echo $contact['CompanyNameCn'];?>",
				content: "地址：<?php echo $contact['AddressCn'];?><br/>电话：<?php echo $contact['TelePhone'];?>",
                point: "<?php echo $contact['Longitude'];?>|<?php echo $contact['Latitude'];?>",
				isOpen: 1,
				icon: {
					w: 21,
					h: 21,
					l: 0,
					t: 0,
					x: 6,
					lb: 5
				}
			}];
			//创建marker
			function addMarker() {
				for(var i = 0; i < markerArr.length; i++) {
					var json = markerArr[i];
					var p0 = json.point.split("|")[0];
					var p1 = json.point.split("|")[1];
					var point = new BMap.Point(p0, p1);
					var iconImg = createIcon(json.icon);
					var marker = new BMap.Marker(point, {
						icon: iconImg
					});
					var iw = createInfoWindow(i);
					var label = new BMap.Label(json.title, {
						"offset": new BMap.Size(json.icon.lb - json.icon.x + 10, -20)
					});
					marker.setLabel(label);
					map.addOverlay(marker);
					label.setStyle({
						borderColor: "#808080",
						color: "#333",
						cursor: "pointer"
					});

					(function() {
						var index = i;
						var _iw = createInfoWindow(i);
						var _marker = marker;
						_marker.addEventListener("click", function() {
							this.openInfoWindow(_iw);
						});
						_iw.addEventListener("open", function() {
							_marker.getLabel().hide();
						})
						_iw.addEventListener("close", function() {
							_marker.getLabel().show();
						})
						label.addEventListener("click", function() {
							_marker.openInfoWindow(_iw);
						})
						if(!!json.isOpen) {
							label.hide();
							_marker.openInfoWindow(_iw);
						}
					})()
				}
			}
			//创建InfoWindow
			function createInfoWindow(i) {
				var json = markerArr[i];
				var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>" + json.content + "</div>");
				return iw;
			}
			//创建一个Icon
			function createIcon(json) {
				var icon = new BMap.Icon("http://api.map.baidu.com/lbsapi/creatmap/images/us_mk_icon.png", new BMap.Size(json.w, json.h), {
					imageOffset: new BMap.Size(-json.l, -json.t),
					infoWindowOffset: new BMap.Size(json.lb + 5, 1),
					offset: new BMap.Size(json.x, json.h)
				})
				return icon;
			}

			initMap(); //创建和初始化地图
		</script>
	</body>
    <script>
        $('#nav').find('.navlist').eq(4).addClass('a1');
    </script>
</html>