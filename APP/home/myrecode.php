<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/11/29
 * Time: 15:27
 * order:就诊记录表-详情表
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once ('../common/config.php');
include_once ('../common/response.php');

if(!$conn)
{
    echo "mysqli_erron()";
}


$visittime= isset($_POST['visittime']) ? $_POST['visittime'] : '';
//var_dump($visittime);

if($visittime != ''){
    mysqli_set_charset($conn, "utf8");
    $sql = "select visresult,pic from kq_visitingrecord where visittime = '{$visittime}'";
    $query=mysqli_query($conn,$sql);
    $end =  mysqli_fetch_array($query,MYSQLI_ASSOC);

    $code = 1;
    $message = 'succ';
    Response::user($code,$message,$end);

}else{
    echo "error";
}
