<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_logistics`;");
E_C("CREATE TABLE `wl_logistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classid` int(128) DEFAULT '0' COMMENT '小类ID',
  `bid` int(128) DEFAULT '0' COMMENT '大类ID',
  `link_id` varchar(128) DEFAULT NULL COMMENT '链接ID',
  `brandid` int(11) DEFAULT '0',
  `classid1` int(8) DEFAULT '0',
  `link_id1` varchar(512) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL COMMENT '标题',
  `title_en` varchar(128) DEFAULT NULL COMMENT '标题',
  `title_j` varchar(512) DEFAULT NULL,
  `model` varchar(200) DEFAULT NULL,
  `model_en` varchar(200) DEFAULT NULL,
  `price` varchar(128) DEFAULT NULL COMMENT '价格',
  `price1` varchar(128) DEFAULT NULL COMMENT '价格',
  `chandi` varchar(200) DEFAULT NULL,
  `chandien` varchar(200) DEFAULT NULL,
  `caizhi` varchar(200) DEFAULT NULL,
  `caizhien` varchar(200) DEFAULT NULL,
  `workarea` varchar(200) DEFAULT NULL,
  `workareaen` varchar(200) DEFAULT NULL,
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
  `proshow` text COMMENT '产品展示',
  `wdxz` text,
  `wdxz_en` text,
  `yyff` text,
  `yyff_en` text,
  `yyff_j` varchar(255) DEFAULT NULL,
  `nn` text,
  `nn_en` text,
  `nn_j` varchar(255) DEFAULT NULL,
  `spic` varchar(128) DEFAULT NULL COMMENT '小图',
  `spicen` varchar(64) DEFAULT NULL,
  `bpic` varchar(128) DEFAULT NULL COMMENT '大图',
  `bpicen` varchar(64) DEFAULT NULL,
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