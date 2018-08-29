<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/31
 * Time: 19:36
 * order:预约中显示医生
 */


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once ('../common/config.php');


 $code = isset($_POST['code']) ? $_POST['code'] : "";

 if($code !== ""){
     mysqli_set_charset($conn, "utf8");
     $sql ="select `truename`,`pic`,`jineng`,`id` from kq_doctor";
     $info = mysqli_query($conn,$sql);
     $data = array();
     while($res = mysqli_fetch_assoc($info)){
         $data[] = $res;
     };
//     var_dump($data);
     echo json_encode($data);

 }