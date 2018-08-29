<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/2/3
 * Time: 14:24
 * order: 显示医师技能
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
header('content-type:text/html;charset=utf-8');
include_once ('../common/config.php');


$id = isset($_POST['id']) ? $_POST['id'] : "";

if($id !== ""){
    mysqli_set_charset($conn, "utf8");
    $sql ="select `jineng` from kq_doctor where `id`= '{$id}'";
    $info = mysqli_query($conn,$sql);
    $data = array();
    while($res = mysqli_fetch_assoc($info)){
        $data = $res;
    };
//     var_dump($data);
    echo json_encode($data);

}