<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/11/29
 * Time: 16:20
 * order:order:我的订单信息(简要信息)
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

$uid= isset($_POST['uid']) ? $_POST['uid'] : '';
if($uid !=''){
    mysqli_set_charset($conn, "utf8");
    $sql = "select `orderid`,`shops`,`money`,`sign` from kq_orders where uid = {$uid}";
    $query=mysqli_query($conn,$sql);
    $data = array();
    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $data[] = $result;
    }
    $code = 1;
    $message = 'succ';
    Response::user($code,$message,$data);

}






