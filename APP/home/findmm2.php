<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/2/22
 * Time: 15:14
 * order: 忘记密码操作(完成)
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once ('../common/config.php');

$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$password =isset($_POST['pwd'])? md5($_POST['pwd']):'';

if(!$conn){
    echo "mysqli_error()";
}

if($phone !== null && $password !== null){
    $sql = "select `phone`,`password` from kq_login where `phone` = '{$phone}'";
    $query = mysqli_query($conn,$sql);
    $res = mysqli_fetch_assoc($query);
    if($res['phone'] !== null && $res['password'] !== null){
            $update = "update kq_login  set `password` = '{$password}' where `phone` = {$res['phone']}";
             mysqli_query($conn,$update);
             $rows = mysqli_affected_rows($conn);
            if($rows !== 0 && $rows>0){
                $code = 1;   //更改成功
                echo  json_encode($code);
            }else{
                $code = 'error';   //未更改
                echo json_encode($code);
            }

        }

}

