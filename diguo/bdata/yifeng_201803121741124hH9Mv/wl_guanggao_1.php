<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_guanggao`;");
E_C("CREATE TABLE `wl_guanggao` (
  `id` int(128) NOT NULL AUTO_INCREMENT COMMENT 'id号',
  `title` varchar(128) DEFAULT NULL COMMENT '中文标题',
  `title_en` varchar(128) DEFAULT NULL COMMENT '英文标题',
  `title_j` varchar(128) DEFAULT NULL,
  `src` varchar(256) DEFAULT NULL,
  `src_en` varchar(256) DEFAULT NULL,
  `src_j` varchar(256) DEFAULT NULL,
  `content` text COMMENT '中文内容',
  `content_en` text COMMENT '英文内容',
  `spic` varchar(128) DEFAULT NULL COMMENT '小图',
  `bpic` varchar(128) DEFAULT NULL COMMENT '大图',
  `bpicj` varchar(128) DEFAULT NULL,
  `sort` int(128) DEFAULT '0' COMMENT '排序',
  `passed` int(64) DEFAULT '0' COMMENT '审核',
  `tj` int(64) DEFAULT '0' COMMENT '推荐',
  `addTime` datetime DEFAULT NULL COMMENT '添加时间',
  `qy` int(10) NOT NULL DEFAULT '0',
  `p` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>