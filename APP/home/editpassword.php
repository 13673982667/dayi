<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/12/11
 * Time: 14:07
 * order:修改用户登录密码
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once ('../common/config.php');
include_once ('../common/response.php');

$A = json_decode(file_get_contents('./userinfo.php'),TRUE);
$oldpassword =isset($_POST['password'])? md5($_POST['password']):''; //原密码
$newpassword = isset($_POST['newpassword'])? md5($_POST['newpassword']):'';  //要设置的新密码
if(!$conn){
    echo "mysqli_errno()";
}

$sql = "select `password` from kq_login where id = '{$A['id']}'";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($query);


if($oldpassword !== '' && $newpassword !=='' && $oldpassword === $result['password']){
    $update = "update kq_login set `password` = '{$newpassword}' where id = '{$A['id']}'";
    mysqli_query($conn,$update);
    $rows =  mysqli_affected_rows($conn);
    if($rows>0){
        $code = 0;
        $message = "edit succ";
        $data = array('code'=>$code,'message'=>$message);
        echo json_encode($data);
    }

    
}elseif($oldpassword == '' || $newpassword =='' || $newpassword !== $result['password']){
    $code = 1;
    $message = "密码未完整填写或错误";
    $data = array('code'=>$code,'message'=>$message);
    echo json_encode($data);
   
}