<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/19
 * Time: 15:01
 * order:牙齿美白页面的文章操作
 */
header ( "Content-type: text/html; charset=utf-8" );
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
include_once("../common/config.php");
date_default_timezone_set('PRC'); //设置中国时区
$time = date("Y-m-d H:i:s");
$code = isset($_POST['code']) ? $_POST['code'] : 'ERR';

if($code !== 'ERR' && $code)

{
    mysqli_set_charset($conn, "utf8");
    $sql = "select `title`,`pic`,`id`,`addtime` from kq_article  where addtime < '{$time}' and keyword = 'teeth' order by id desc limit 5";
    $query = mysqli_query($conn,$sql);
    $data = array();
    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC))
    {

        $data[] = $result;

    }

    $code = 1;
    $message = 'succ';
    $dat = array('code'=>1,'message'=>$message,'data'=>$data);
    echo json_encode($dat);
}

else

{
    $code = 0;
    $message = 'err';
    $dat = array('code'=>0,'message'=>$message);
    echo json_encode($dat);

}



