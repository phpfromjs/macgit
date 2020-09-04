<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_keyword`;");
E_C("CREATE TABLE `wl_keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qy` int(1) DEFAULT '0',
  `title` varchar(128) DEFAULT NULL COMMENT '中文标题',
  `title_en` varchar(128) DEFAULT NULL COMMENT '英文标题',
  `title_j` varchar(128) DEFAULT NULL,
  `linkurl` varchar(200) DEFAULT NULL COMMENT '链接地址',
  `linkurl_en` varchar(200) DEFAULT NULL COMMENT '链接地址(英文)',
  `filename` varchar(50) DEFAULT NULL COMMENT '文件名',
  `spic` varchar(64) DEFAULT NULL COMMENT '小图',
  `bpic` varchar(64) DEFAULT NULL COMMENT '大图',
  `bpicj` varchar(64) DEFAULT NULL,
  `sort` int(64) DEFAULT '0' COMMENT '排序',
  `tj` int(20) DEFAULT '0' COMMENT '推荐',
  `passed` int(64) DEFAULT '0' COMMENT '审核',
  `addTime` datetime DEFAULT NULL COMMENT '添加时间',
  `text` varchar(512) DEFAULT NULL,
  `text_en` varchar(512) DEFAULT NULL,
  `text_j` varchar(512) DEFAULT NULL,
  `classabout` varchar(150) DEFAULT NULL,
  `bid` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>