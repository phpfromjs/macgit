<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_admin`;");
E_C("CREATE TABLE `wl_admin` (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'ID号',
  `openflag` tinyint(10) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL COMMENT '用户名',
  `realname` varchar(128) DEFAULT NULL COMMENT '真实姓名',
  `depart` varchar(128) DEFAULT NULL COMMENT '所属部门',
  `Password` varchar(128) DEFAULT NULL COMMENT '用户密码',
  `lastLoginIip` varchar(20) DEFAULT NULL COMMENT '最后登录IP',
  `LastLoginTime` datetime DEFAULT NULL COMMENT '最后登录时间',
  `LastLogoutTime` datetime DEFAULT NULL COMMENT '最后退出系统时间',
  `LoginTimes` int(20) DEFAULT '0' COMMENT '登录次数',
  `power` varchar(128) DEFAULT NULL COMMENT '管理权限',
  `adminjb` int(20) DEFAULT '0' COMMENT '高级管理',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
E_D("replace into `wl_admin` values('1','1',0x6764776c6b6a,0xe5908ee58fb0e7aea1e79086,0xe4b89ae58aa1e983a8,0x3766656636313731343639653830643332633035353966383862333737323435,0x3132372e302e302e31,'2017-09-04 17:15:41','2017-09-06 14:02:01','9','0','0');");
E_D("replace into `wl_admin` values('2','1',0x796966656e67,0xe5908ee58fb0e7aea1e79086,'',0x3766656636313731343639653830643332633035353966383862333737323435,0x3132372e302e302e31,'2018-03-12 10:50:04','2017-09-28 13:27:40','6',NULL,'0');");

require("../../inc/footer.php");
?>