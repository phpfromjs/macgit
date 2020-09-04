<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_feedback`;");
E_C("CREATE TABLE `wl_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `title` varchar(120) DEFAULT NULL COMMENT '标题',
  `user` varchar(120) DEFAULT NULL COMMENT '用户',
  `sex` varchar(20) DEFAULT NULL COMMENT '性别',
  `company` varchar(120) DEFAULT NULL COMMENT '公司',
  `country` varchar(80) DEFAULT NULL COMMENT '国家',
  `phone` varchar(80) DEFAULT NULL COMMENT '电话',
  `fax` varchar(80) DEFAULT NULL COMMENT '传真',
  `email` varchar(80) DEFAULT NULL COMMENT '邮箱',
  `address` varchar(120) DEFAULT NULL COMMENT '地址',
  `zip` varchar(80) DEFAULT NULL COMMENT '邮编',
  `content` text COMMENT '内容',
  `usericon` varchar(80) DEFAULT NULL COMMENT '用户头像',
  `reply` text COMMENT '回复',
  `passed` int(20) DEFAULT '0' COMMENT '审核',
  `retime` datetime DEFAULT NULL COMMENT '回复',
  `addtime` datetime DEFAULT NULL COMMENT '添加时间',
  `lx` varchar(100) DEFAULT NULL,
  `tel` varchar(512) DEFAULT NULL,
  `msn` varchar(128) DEFAULT NULL,
  `qq` varchar(128) DEFAULT NULL,
  `ip` varchar(300) DEFAULT NULL COMMENT 'IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='意见反馈'");

require("../../inc/footer.php");
?>