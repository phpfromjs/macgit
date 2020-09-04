<?php
$link=getSub("link",'passed=1'," ORDER BY sort ASC");
?>
<div class="link">
    <div class="container">
        <p>
            <span>友情链接：</span>
            <?php foreach ($link as $key=>$val){?>
                <a href="<?php echo $val['linkurl'];?>" target="_blank"><?php echo $val['title'];?> </a>
            <?php }?>
        </p>
    </div>
</div>