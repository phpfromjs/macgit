<?php
$webinfo=get_one("SELECT * FROM ".$data['webinfo']);
?>
<div class="footer">
    <div class="container ">
        <div class="left">
            <p class="nav">
                <a href="../../cn/about/index.php">关于溢丰行</a>
                <a href="../../cn/pro/index.php">产品中心</a>
                <a href="../../cn/feedback/index.php">留言中心</a>
                <a href="../../cn/contact/index.php">联系我们</a>
            </p>
            <div class="text">
                <p>电话： <?php echo $webinfo['telephonecn'];?></p>
                <p>邮箱： <?php echo $webinfo['emailcn'];?></p>
                <p>地址：  <?php echo $webinfo['addresscn'];?></p>
            </div>
        </div>
        <div class="right">
            <img src="../../cn/images/logo02.png" />
        </div>
    </div>
    <div class="bottom">
        <div class="container">
            <p>
                <span><?php echo $webinfo['copyright'];?></span>
                <a href="http://www.miibeian.gov.cn " target="_blank ">备案号：<?php echo $webinfo['icp'];?></a>
                <a href="http://www.hzwl.net.cn " target="_blank ">技术支持：网联科技 </a>
            </p>
        </div>
    </div>
</div>