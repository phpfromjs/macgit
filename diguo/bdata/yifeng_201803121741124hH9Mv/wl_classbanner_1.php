<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_classbanner`;");
E_C("CREATE TABLE `wl_classbanner` (
  `classid` int(128) NOT NULL AUTO_INCREMENT COMMENT 'id号',
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
  `tj` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`classid`,`tj`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8");
E_D("replace into `wl_classbanner` values('1','0','1',0x7c317c,0xe9a696e9a1b5e8bdaee692ad,'','','1','','','',NULL,NULL,'','','','','','','','','','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0');");
E_D("replace into `wl_classbanner` values('2','0','2',0x7c327c,0xe585b3e4ba8ee6baa2e4b8b0e8a18c62616e6e6572e59bbe,'','','2','','','',NULL,NULL,'','','','','','','','','','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0');");
E_D("replace into `wl_classbanner` values('3','0','3',0x7c337c,0xe4baa7e59381e4b8ade5bf8362616e6e6572e59bbe,'','','3','','','',NULL,NULL,'','','','','','','','','','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0');");
E_D("replace into `wl_classbanner` values('4','0','4',0x7c347c,0xe79599e8a880e4b8ade5bf8362616e6e6572e59bbe,'','','4','','','',NULL,NULL,'','','','','','','','','','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0');");
E_D("replace into `wl_classbanner` values('5','0','5',0x7c357c,0xe88194e7b3bbe68891e4bbac62616e6e6572e59bbe,'','','5','','','',NULL,NULL,'','','','','','','','','','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0');");
E_D("replace into `wl_classbanner` values('6','0','6',0x7c367c,0xe9a696e9a1b5e4baa7e59381e5b9bfe5918ae59bbe,'','','6','','','',NULL,NULL,'','','','','','','','','','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0');");

require("../../inc/footer.php");
?>