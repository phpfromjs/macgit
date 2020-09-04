<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_gas`;");
E_C("CREATE TABLE `wl_gas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classid` int(128) DEFAULT '0' COMMENT '小类ID',
  `bid` int(128) DEFAULT '0' COMMENT '大类ID',
  `title` varchar(128) DEFAULT NULL COMMENT '中文标题',
  `title_en` varchar(128) DEFAULT NULL COMMENT '英文标题',
  `title_j` varchar(128) DEFAULT NULL,
  `text` text,
  `text_en` text,
  `text_j` text,
  `content` text COMMENT '中文内容',
  `content_en` text COMMENT '英文内容',
  `content_j` text,
  `synopsis` text,
  `synopsis_en` text,
  `synopsis_j` text,
  `hits` int(128) DEFAULT '0' COMMENT '点击数',
  `author` varchar(128) DEFAULT NULL COMMENT '作者',
  `author_en` varchar(128) DEFAULT NULL,
  `author_j` varchar(128) DEFAULT NULL,
  `spic` varchar(128) DEFAULT NULL COMMENT '小图',
  `bpic` varchar(128) DEFAULT NULL COMMENT '大图',
  `bpicj` varchar(128) DEFAULT NULL,
  `sort` int(128) DEFAULT '0' COMMENT '排序',
  `passed` int(20) DEFAULT '0' COMMENT '审核',
  `tj` int(20) DEFAULT '0' COMMENT '推荐',
  `isnew` int(20) DEFAULT NULL,
  `addTime` datetime DEFAULT NULL COMMENT '添加时间',
  `tpid` varchar(128) DEFAULT NULL,
  `t` varchar(512) DEFAULT NULL,
  `t_en` varchar(512) DEFAULT NULL,
  `t_j` varchar(512) DEFAULT NULL,
  `k` varchar(512) DEFAULT NULL,
  `k_en` varchar(512) DEFAULT NULL,
  `k_j` varchar(512) DEFAULT NULL,
  `d` varchar(512) DEFAULT NULL,
  `d_en` varchar(512) DEFAULT NULL,
  `d_j` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `title_en` (`title_en`),
  KEY `title_j` (`title_j`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>