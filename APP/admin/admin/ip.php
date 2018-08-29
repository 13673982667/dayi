<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/18
 * Time: 10:51
 */

function getIP() {
    $realip = ''; //设置默认值
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $realip = $_SERVER['HTTP_CLIENT_IP'];
    } else {
        $realip = $_SERVER['REMOTE_ADDR'];
    }

    preg_match('/^((?:\d{1,3}\.){3}\d{1,3})/',$realip,$match);
    return $match?$match[0]:false;
}