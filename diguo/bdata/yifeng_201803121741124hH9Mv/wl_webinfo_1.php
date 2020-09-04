<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_webinfo`;");
E_C("CREATE TABLE `wl_webinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `title` text COMMENT '标题栏',
  `title_en` text COMMENT '标题栏',
  `title_j` varchar(512) DEFAULT NULL,
  `openflag` tinyint(10) DEFAULT NULL,
  `sitemail` varchar(50) DEFAULT NULL,
  `siteurl` varchar(150) DEFAULT NULL,
  `sitephone` varchar(50) DEFAULT NULL,
  `consultline` varchar(100) DEFAULT NULL COMMENT '咨询热线',
  `companycn` varchar(200) DEFAULT NULL COMMENT '公司名称（中文）',
  `companyen` varchar(200) DEFAULT NULL COMMENT '公司名称（英文）',
  `checkurl` varchar(200) DEFAULT NULL,
  `checkurlen` varchar(200) DEFAULT NULL,
  `addresscn` varchar(300) DEFAULT NULL COMMENT '地址',
  `addressen` varchar(200) DEFAULT NULL COMMENT '地址(英文)',
  `telephonecn` varchar(300) DEFAULT NULL COMMENT '电话',
  `telephoneen` varchar(200) DEFAULT NULL COMMENT '电话（英文）',
  `mobilephonecn` varchar(200) DEFAULT NULL COMMENT '手机（中文）',
  `mobilephoneen` varchar(200) DEFAULT NULL COMMENT '手机（英文）',
  `emailcn` varchar(200) DEFAULT NULL COMMENT '邮箱',
  `emailen` varchar(200) DEFAULT NULL,
  `faxcn` varchar(200) DEFAULT NULL COMMENT '传真（中文）',
  `faxen` varchar(200) DEFAULT NULL COMMENT '传真（英文）',
  `logo_cn` varchar(200) DEFAULT NULL COMMENT 'logo(中文)',
  `logo_en` varchar(200) DEFAULT NULL COMMENT 'logo(英文)',
  `fax` varchar(300) DEFAULT NULL COMMENT '传真',
  `qq` varchar(100) DEFAULT NULL COMMENT 'qq',
  `url` varchar(300) DEFAULT NULL COMMENT '网址',
  `icp` varchar(300) DEFAULT NULL COMMENT '备案号 ',
  `icpen` varchar(200) DEFAULT NULL,
  `wechatcode` varchar(300) DEFAULT NULL COMMENT '公众平台二维码',
  `selfwechatcode` varchar(300) DEFAULT NULL COMMENT '个人平台二维码',
  `wexplain` text,
  `copyright` varchar(150) DEFAULT NULL,
  `keyword` text COMMENT '关键字',
  `keyword_en` text COMMENT '关键字',
  `keyword_j` varchar(512) DEFAULT NULL,
  `descript` text COMMENT '描述信息',
  `descript_en` text COMMENT '描述信息',
  `descript_j` varchar(512) DEFAULT NULL,
  `contact` text COMMENT '联系方式',
  `contact_en` text COMMENT '联系方式',
  `contact_j` text,
  `about` text,
  `about_en` text,
  `about_j` text,
  `culture` text,
  `culture_en` text,
  `culture_j` text,
  `footer` text,
  `footer_en` text,
  `footer_j` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
E_D("replace into `wl_webinfo` values('1',0xe6b7b1e59cb3e5b882e6baa2e4b8b0e8a18ce8b4b8e69893e69c89e99990e585ace58fb8,0x5368656e7a68656e206f766572666c6f772062616e6b2074726164696e6720636f2e204c54442e,'','0','','',0x3133393238333836333635,0x3133393238333836333635,0xe6b7b1e59cb3e5b882e6baa2e4b8b0e8a18ce8b4b8e69893e69c89e99990e585ace58fb8,0x5368656e7a68656e206f766572666c6f772062616e6b2074726164696e6720636f2e204c54442e,'','',0x20e6b7b1e59cb3e5b882e7bd97e6b996e58cbae88eb2e5a198e8a197e98193e5bbb6e88ab3e8b7af3835e58fb7333031e5aea4,0x526f6f6d203330312c206e6f2e38352c2079616e66616e6720726f61642c206c69616e74616e67207374726565742c206c756f68752064697374726963742c207368656e7a68656e2e,0x3138333434333535303138,0x3138333434333535303138,'','',0x20796966656e6768616e67403136332e636f6d,0x20796966656e6768616e67403136332e636f6d,'','',0x776c5f75706c6f61642f7069632f313532303832343037322e6a7067,0x776c5f75706c6f61642f7069632f313532303832343037382e6a7067,'','','',0xe7b2a4494350e5a48730303030303030e58fb7,0x4775616e67646f6e6720494350207265736572766520303030303030302e,'','',0x5368656e7a68656e206f766572666c6f772062616e6b2074726164696e6720636f2e204c54442e,0x436f7079726967687420c2a920323031382020e6b7b1e59cb3e5b882e6baa2e4b8b0e8a18ce8b4b8e69893e69c89e99990e585ace58fb82020e78988e69d83e68980e69c89,0xe6b7b1e59cb3e5b882e6baa2e4b8b0e8a18ce8b4b8e69893e69c89e99990e585ace58fb8,0x5368656e7a68656e206f766572666c6f772062616e6b2074726164696e6720636f2e204c54442e,'',0xe6b7b1e59cb3e5b882e6baa2e4b8b0e8a18ce8b4b8e69893e69c89e99990e585ace58fb8,0x5368656e7a68656e206f766572666c6f772062616e6b2074726164696e6720636f2e204c54442e,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);");

require("../../inc/footer.php");
?>