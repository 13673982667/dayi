<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/6
 * Time: 10:12
 * order:验证码效验
 */

session_start();
header ( "Content-type: text/html; charset=utf-8" );
$code = strtolower(trim($_POST['code']));
if($code == strtolower($_SESSION['code'])){
    echo 1;
}else{
    echo 0;
}