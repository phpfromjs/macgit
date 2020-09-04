<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_classpro`;");
E_C("CREATE TABLE `wl_classpro` (
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
  `spicen` varchar(64) DEFAULT NULL,
  `bpic` varchar(128) DEFAULT NULL,
  `bpicen` varchar(64) DEFAULT NULL,
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
  `tj` int(10) NOT NULL,
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8");
E_D("replace into `wl_classpro` values('1','0','1',0x7c317c,0xe699bae883bde4baa7e59381e7b3bbe58897,0x496e74656c6c6967656e742070726f64756374,'','1',0x776c5f75706c6f61642f636c617373696d672f313532303833373432302e706e67,0x776c5f75706c6f61642f636c617373696d672f313532303833373432372e706e67,'',NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','0');");
E_D("replace into `wl_classpro` values('2','0','2',0x7c327c,0xe697a5e794a8e59381e7b3bbe58897,0x4461696c79206e65636573736974696573,'','2',0x776c5f75706c6f61642f636c617373696d672f313532303833373435352e706e67,0x776c5f75706c6f61642f636c617373696d672f313532303833373434382e706e67,'',NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','0');");
E_D("replace into `wl_classpro` values('3','0','3',0x7c337c,0xe69c8de8a385e4baa7e59381e7b3bbe58897,0x436c6f7468696e672070726f6475637473,'','3',0x776c5f75706c6f61642f636c617373696d672f313532303833373436372e706e67,0x776c5f75706c6f61642f636c617373696d672f313532303833373437322e706e67,'',NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','0');");
E_D("replace into `wl_classpro` values('4','0','4',0x7c347c,0xe58c85e8a385e4baa7e59381e7b3bbe58897,0x5061636b6167696e672070726f6475637473,'','4',0x776c5f75706c6f61642f636c617373696d672f313532303833373439302e706e67,0x776c5f75706c6f61642f636c617373696d672f313532303833373439342e706e67,'',NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','0');");
E_D("replace into `wl_classpro` values('5','0','5',0x7c357c,0xe6b1bde8bda6e794a8e59381e7b3bbe58897,0x4175746f20737570706c696573,'','5',0x776c5f75706c6f61642f636c617373696d672f313532303833373536302e706e67,0x776c5f75706c6f61642f636c617373696d672f313532303833373536342e706e67,'',NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','0');");
E_D("replace into `wl_classpro` values('6','0','6',0x7c367c,0xe58a9ee585ace69687e585b7e7b3bbe58897,0x4f66666963652073746174696f6e657279,'','6',0x776c5f75706c6f61642f636c617373696d672f313532303833373538382e706e67,0x776c5f75706c6f61642f636c617373696d672f313532303833373539332e706e67,'',NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','0');");
E_D("replace into `wl_classpro` values('7','0','7',0x7c377c,0xe5aea0e789a9e794a8e59381e7b3bbe58897,0x50657420737570706c696573,'','7',0x776c5f75706c6f61642f636c617373696d672f313532303833373631322e706e67,0x776c5f75706c6f61642f636c617373696d672f313532303833373631362e706e67,'',NULL,NULL,NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','0');");

require("../../inc/footer.php");
?>