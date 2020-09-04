<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧导航</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>
<script type="text/javascript">
$(function(){	
    //导航切换
    $(".menuson li").click(function(){
        $(".menuson li.active").removeClass("active")
        $(this).addClass("active");
    });

    $('.title').click(function(){
        var $ul = $(this).next('ul');
        $('dd').find('ul').slideUp();
        if ($ul.is(':visible'))
        {
            $(this).next('ul').slideUp();
        }
        else
        {
            $(this).next('ul').slideDown();
        }
    });
})	
</script>
</head>
<body style="background:#F0F9FD;">
<div class="lefttop"><span></span>后台管理</div>
<dl class="leftmenu">
    <dd>
        <div class="title"><span><img src="images/leftico01.png" /></span>系统设置</div>
        <ul class="menuson">
            <li class="active"><cite></cite><a href="Admin/index.php" target="rightFrame">后台首页</a><i></i></li>
            <li><cite></cite><a href="WebInfo/index.php" target="rightFrame">网站基本信息</a><i></i></li>
            <li style="display: none"><cite></cite><a href="Wapinfo/index.php" target="rightFrame">手机网站基本信息</a><i></i></li>
            <li><cite></cite><a href="Admin/AdminList.php" target="rightFrame">管理员信息</a><i></i></li>
        </ul>
    </dd>
    <dd style="display: none">
        <div class="title"><span><img src="images/leftico01.png" /></span>首页内容设置</div>
        <ul class="menuson">
            <li><cite></cite><a href="Index/index.php?type=footer" target="rightFrame">网站底部信息</a><i></i></li>
            <li style="display: none"><cite></cite><a href="CreateHtml/jt_home.php" target="rightFrame" class="mblue">生成静态-（网站首页）</a><i></i></li>
            <li><cite></cite><a href="CreateHtml/jt_map.php" target="rightFrame" class="mblue">生成网站地图</a><i></i></li>
        </ul>
    </dd>
    <dd>
        <div class="title"><span><img src="images/leftico01.png" /></span>幻灯片</div>
        <ul class="menuson">
            <li><cite></cite><a href="banner/bannerSort.php" target="rightFrame">类别管理</a><i></i></li>
            <li><cite></cite><a href="banner/bannerAdd.php" target="rightFrame">添加幻灯片</a><i></i></li>
            <li><cite></cite><a href="banner/bannerList.php" target="rightFrame">幻灯片列表</a><i></i></li>
        </ul>
    </dd>
    <dd>
        <div class="title"><span><img src="images/leftico01.png" /></span>单页管理</div>
        <ul class="menuson">
            <li><cite></cite><a href="About/AboutSort.php" target="rightFrame">类别管理</a><i></i></li>
            <li><cite></cite><a href="About/AboutAdd.php" target="rightFrame">添加文章</a><i></i></li>
            <li><cite></cite><a href="About/AboutList.php" target="rightFrame">文章列表</a><i></i></li>
            <li style="display: none"><cite></cite><a href="CreateHtml/jt_about.php" target="rightFrame" class="mblue">生成静态-(关于我们)</a><i></i></li>
        </ul>
    </dd>
    <dd>
        <div class="title"><span><img src="images/leftico01.png" /></span>产品展示</div>
        <ul class="menuson">
            <li><cite></cite><a href="Products/ProductSort.php" target="rightFrame">类别管理</a><i></i></li>
            <li><cite></cite><a href="Products/ProductAdd.php" target="rightFrame">添加产品</a><i></i></li>
            <li><cite></cite><a href="Products/ProductList.php" target="rightFrame">产品列表</a><i></i></li>
        </ul>
    </dd>
    <dd style="display: none">
        <div class="title"><span><img src="images/leftico01.png" /></span>国际物流</div>
        <ul class="menuson">
            <li><cite></cite><a href="logistics/logisticsSort.php" target="rightFrame">类别管理</a><i></i></li>
            <li><cite></cite><a href="logistics/logisticsAdd.php" target="rightFrame">添加产品</a><i></i></li>
            <li><cite></cite><a href="logistics/logisticsList.php" target="rightFrame">产品列表</a><i></i></li>
        </ul>
    </dd>
    <dd style="display: none">
        <div class="title"><span><img src="images/leftico01.png" /></span>新闻中心</div>
        <ul class="menuson">
            <li><cite></cite><a href="News/NewSort.php" target="rightFrame">类别管理</a><i></i></li>
            <li><cite></cite><a href="News/NewsAdd.php" target="rightFrame">添加新闻</a><i></i></li>
            <li><cite></cite><a href="News/NewsList.php" target="rightFrame">新闻列表</a><i></i></li>
        </ul>
    </dd>
    <dd style="display: none">
        <div class="title"><span><img src="images/leftico01.png" /></span>相册管理</div>
        <ul class="menuson">
            <li><cite></cite><a href="Picture/PictureSort.php" target="rightFrame">类别管理</a><i></i></li>
            <li><cite></cite><a href="Picture/PictureAdd.php" target="rightFrame">添加文章</a><i></i></li>
            <li><cite></cite><a href="Picture/PictureList.php" target="rightFrame">文章列表</a><i></i></li>
            <li style="display: none"><cite></cite><a href="CreateHtml/jt_advantage.php" target="rightFrame" class="mblue">生成静态-(公司优势)</a><i></i></li>
        </ul>
    </dd>
    <dd >
        <div class="title"><span><img src="images/leftico01.png" /></span>留言反馈</div>
        <ul class="menuson">
            <li><cite></cite><a href="Feedback/feedback.php" target="rightFrame">留言列表</a><i></i></li>
        </ul>
    </dd>
    <dd >
        <div class="title"><span><img src="images/leftico01.png" /></span>联系我们</div>
        <ul class="menuson">
            <li><cite></cite><a href="Contact/ContactAdd.php?qy=1" target="rightFrame">添加文章</a><i></i></li>
            <li><cite></cite><a href="Contact/ContactList.php?qy=1" target="rightFrame">文章列表</a><i></i></li>
            <li style="display: none"><cite></cite><a href="CreateHtml/jt_contact.php" target="rightFrame" class="mblue">生成静态-(联系我们)</a><i></i></li>

        </ul>
    </dd>
    <dd>
        <div class="title"><span><img src="images/leftico01.png" /></span>友情链接</div>
        <ul class="menuson">
            <li><cite></cite><a href="Link/LinkAdd.php?qy=1" target="rightFrame">添加文章</a><i></i></li>
            <li><cite></cite><a href="Link/LinkList.php?qy=1" target="rightFrame">文章列表</a><i></i></li>

        </ul>
    </dd>
    <dd style="display: none">
        <div class="title"><span><img src="images/leftico01.png" /></span>搜索关键词</div>
        <ul class="menuson">
            <li><cite></cite><a href="Keyword/KeywordAdd.php?qy=1" target="rightFrame">添加文章</a><i></i></li>
            <li><cite></cite><a href="Keyword/KeywordList.php?qy=1" target="rightFrame">文章列表</a><i></i></li>

        </ul>
    </dd>
</dl>
</body>
</html>
