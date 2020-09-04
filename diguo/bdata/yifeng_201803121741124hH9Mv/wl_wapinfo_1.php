<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_wapinfo`;");
E_C("CREATE TABLE `wl_wapinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `title` text COMMENT '标题栏',
  `title_en` text COMMENT '标题栏',
  `title_j` varchar(512) DEFAULT NULL,
  `openflag` tinyint(10) DEFAULT NULL,
  `sitemail` varchar(50) DEFAULT NULL,
  `siteurl` varchar(150) DEFAULT NULL,
  `sitephone` varchar(50) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL COMMENT '地址',
  `telephone` varchar(300) DEFAULT NULL COMMENT '电话',
  `fax` varchar(300) DEFAULT NULL COMMENT '传真',
  `url` varchar(300) DEFAULT NULL COMMENT '网址',
  `icp` varchar(300) DEFAULT NULL COMMENT '备案号 ',
  `wechatcode` varchar(300) DEFAULT NULL COMMENT '公众平台二维码',
  `selfwechatcode` varchar(300) DEFAULT NULL COMMENT '个人平台二维码',
  `wexplain` text,
  `copyright` varchar(150) DEFAULT NULL,
  `keyword` text COMMENT '关键字',
  `keyword_en` text COMMENT '关键字',
  `keyword_j` varchar(512) DEFAULT NULL,
  `descript` text COMMENT '描述信息',
  `descript_en` text COMMENT '描述信息',
  `descript_j` varchar(512) DEFAULT NULL,
  `contact` text COMMENT '联系方式',
  `contact_en` text COMMENT '联系方式',
  `contact_j` text,
  `about` text,
  `about_en` text,
  `about_j` text,
  `culture` text,
  `culture_en` text,
  `culture_j` text,
  `footer` text,
  `footer_en` text,
  `footer_j` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>