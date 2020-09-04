<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>在线应聘</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
if (!empty($_GET['pID']))
{
    $id = $_GET['pID'];
    $page = $_GET['page'];
    $sql = "SELECT * FROM ".$data['candidate']." WHERE id='$id'";
    $result = mysql_query($sql, $conn) or die("Error:".mysql_error());
    $res = mysql_fetch_array($result);
    if (mysql_num_rows($result) != 0)
    {
?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">在线应聘</a></li>
        <li><a href="#">查看信息</a></li>
    </ul>
</div>
<div class="formbody">
    <div class="formtitle"><span>应聘信息</span></div>
    <ul class="forminfo">
        <li><label>应聘职位</label><b><?php echo $res['job'];?></b><i></i></li>
        <li><label>姓&nbsp;&nbsp;&nbsp;&nbsp;名</label><font color="#FF0000"><?php echo $res['name'];?></font></li>
        <li><label>性&nbsp;&nbsp;&nbsp;&nbsp;别 </label><?php echo $res['sex'];?></li>
        <li><label>出生日期</label><?php echo $res['birthday'];?></li>
        <li><label>学&nbsp;&nbsp;&nbsp;&nbsp;历</label><?php echo $res['edu_level'];?></li>
        <li><label>工作年限</label><?php echo $res['workingyears'];?></li>
        <li><label>联系电话</label><font color="#FF0000"><?php echo $res['phone'];?></font></li>
        <li><label>电子信箱</label><font color="#FF0000"><?php echo $res['email'];?></font></li>
        <li><label>求职状态</label><?php echo $res['job_status'];?></li>
        <li><label>户口地址</label><?php echo $res['zip'];?></li>
        <li><label>现居地址</label><?php echo $res['address'];?></li>
        <li><label>目前薪资</label><?php echo $res['current_salary'];?></li>
        <li><label>期望薪资</label><?php echo $res['expect_salary'];?></li>
        <li><label>证件号码</label><?php echo $res['id_type'];?>（<?php echo $res['id_number'];?>）</li>
        <li><label>身高</label><?php echo $res['health'];?> cm</li>
        <li><label>婚姻状况</label><?php echo $res['ethnic'];?></li>
        <li><label>自我介绍</label><?php echo $res['intro'];?></li>
        <li><strong><font color="#FF0000">最高学历</font></strong></li>
        <li><label>毕业院校</label><?php echo $res['edu_school'];?></li>
        <li><label>专　　业</label><?php echo $res['edu_major'];?></li>
        <li><label>在校时间</label><?php echo $res['edu_school_from'];?> 年 - <?php echo $res['edu_school_to'];?> 年</li>
        <li><label>学　　历</label><?php echo $res['edu_level'];?></li>
        <li><label>专业描述</label><?php echo $res['edu_major_desc'];?></li>
        <li><label>英语等级</label><?php echo $res['english_cet_type'];?>（<?php echo $res['english_cet_score'];?>分）</li>
        <li><label>其他英语等级</label><?php echo $res['english_other_type'];?>（<?php echo $res['english_other_score'];?>分）</li>
        <li><label>其他证书</label><?php echo $res['edu_certificate'];?></li>
        <li><strong><font color="#FF0000">工作经历</font></strong></li>
        <li><label>工作单位</label><?php echo $res['work_company'];?></li>
        <li><label>职　　位</label><?php echo $res['work_position'];?></li>
        <li><label>工作时间</label><?php echo $res['work_date_from'];?> 年 - <?php echo $res['work_date_to'];?> 年</li>
        <li><label>职责描述</label><?php echo $res['work_responsibility'];?></li>
        <li><label>提交时间</label><?php echo $res['addtime'];?></li>
        <li><label>&nbsp;</label><input type="button" name="" value="返&nbsp;&nbsp;&nbsp;&nbsp;回" onClick="javascript:window.history.back(-1);" class="btn" /></li>
    </ul>
</div>
<?php
    }
}
?>
</body>
</html>
