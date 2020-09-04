<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员列表</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
function confirmdel(id)
{
    if (confirm("真的要删除此管理员帐号?"))
    {
        window.location.href="AdminDel.php?id="+id+"  "
    }
}

$(document).ready(function(){
    $(".aclick").click(function(){
        $(".atip").fadeIn(200);
    });

    $(".mclick").click(function(){
        $(".mtip").fadeIn(200);
    });

    $(".dclick").click(function(){
        $(".dtip").fadeIn(200);
    });

    $(".tiptop a").click(function(){
        $(".atip").fadeOut(200);
        $(".mtip").fadeOut(200);
    });

    $(".sure").click(function(){
        $(".atip").fadeOut(200);
        $(".mtip").fadeOut(200);
    });

    $(".cancel").click(function(){
        $(".atip").fadeOut(200);
        $(".mtip").fadeOut(200);
    });
});
</script>
</head>
<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">系统设置</a></li>
        <li><a href="#">管理员信息</a></li>
    </ul>
</div>
<div class="rightinfo">
    <div class="tools">
        <ul class="toolbar">
            <li class="aclick"><a href="AdminAdd.php"><span><img src="../images/t01.png" /></span>添加</a></li>
        </ul>
    </div>
    <table class="tablelist">
        <thead>
            <tr>
                <th><input name="" type="checkbox" value="" /></th>
                <th>编号<i class="sort"><img src="../images/px.gif" /></i></th>
                <th>管理员帐号</th>
                <th>管理员密码</th>
                <th>姓名</th>
                <th>部门</th>
                <th>创建时间</th>
                <th>审核通过</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rs = "select * from ".$data['admin']." where adminjb=0 order by id desc";
            $resul = mysql_query($rs,$conn) or die("ERROR: ".mysql_error());
            while($title=mysql_fetch_array($resul))
            {
            ?>
            <tr>
                <td><input name="" type="checkbox" value="" /></td>
                <td><?php echo $title['id'];?></td>
                <td><?php echo $title['username'];?></td>
                <td><?php echo $title['Password'];?></td>
                <td><?php echo $title['realname'];?></td>
                <td><?php echo $title['depart'];?></td>
                <td><?php echo $title['LastLoginTime'];?></td>
                <td><?php if($title['openflag']==1) {echo "<font color='#00FF00'>已通过</font>";} else {echo "<font color='#FF0000'>未通过</font>";} ?></td>
                <td><a href="AdminModify.php?id=<?php echo $title['id'];?>" class="tablelink">查看</a>&nbsp;&nbsp;<a href="javascript:confirmdel('<?php echo $title['id'];?>')" class="tablelink">删除</a></td>
            </tr> 
            <?php
            }
            ?>
        </tbody>
    </table>
    <!--====添加按钮====-->   
    <div class="atip">
        <div class="tiptop"><span>提示信息</span><a></a></div>
        <div class="tipinfo">
            <span><img src="../images/ticon.png" /></span>
            <div class="tipright">
                <p>是否确认添加信息 ？</p>
                <cite>如果是请点击确定按钮，否则请点取消。</cite>
            </div>
        </div>
        <div class="tipbtn">
            <input name="" type="button" class="sure" value="确定" onclick="location.href='AdminAdd.php'" />&nbsp;
            <input name="" type="button" class="cancel" value="取消" />
        </div>
    </div>
    <!--====修改按钮====-->   
    <div class="mtip">
        <div class="tiptop"><span>提示信息</span><a></a></div>
        <div class="tipinfo">
            <span><img src="../images/ticon.png" /></span>
            <div class="tipright">
                <p>是否确认修改此信息 ？</p>
                <cite>如果是请点击确定按钮，否则请点取消。</cite>
            </div>
        </div>
        <div class="tipbtn">
            <input name="" type="button" class="sure" value="确定" onclick="location.href='AdminModify.php'" />&nbsp;
            <input name="" type="button" class="cancel" value="取消" />
        </div>
    </div>
    <!--====删除按钮====-->   
    <div class="mtip">
        <div class="tiptop"><span>提示信息</span><a></a></div>
        <div class="tipinfo">
            <span><img src="../images/ticon.png" /></span>
            <div class="tipright">
                <p>是否确认删除此信息 ？</p>
                <cite>如果是请点击确定按钮，否则请点取消。</cite>
            </div>
        </div>
        <div class="tipbtn">
            <input name="" type="button" class="sure" value="确定" onclick="location.href='AdminModify.php'" />&nbsp;
            <input name="" type="button" class="cancel" value="取消" />
        </div>
    </div>
</div>
<script type="text/javascript">
$('.tablelist tbody tr:odd').addClass('odd');
</script>
</body>
</html>
