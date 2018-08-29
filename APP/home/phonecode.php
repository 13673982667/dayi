<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2
 * Time: 16:53
 * order :登录发送验证码
 */
//导入配置
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
session_start();
include_once ('../common/config.php');
include_once ('../common/response.php');
include_once ('./function.php');

//接受手机号码并验证

//	$phone = isset($_POST['pho'])?$_POST['pho']:'';
	$phone = $_POST['val'];
    $sql = "select phone from kq_login where phone = '{$phone}'";
    $query = mysqli_query($conn,$sql);
    $result = mysqli_fetch_array($query);
    if($result['phone'] == null){
            phone($phone);
    }else{
        $code = 1;
        $message = "error";
        $data = array('code'=>$code,'message'=>$message);
        echo json_encode($data);

    }



