<?php

    //mysqli 配置为文件
    $mysql_ser   = '127.0.0.1'; //数据库服务器名称
    $mysql_username = 'root'; // 连接数据库用户名
    $mysql_password = ''; // 连接数据库密码
    $mysql_database = 'test'; // 数据库的名字
    $conn = mysqli_connect(	$mysql_ser,$mysql_username,$mysql_password,$mysql_database) or die("数据库链接错误");
























?>