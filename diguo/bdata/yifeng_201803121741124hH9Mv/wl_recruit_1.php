<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_recruit`;");
E_C("CREATE TABLE `wl_recruit` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id号',
  `classid` int(128) DEFAULT NULL,
  `bid` int(128) DEFAULT NULL,
  `sort` int(120) DEFAULT NULL COMMENT '职位排序',
  `job` varchar(180) DEFAULT NULL COMMENT '职位名称',
  `job_en` varchar(180) DEFAULT NULL COMMENT '职位名称',
  `job_j` varchar(180) DEFAULT NULL COMMENT '职位名称',
  `nature` varchar(180) DEFAULT NULL COMMENT '工作性质',
  `nature_en` varchar(180) DEFAULT NULL COMMENT '工作性质',
  `nature_j` varchar(180) DEFAULT NULL COMMENT '工作性质',
  `place` varchar(180) DEFAULT NULL COMMENT '工作地点',
  `place_en` varchar(180) DEFAULT NULL COMMENT '工作地点',
  `place_j` varchar(180) DEFAULT NULL COMMENT '工作地点',
  `salary` varchar(180) DEFAULT NULL COMMENT '薪资范围',
  `salary_en` varchar(180) DEFAULT NULL COMMENT '薪资范围',
  `salary_j` varchar(180) DEFAULT NULL COMMENT '薪资范围',
  `num` varchar(180) DEFAULT NULL COMMENT '招聘人数',
  `num_en` varchar(180) DEFAULT NULL COMMENT '招聘人数',
  `num_j` varchar(180) DEFAULT NULL COMMENT '招聘人数',
  `content` text COMMENT '工作职责',
  `content_en` text COMMENT '工作职责',
  `content_j` text COMMENT '工作职责',
  `office` text COMMENT '任职资格',
  `office_en` text COMMENT '任职资格',
  `office_j` text COMMENT '任职资格',
  `passed` int(20) DEFAULT '0' COMMENT '审核',
  `addTime` datetime DEFAULT NULL COMMENT '添加时间',
  `deadline` datetime DEFAULT NULL COMMENT '截止时间',
  `hits` int(128) DEFAULT NULL COMMENT '浏览次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='招聘信息'");

require("../../inc/footer.php");
?>