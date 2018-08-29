<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/1
 * Time: 10:35
 * idea: mysql 配置文件
 */
	$mysql_ser   = 'my3097533.xincache1.cn'; //数据库服务器名称
	$mysql_username = 'my3097533'; // 连接数据库用户名
	$mysql_password = 'J5b8P4E5'; // 连接数据库密码
	$mysql_database = 'my3097533'; // 数据库的名字
	$conn = mysqli_connect(	$mysql_ser,$mysql_username,$mysql_password,$mysql_database) or die("数据库链接错误");

?>
