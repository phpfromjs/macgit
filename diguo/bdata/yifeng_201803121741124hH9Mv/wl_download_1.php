<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_download`;");
E_C("CREATE TABLE `wl_download` (
  `id` int(128) NOT NULL AUTO_INCREMENT COMMENT 'id号',
  `classid` int(128) DEFAULT '0' COMMENT '小类ID',
  `bid` int(128) DEFAULT '0' COMMENT '大类ID',
  `title` varchar(128) DEFAULT NULL COMMENT '中文标题',
  `title_en` varchar(128) DEFAULT NULL COMMENT '英文标题',
  `title_j` varchar(128) DEFAULT NULL,
  `content` text COMMENT '中文内容',
  `content_en` text COMMENT '英文内容',
  `content_j` text,
  `DownTimes` int(128) DEFAULT '0' COMMENT '下载次数',
  `FileSize` varchar(128) DEFAULT NULL COMMENT '文件大小',
  `DownloadUrl` varchar(128) DEFAULT NULL COMMENT '下载文件',
  `DownloadUrl_en` varchar(128) DEFAULT NULL,
  `DownloadUrl_j` varchar(128) DEFAULT NULL,
  `FileType` varchar(128) DEFAULT NULL COMMENT '文件类型',
  `sort` int(128) DEFAULT '0' COMMENT '排序',
  `passed` int(20) DEFAULT '0' COMMENT '审核',
  `tj` int(20) DEFAULT '0' COMMENT '推荐',
  `addTime` datetime DEFAULT NULL COMMENT '添加时间',
  `bb` varchar(256) DEFAULT NULL,
  `yy` varchar(512) DEFAULT NULL,
  `yy_en` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `title_en` (`title_en`),
  KEY `title_j` (`title_j`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>