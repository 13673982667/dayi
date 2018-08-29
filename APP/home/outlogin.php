<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/12/12
 * Time: 14:47
 * order: 退出登录
 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once ('../common/response.php');

$outlogin = isset($_POST['outlogin']) ? $_POST['outlogin'] :'error';

if($outlogin && $outlogin !=='error'){
    $userinfo = './userinfo.php';
    $param = './param.php';
    $file = is_file($param) ? 'TURE' : 'FALSE';
    if (file_exists($userinfo ) == TRUE && $file) {
                    unlink($userinfo);
                    unlink($param);
                    $code = 1;
                    $message = "缓存清除成功，已安全退出！";
                    $user = array('code'=>$code,'message'=>$message);
                    echo json_encode($user);
        }

    }else{
        $code = 1;
            $message = "缓存清除成功，已安全退出！";
            $user = array('code'=>$code,'message'=>$message);
            echo json_encode($user);
}