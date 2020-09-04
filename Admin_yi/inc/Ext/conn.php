<?php
$conn=mysql_connect($host, $user, $password) or die("连接MYSQL数据库失败:".mysql_error());
mysql_select_db($database, $conn) or die("连接数据库失败:".mysql_error());
mysql_query("set names '".$db_charset."'");
?>