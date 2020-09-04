<?php
define('InEmpireBakData',TRUE);
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 5.1
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `wl_order`;");
E_C("CREATE TABLE `wl_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `ordernum` varchar(120) DEFAULT NULL COMMENT '订单号',
  `orderman` varchar(120) DEFAULT NULL COMMENT '订购人',
  `userr` varchar(128) DEFAULT NULL,
  `product` varchar(120) DEFAULT NULL COMMENT '产品名',
  `quantity` varchar(120) DEFAULT NULL COMMENT '数量',
  `price` varchar(50) DEFAULT NULL COMMENT '价格',
  `delivery` varchar(120) DEFAULT NULL COMMENT '交货日期',
  `company` varchar(120) DEFAULT NULL COMMENT '公司',
  `contactman` varchar(120) DEFAULT NULL COMMENT '联系人',
  `phone` varchar(20) DEFAULT NULL COMMENT '电话',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机',
  `fax` varchar(20) DEFAULT NULL COMMENT '传真',
  `address` varchar(120) DEFAULT NULL COMMENT '地址',
  `zip` varchar(120) DEFAULT NULL COMMENT '邮编',
  `email` varchar(120) DEFAULT NULL COMMENT '邮箱',
  `web` varchar(120) DEFAULT NULL COMMENT '网站',
  `content` text COMMENT '内容',
  `status` int(10) DEFAULT '0' COMMENT '订单状态(0.未处理1.已处理)',
  `addtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单信息'");

require("../../inc/footer.php");
?>