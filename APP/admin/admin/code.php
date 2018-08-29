<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/12/26
 * Time: 10:43
 * order:验证码操作
 */
    session_start();
include "../common/Vcode.class.php";
//构造方法
$vcode = new Vcode(80, 40, 4);
//将验证码放到服务器自己的空间保存一份
$_SESSION['code'] = $vcode->getcode();
//将验证码图片输出
$vcode->outimg();