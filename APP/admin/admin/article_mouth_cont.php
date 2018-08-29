<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/19
 * Time: 18:01
 * order::口腔百科的详情
 */
header ( "Content-type: text/html; charset=utf-8" );
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
include_once("../common/config.php");

date_default_timezone_set('PRC'); //设置中国时区
$time = date("Y-m-d H:i:s");
$code = isset($_POST['id']) ? $_POST['id'] : '';

////自动查询出最新的五条数据ID
//$left = "select `id` from kq_article  where addtime < '{$time}' and keyword = 'mouth' order by id desc limit 5";
//$querytwo=mysqli_query($conn,$left);
//$dataleft = array();
//while ($result = mysqli_fetch_array($querytwo, MYSQLI_ASSOC)) {
//    $dataleft[] = $result;
//}
//
//$zone   = $dataleft[0]['id'];
//$one    = $dataleft[1]['id'];
//$two    = $dataleft[2]['id'];
//$three  = $dataleft[3]['id'];
//$four   = $dataleft[4]['id'];
//
//switch ($code)
//{
//    case 0:
//        $code = $zone;
//        break;
//    case 1:
//        $code = $one;
//        break;
//    case 2:
//        $code = $two;
//        break;
//    case 3:
//        $code = $three;
//        break;
//    case 4:
//        $code = $four;
//        break;
//    default:
//        'error';
//}

if($code !== ''){
    mysqli_set_charset($conn, "utf8");
    $sql = "select `cont`,`addtime`,`content`,`pic`,`id`,`title` from kq_article  where id = '{$code}'";
    $info=mysqli_query($conn,$sql);
    $date = array();
    while ($result = mysqli_fetch_array($info, MYSQLI_ASSOC)) {
        $date = $result;
    }
    $code = 1;
    $message = 'succ';
    $dat = array('code'=>$code,'message'=>$message,'date'=>$date);
    echo json_encode($dat);

}else{
    $code = 0;
    $message = 'filed';
    $dat = array('code'=>$code,'message'=>$message);
    echo json_encode($dat);

}