<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/8
 * Time: 10:56
 * order: 文章修改功能
 */
session_start();
header ( "Content-type: text/html; charset=utf-8" );
include_once("../common/config.php");
include_once("../common/upload.func.php");

$file = $_FILES['file'];  //上传的图片
$type = array('jpeg', 'jpg', 'png', 'gif'); //文件上传的类型
$pic =  uploadFile($file,'upload',$type);
$Name = 'admin/'.$pic['newName'];

$id = isset($_POST['id']) ? $_POST['id'] :'';
$title = isset($_POST['title']) ? $_POST['title'] :'';
$description = isset($_POST['description']) ? $_POST['description'] :'';
$content = isset($_POST['content']) ? $_POST['content'] :'';
date_default_timezone_set('PRC'); //设置中国时区
$time = date("Y-m-d H:i:s");

if($title && $pic && $description && $content !== ''){
    mysqli_set_charset($conn, "utf8");
    $sql  = "update  kq_article set title = '{$title}',pic = '{$Name}',description = '{$description}',content = '{$content}',addtime = '{$time}' where id = '{$id}'";

    $query = mysqli_query($conn,$sql);
    $rows = mysqli_affected_rows($conn);
    if($rows>0){
        $echo ="<script>alert('文章修改成功!');";
        $echo .="window.location.href='../home/Article_list.php';";
        $echo .="</script>";
        echo $echo;
    }else{
        $echo ="<script>alert('文章禁止修改!');";
        $echo .="window.location.href='../home/Article_list.php';";
        $echo .="</script>";
        echo $echo;
    }



}else{
    $echo ="<script>alert('文章修改失败，请完整填写!');";
    $echo .="window.location.href='../home/add_Article.html';";
    $echo .="</script>";
    echo $echo;
}