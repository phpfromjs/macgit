<?php
$link=getSub("link",'passed=1'," ORDER BY sort ASC");
?>
<div class="link">
    <div class="container">
        <p>
            <span>LINK：</span>
            <?php foreach ($link as $key=>$val){?>
                <a href="<?php echo $val['linkurlen'];?>" target="_blank"><?php echo $val['title_en'];?> </a>
            <?php }?>
        </p>
    </div>
</div>