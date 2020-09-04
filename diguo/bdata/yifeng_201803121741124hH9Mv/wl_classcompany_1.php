<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_classcompany`;");
E_C("CREATE TABLE `wl_classcompany` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `prv_id` int(128) DEFAULT '0' COMMENT '父类ID',
  `all_id` int(128) DEFAULT '0' COMMENT '所有ID',
  `link_id` varchar(128) DEFAULT NULL COMMENT '链接ID',
  `class_name_cn` varchar(128) DEFAULT NULL COMMENT '中文类名',
  `class_name_en` varchar(128) DEFAULT NULL COMMENT '英文类名',
  `class_name_j` varchar(128) DEFAULT NULL,
  `sort` int(128) DEFAULT '0' COMMENT '排序',
  `class_img` varchar(128) DEFAULT NULL COMMENT '图片',
  `class_img_en` varchar(128) DEFAULT NULL,
  `class_img_j` varchar(128) DEFAULT NULL,
  `spic` varchar(128) DEFAULT NULL,
  `bpic` varchar(128) DEFAULT NULL,
  `class_txt_cn` text COMMENT '说明',
  `class_txt_en` text COMMENT '说明',
  `class_txt_j` text,
  `t` varchar(512) DEFAULT NULL,
  `t_en` varchar(512) DEFAULT NULL,
  `t_j` varchar(512) DEFAULT NULL,
  `k` varchar(512) DEFAULT NULL,
  `k_en` varchar(512) DEFAULT NULL,
  `k_j` text,
  `d` varchar(512) DEFAULT NULL,
  `d_en` varchar(512) DEFAULT NULL,
  `d_j` text,
  `p` varchar(512) DEFAULT NULL,
  `a1` text,
  `a1_en` text,
  `a2` text,
  `a2_en` text,
  `a3` text,
  `a3_en` text,
  `a4` text,
  `a4_en` text,
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>