<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/12/29
 * Time: 15:23
 * order: 文章处理函数
 */
    function article($content){
        $str=strip_tags($content);//将html格式去掉
        $str= preg_replace('/ /', '', $str);//删除空格
        $str=mb_substr($str,0,88,'utf-8');//截取字段
        return  $newStr = $str.'.....';

    }