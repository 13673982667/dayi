<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/18
 * Time: 15:03
 * order:登录日志
 */

session_start();
header ( "Content-type: text/html; charset=utf-8" );
include_once("../common/config.php");
if (isset($_SESSION['usernc']) && !empty($_SESSION['usernc'])) {
   $code = isset($_POST['code']) ? $_POST['code'] : "";
   if($code !==null){
       $sql = "select * from kq_login_records where adminname = '{$_SESSION['usernc']}'";
       $query =  mysqli_query($conn,$sql);
       $res =  array();
       while( $jieguo= mysqli_fetch_assoc($query)){
                $res[] = $jieguo;
       }
       echo json_encode($res);
   }


}else{
    $echo ="<script>alert('您还没有登录,请登录!');";
    $echo .="window.location.href='../index.html';";
    $echo .="</script>";
    echo $echo;
}