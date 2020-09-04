<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_user`;");
E_C("CREATE TABLE `wl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `username` varchar(120) DEFAULT NULL COMMENT '用户名',
  `password` varchar(120) DEFAULT NULL COMMENT '密码',
  `password2` varchar(120) DEFAULT NULL COMMENT '密码',
  `question` varchar(120) DEFAULT NULL COMMENT '问题',
  `answer` varchar(120) DEFAULT NULL COMMENT '答案',
  `realname` varchar(120) DEFAULT NULL COMMENT '真实姓名',
  `sex` varchar(20) DEFAULT NULL COMMENT '性别',
  `phone` varchar(20) DEFAULT NULL COMMENT '电话',
  `fax` varchar(20) DEFAULT NULL COMMENT '传真',
  `email` varchar(20) DEFAULT NULL COMMENT '邮箱',
  `address` varchar(120) DEFAULT NULL COMMENT '地址',
  `zip` varchar(20) DEFAULT NULL COMMENT '邮编',
  `qq` varchar(20) DEFAULT NULL COMMENT 'QQ',
  `msn` varchar(20) DEFAULT NULL COMMENT 'MSN',
  `company` varchar(120) DEFAULT NULL COMMENT '公司',
  `remark` text COMMENT '备注',
  `point` int(20) DEFAULT '0' COMMENT '积分',
  `LastLoginTime` datetime DEFAULT NULL COMMENT '最后登录时间',
  `LoginTimes` int(20) DEFAULT '0' COMMENT '登录次数',
  `passed` int(20) DEFAULT '0' COMMENT '审核',
  `regtime` datetime DEFAULT NULL COMMENT '注册时间',
  `web` varchar(512) DEFAULT NULL,
  `job` varchar(512) DEFAULT NULL,
  `codee` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员信息'");

require("../../inc/footer.php");
?>