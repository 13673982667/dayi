<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/12/8
 * Time: 11:07
 * order:我的订单-订单详情
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

$orderid= isset($_POST['orderid']) ? $_POST['orderid'] : '';

if($orderid !=''){
    mysqli_set_charset($conn, "utf8");
    $sql = "select ordertime,shops,money,sign,result,status from kq_orders where orderid = {$orderid}";
    $query=mysqli_query($conn,$sql);
    $data = array();
    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $data[] = $result;
    }

    $code = 1;
    $message = 'succ';
    Response::user($code,$message,$data);

}else{

    echo "error";
}
//*************************

