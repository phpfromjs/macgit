<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_pro`;");
E_C("CREATE TABLE `wl_pro` (
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
E_D("replace into `wl_pro` values('1','1','1',0x7c317c,'0','0','',0xe699bae883bde9a9ace6a1b6e79b96,0x536d61727420746f696c6574207365617420636f766572,'','','','','',0xe7aea1e79086e59198,0x61646d696e,'','',0xe58685e7bdaee699bae883bde88aafe78987efbc8ce58a9fe883bde5a49ae8808ce4b88de69d82efbc8ce59084e58fb8e585b6e8818c,0x546865206275696c742d696e20696e74656c6c6967656e7420636869702c207468652066756e6374696f6e206973206d616e7920616e64206e6f74206d697363656c6c616e656f75732c2065616368207369746820746865206a6f622e,'','','','','','','','','','',0x3c696d67207372633d222f776c5f75706c6f61642f55706c6f616446696c652f696d6167652f32303138303331322f32303138303331323134303832325f34353236332e6a70672220616c743d2222202f3e,0x3c696d67207372633d222f776c5f75706c6f61642f55706c6f616446696c652f696d6167652f32303138303331322f32303138303331323134303833355f38363531392e6a70672220616c743d2222202f3e,'','','','','','','','','','',0x776c5f75706c6f61642f70726f696d672f313532303833343837372e706e67,0x776c5f75706c6f61642f70726f696d672f313532303833343837382e706e67,'','','','1','5','1','1','2018-03-12 14:07:32','','','','','0');");
E_D("replace into `wl_pro` values('2','1','1',0x7c317c,'0','0','',0xe6b1bde8bda6e5ba8a,0x5468652063617220626564,'','','','','','','','','',0xe4bc98e8b4a8e5a4b4e5b182e79c9fe79aaeefbc8ce7bb99e5ada9e5ad90e69f94e8bdafe88892e98082e79a84e8a7a6e6849f,0x48696768207175616c6974792068656164206c61796572206c6561746865722c206769766520746865206368696c6420736f667420616e6420636f6d666f727461626c6520746f7563682e,'','','','','','','','','','',0x3c696d67207372633d222f776c5f75706c6f61642f55706c6f616446696c652f696d6167652f32303138303331322f32303138303331323134303931325f35393337352e6a70672220616c743d2222202f3e,0x3c696d67207372633d222f776c5f75706c6f61642f55706c6f616446696c652f696d6167652f32303138303331322f32303138303331323134303932325f39313930382e6a70672220616c743d2222202f3e,'','','','','','','','','','',0x776c5f75706c6f61642f70726f696d672f313532303833343934302e706e67,0x776c5f75706c6f61642f70726f696d672f313532303833343934342e706e67,'','','','2','9','1','1','2018-03-12 14:08:42','','','','','0');");

require("../../inc/footer.php");
?>