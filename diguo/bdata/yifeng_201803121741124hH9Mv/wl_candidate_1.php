<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_candidate`;");
E_C("CREATE TABLE `wl_candidate` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `job` varchar(120) DEFAULT NULL COMMENT '应聘职位',
  `name` varchar(120) DEFAULT NULL COMMENT '姓名',
  `sex` varchar(120) DEFAULT NULL COMMENT '性别',
  `age` varchar(120) DEFAULT NULL COMMENT '年龄',
  `native` varchar(120) DEFAULT NULL COMMENT '籍贯',
  `phone` varchar(20) DEFAULT NULL COMMENT '电话',
  `email` text COMMENT '邮箱',
  `address` varchar(120) DEFAULT NULL COMMENT '住址',
  `zip` varchar(20) DEFAULT NULL COMMENT '邮编',
  `intro` text COMMENT '自我介绍',
  `passed` int(20) DEFAULT '0' COMMENT '审核',
  `addtime` datetime DEFAULT NULL COMMENT '添加时间',
  `birthday` varchar(80) DEFAULT NULL,
  `ethnic` varchar(80) DEFAULT NULL,
  `health` varchar(80) DEFAULT NULL,
  `workingyears` varchar(80) DEFAULT NULL,
  `job_status` varchar(80) DEFAULT NULL,
  `experience` text,
  `expect_salary` varchar(50) DEFAULT NULL,
  `current_salary` varchar(50) DEFAULT NULL,
  `id_type` varchar(20) DEFAULT NULL,
  `id_number` varchar(100) DEFAULT NULL,
  `zhuangtai` int(10) DEFAULT '0',
  `edu_school` varchar(100) DEFAULT NULL,
  `edu_major` varchar(120) DEFAULT NULL COMMENT '专业',
  `edu_level` varchar(120) DEFAULT NULL COMMENT '学历',
  `edu_school_from` varchar(50) DEFAULT NULL,
  `edu_school_to` varchar(50) DEFAULT NULL,
  `edu_major_desc` text,
  `english_cet_type` varchar(50) DEFAULT NULL,
  `english_cet_score` varchar(50) DEFAULT NULL,
  `english_other_type` varchar(50) DEFAULT NULL,
  `english_other_score` varchar(50) DEFAULT NULL,
  `edu_certificate` text,
  `work_company` varchar(100) DEFAULT NULL,
  `work_position` varchar(100) DEFAULT NULL,
  `work_date_from` varchar(50) DEFAULT NULL,
  `work_date_to` varchar(50) DEFAULT NULL,
  `work_responsibility` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在线应聘'");

require("../../inc/footer.php");
?>