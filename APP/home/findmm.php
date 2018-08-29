<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/2/22
 * Time: 14:45
 * order: 忘记密码操作(验证手机号码是否注册)
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once ('../common/config.php');
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
if(!$conn){
    echo "mysqli_errno()";
}

if($phone !== null )
{
   $sql =  "select `phone` from kq_login where `phone` = '{$phone}' ";
   $query = mysqli_query($conn,$sql);

   if(mysqli_fetch_assoc($query) !== null){
       $code = 3;
       echo json_encode($code);
   }else{
       $code = 1;
       echo json_encode($code);
   }
}
