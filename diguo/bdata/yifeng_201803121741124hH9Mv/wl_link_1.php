<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_link`;");
E_C("CREATE TABLE `wl_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qy` int(1) DEFAULT '0',
  `title` varchar(128) DEFAULT NULL COMMENT '中文标题',
  `title_en` varchar(128) DEFAULT NULL COMMENT '英文标题',
  `title_j` varchar(128) DEFAULT NULL,
  `linkurl` varchar(200) CHARACTER SET utf8 COLLATE utf8_danish_ci DEFAULT NULL COMMENT '链接地址',
  `linkurlen` varchar(300) DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
E_D("replace into `wl_link` values('1','1',0xe8bf9be587bae58fa3e8b4b8e69893,0x496d706f727420616e64206578706f7274207472616465,'','','','','','','','1','0','1','2018-03-12 15:24:54','','','',NULL,NULL);");
E_D("replace into `wl_link` values('2','1',0xe8bf9be587bae58fa3e8b4b8e69893,0x496d706f727420616e64206578706f7274207472616465,'','','','','','','','2','0','1','2018-03-12 15:29:26','','','',NULL,NULL);");

require("../../inc/footer.php");
?>