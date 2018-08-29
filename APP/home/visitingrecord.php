<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/11/29
 * Time: 15:27
 * order:就诊记录表
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
    $sql = "select sign,visittime from kq_visitingrecord where uid = {$uid}";
    $query=mysqli_query($conn,$sql);
    $data = array();
    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $data[] = $result;
    }

    $code = 1;
    $message = 'succ';
    Response::user($code,$message,$data);

}