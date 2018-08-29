<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/6
 * Time: 11:39
 * order:检测系统管理员登录
 */

session_start();
header ( "Content-type: text/html; charset=utf-8" );
include_once("../common/config.php");
include_once "../admin/ip.php";



$username = isset($_POST['username']) ? $_POST['username'] :'';
$userpwd = isset($_POST['password']) ? MD5($_POST['password']) :'';
$ip = getIP();
$level = 1; //超级管理员(一般管理员)
date_default_timezone_set('PRC'); //设置中国时区
$time = date("Y-m-d H:i:s");

if($username !=='' && preg_match('/^[0-9a-zA-Z_\x{4e00}-\x{9fa5}]+$/u',$username))
{
    //对用户数据进行检测
    $sql ="select * from kq_user where usernc = '{$username}' and pwd = '{$userpwd}' and usertype =1";
    $info = mysqli_query($conn,$sql);
    $res = mysqli_fetch_array($info);
    if($username==$res['usernc'] && $userpwd==$res['pwd']){
        $_SESSION['id'] = 1;
        $_SESSION['usernc'] = $username;
        $insert = "insert into kq_login_records(`adminname`,`ip`,`addtime`,`type`) values('{$res['usernc']}','{$ip}','{$time}','{$level}')";
        $query = mysqli_query($conn,$insert);
        $row1 = mysqli_affected_rows($conn);
        echo 1;
    }else{
        echo 2;

        exit;
    }
}
else
{
    echo 3;
}
