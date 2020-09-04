<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_case`;");
E_C("CREATE TABLE `wl_case` (
  `id` int(128) NOT NULL AUTO_INCREMENT COMMENT 'id号',
  `classid` int(128) DEFAULT '0' COMMENT '小类ID',
  `bid` int(128) DEFAULT '0' COMMENT '大类ID',
  `link_id` varchar(128) DEFAULT NULL COMMENT '链接ID',
  `classid1` int(8) DEFAULT '0',
  `link_id1` varchar(512) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL COMMENT '标题',
  `title_en` varchar(128) DEFAULT NULL COMMENT '标题',
  `title_j` varchar(512) DEFAULT NULL,
  `model` varchar(200) DEFAULT NULL COMMENT '型号',
  `price` float DEFAULT NULL COMMENT '价格',
  `price1` float DEFAULT NULL COMMENT '价格',
  `text` text COMMENT '摘要',
  `text_en` text COMMENT '摘要',
  `text_j` text,
  `t` varchar(512) DEFAULT NULL,
  `t_en` text,
  `t_j` text,
  `k` varchar(512) DEFAULT NULL,
  `k_en` text,
  `k_j` text,
  `d` varchar(512) DEFAULT NULL,
  `d_en` text,
  `d_j` text,
  `content` text COMMENT '内容',
  `content_en` text COMMENT '内容',
  `content_j` text,
  `wdxz` text,
  `wdxz_en` text,
  `yyff` text,
  `yyff_en` text,
  `yyff_j` text,
  `nn` text,
  `nn_en` text,
  `nn_j` text,
  `spic` varchar(128) DEFAULT NULL COMMENT '小图',
  `bpic` varchar(128) DEFAULT NULL COMMENT '大图',
  `mpic` varchar(128) DEFAULT NULL COMMENT '更多图片',
  `sort` int(128) DEFAULT '0' COMMENT '排序',
  `hits` int(128) DEFAULT '0' COMMENT '点击数',
  `passed` int(20) DEFAULT '0' COMMENT '审核',
  `tj` int(20) DEFAULT '0' COMMENT '推荐',
  `addTime` datetime DEFAULT NULL COMMENT '添加时间',
  `s` varchar(512) DEFAULT NULL,
  `s_en` varchar(512) DEFAULT NULL,
  `gl` varchar(512) DEFAULT NULL,
  `src` varchar(512) DEFAULT NULL,
  `isnew` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `link_id` (`link_id`),
  KEY `link_id1` (`link_id1`(333)),
  KEY `title` (`title`),
  KEY `title_en` (`title_en`),
  KEY `title_j` (`title_j`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>