<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/2/22
 * Time: 15:00
 * order: 忘记密码操作(验证密码是否和原密码相同)
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once ('../common/config.php');
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$password =isset($_POST['pwd'])? md5($_POST['pwd']):'';

if(!$conn){
    echo "mysqli_errno()";
}

if($phone !== null && $password !== null){
    $sql = "select `phone`,`password` from kq_login where `phone` = '{$phone}' and `password` = '{$password}' ";
    $query =  mysqli_query($conn,$sql);
    $res = mysqli_fetch_assoc($query);
       if($res['password'] == $password){
           $code = 4;
          echo  json_encode($code);
       }

}

