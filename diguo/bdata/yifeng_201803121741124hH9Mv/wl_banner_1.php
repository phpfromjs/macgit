<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_banner`;");
E_C("CREATE TABLE `wl_banner` (
  `id` int(128) NOT NULL AUTO_INCREMENT COMMENT 'id号',
  `classid` int(128) DEFAULT '0' COMMENT '小类ID',
  `bid` int(128) DEFAULT '0' COMMENT '大类ID',
  `link_id` varchar(128) DEFAULT NULL COMMENT '链接ID',
  `classid1` int(8) DEFAULT '0',
  `link_id1` varchar(512) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL COMMENT '标题',
  `title_en` varchar(128) DEFAULT NULL COMMENT '标题',
  `title_j` varchar(512) DEFAULT NULL,
  `model` varchar(128) DEFAULT NULL COMMENT '型号',
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
  `yyff_j` varchar(255) DEFAULT NULL,
  `nn` text,
  `nn_en` text,
  `nn_j` varchar(255) DEFAULT NULL,
  `spic` varchar(128) DEFAULT NULL COMMENT '小图',
  `spicen` varchar(200) DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8");
E_D("replace into `wl_banner` values('1','1','1',0x7c317c,'0','',0x62616e6e6572e59bbe,'','','',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','',0x776c5f75706c6f61642f7069632f313532303833373239392e6a7067,0x776c5f75706c6f61642f70726f696d672f313532303833373330332e6a7067,'','','1','0','1','0','2018-03-12 14:47:29','','','','','0');");
E_D("replace into `wl_banner` values('2','1','1',0x7c317c,'0','',0x62616e6e6572e59bbe,'','','',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','',0x776c5f75706c6f61642f7069632f313532303833373332322e6a7067,0x776c5f75706c6f61642f70726f696d672f313532303833373332322e6a7067,'','','2','0','1','0','2018-03-12 14:48:29','','','','','0');");
E_D("replace into `wl_banner` values('3','1','1',0x7c317c,'0','',0x62616e6e6572e59bbe,'','','',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','',0x776c5f75706c6f61642f7069632f313532303833373333362e6a7067,0x776c5f75706c6f61642f70726f696d672f313532303833373334312e6a7067,'','','3','0','1','0','2018-03-12 14:48:48','','','','','0');");
E_D("replace into `wl_banner` values('4','2','2',0x7c327c,'0','',0x62616e6e6572e59bbe,'','','',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','',0x776c5f75706c6f61642f7069632f313532303834303738322e6a7067,0x776c5f75706c6f61642f70726f696d672f313532303834303738322e6a7067,'','','4','0','1','0','2018-03-12 15:46:03','','','','','0');");
E_D("replace into `wl_banner` values('5','3','3',0x7c337c,'0','',0x62616e6e6572e59bbe,'','','',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','',0x776c5f75706c6f61642f7069632f313532303834303739382e6a7067,0x776c5f75706c6f61642f70726f696d672f313532303834303830322e6a7067,'','','5','0','1','0','2018-03-12 15:46:29','','','','','0');");
E_D("replace into `wl_banner` values('6','4','4',0x7c347c,'0','',0x62616e6e6572e59bbe,'','','',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','',0x776c5f75706c6f61642f7069632f313532303834303831362e6a7067,0x776c5f75706c6f61642f70726f696d672f313532303834303832302e6a7067,'','','6','0','1','0','2018-03-12 15:46:48','','','','','0');");
E_D("replace into `wl_banner` values('7','5','5',0x7c357c,'0','',0x62616e6e6572e59bbe,'','','',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','',0x776c5f75706c6f61642f7069632f313532303834313438392e6a7067,0x776c5f75706c6f61642f70726f696d672f313532303834313533312e6a7067,'','','7','0','1','0','2018-03-12 15:58:01','','','','','0');");
E_D("replace into `wl_banner` values('8','6','6',0x7c367c,'0','',0xe5b9bfe5918ae59bbe,'','','',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','',0x776c5f75706c6f61642f7069632f313532303834363331362e706e67,0x776c5f75706c6f61642f70726f696d672f313532303834363332312e706e67,'','','8','0','1','0','2018-03-12 17:18:15','','','','','0');");

require("../../inc/footer.php");
?>