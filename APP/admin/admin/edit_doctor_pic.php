<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/31
 * Time: 11:25
 * order:更换头像
 */

session_start();
header ( "Content-type: text/html; charset=utf-8" );
include_once("../common/config.php");


//判断文件大小
$filesize = filesize($_FILES['file']['tmp_name']);
$maxSize = 2097152;

//组成文件路径是否存在
$uploadPath = 'upload';
if(!file_exists($uploadPath)) {
    mkdir($uploadPath, 0777, true);
    chmod($uploadPath, 0777);
}

// 判断上传文件类型
$type = array("jpg", "gif", "bmp", "jpeg", "png");
$fileext = strtolower($_FILES['file']['name']); //文件名称
$uploadfilename = md5(time() . mt_rand(0,1000));

//组成文件名称
 $picName= $uploadPath.'/'.$uploadfilename.".".$fileext;
 $yu = 'http:/'.'/www.63218860.com/APP/admin/admin/';
if($filesize < $maxSize && $picName){
    //移动文件
    if( move_uploaded_file($_FILES['file']['tmp_name'],$picName ) == TRUE){
        $newName = $yu.$picName;
        //存入数据库
        mysqli_set_charset($conn, "utf8");
        $sql = "update kq_doctor set `pic` = '{$newName}' where `doc_username` = '{$_SESSION['usernc']}'";
        $query = mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn)>0) {
            echo json_encode($newName);
        }else{
            echo json_encode('error');
        }
    }
}
