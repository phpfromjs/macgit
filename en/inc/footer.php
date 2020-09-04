<?php
$webinfo=get_one("SELECT * FROM ".$data['webinfo']);
?>
<div class="footer">
    <div class="container ">
        <div class="left">
            <p class="nav">
                <a href="../about/index.php">ABOUT</a>
                <a href="../pro/index.php">PRODUCT</a>
                <a href="../feedback/index.php">MESSAGE</a>
                <a href="../contact/index.php">CONTACT</a>
            </p>
            <div class="text">
                <p>TELEPHONE： <?php echo $webinfo['telephoneen'];?></p>
                <p>EMAIL： <?php echo $webinfo['emailen'];?></p>
                <p>ADDRESS：  <?php echo $webinfo['addressen'];?></p>
            </div>
        </div>
        <div class="right">
            <img src="../images/logo02.png" />
        </div>
    </div>
    <div class="bottom">
        <div class="container">
            <p>
                <span><?php echo $webinfo['wexplain'];?></span>
                <a href="http://www.miibeian.gov.cn " target="_blank ">ICP：<?php echo $webinfo['icpen'];?></a>
                <a href="http://www.hzwl.net.cn " target="_blank ">TECHNICAL SUPPORT：GDWL </a>
            </p>
        </div>
    </div>
</div>