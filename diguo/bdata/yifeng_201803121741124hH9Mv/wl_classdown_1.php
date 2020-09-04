<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_classdown`;");
E_C("CREATE TABLE `wl_classdown` (
  `classid` int(128) NOT NULL AUTO_INCREMENT COMMENT 'id号',
  `prv_id` int(128) DEFAULT '0' COMMENT '父类ID',
  `all_id` int(128) DEFAULT '0' COMMENT '所有ID',
  `link_id` varchar(128) DEFAULT NULL COMMENT '链接ID',
  `class_name_cn` varchar(128) DEFAULT NULL COMMENT '中文类名',
  `class_name_en` varchar(128) DEFAULT NULL COMMENT '英文类名',
  `class_name_j` varchar(128) DEFAULT NULL,
  `sort` int(128) DEFAULT '0' COMMENT '排序',
  `class_img` varchar(128) DEFAULT NULL COMMENT '图片',
  `lx` int(2) DEFAULT '0',
  `class_img_en` varchar(512) DEFAULT NULL,
  `class_img_j` varchar(512) DEFAULT NULL,
  `t` varchar(512) DEFAULT NULL,
  `t_en` varchar(512) DEFAULT NULL,
  `t_j` varchar(512) DEFAULT NULL,
  `k` varchar(512) DEFAULT NULL,
  `k_en` varchar(512) DEFAULT NULL,
  `k_j` varchar(512) DEFAULT NULL,
  `d` varchar(512) DEFAULT NULL,
  `d_en` varchar(512) DEFAULT NULL,
  `d_j` varchar(512) DEFAULT NULL,
  `p` varchar(128) DEFAULT NULL,
  `p_en` varchar(128) DEFAULT NULL,
  `p_j` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>