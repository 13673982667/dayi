<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/27
 * Time: 10:03
 * order：退出登录
 */
header ( "Content-type: text/html; charset=UTF-8" );
$info = $_GET['q'];
if($info !=='' && $info){
    if($info == 'quit'){
        unset($_SESSION['usernc']);
        $_SESSION = array();

        echo "<script>alert('退出成功!');window.location.href='../index.html';</script>";

        exit;
    }
}