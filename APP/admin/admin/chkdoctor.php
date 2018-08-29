<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/29
 * Time: 13:31
 * order:医师登录检测
 */

session_start();
header ( "Content-type: text/html; charset=utf-8" );
include_once("../common/config.php");
include_once "../admin/ip.php";



$username = isset($_POST['username']) ? $_POST['username'] :'';
$userpwd = isset($_POST['password']) ? MD5($_POST['password']) :'';
$ip = getIP();
date_default_timezone_set('PRC'); //设置中国时区
$time = date("Y-m-d H:i:s");
$level = 2; //医师权限(一般管理员)
if($username !=='' && preg_match('/^[0-9a-zA-Z_\x{4e00}-\x{9fa5}]+$/u',$username))
{
    //对用户数据进行检测
    $sql ="select * from kq_doctor where `doc_username` = '{$username}' and `doc_password` = '{$userpwd}' ";
    $info = mysqli_query($conn,$sql);
    $res = mysqli_fetch_array($info);
    if($username == $res['doc_username'] && $userpwd == $res['doc_password']){
        $_SESSION['id'] = 1;
        $_SESSION['usernc'] = $username;
        $_SESSION['id'] =$res['id'];
        echo 1;
        $insert = "insert into kq_login_records(`adminname`,`ip`,`addtime`,`type`) values('{$res['doc_username']}','{$ip}','{$time}','{$level}')";
        $query = mysqli_query($conn,$insert);
        $row1 = mysqli_affected_rows($conn);

    }else{
        echo 2;

        exit;
    }
}
else
{
    echo 3;
}