<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/8
 * Time: 9:30
 * order:处理文章添加功能
 */
session_start();
header ( "Content-type: text/html; charset=utf-8" );
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET,POST");
include_once("../common/config.php");
include_once("../common/upload.func.php");
include_once("../common/article.function.php");


if (isset($_SESSION['usernc']) && !empty($_SESSION['usernc'])) {
    $file = $_FILES['file'];  //上传的图片
    $type = array('jpeg', 'jpg', 'png', 'gif'); //文件上传的类型
    $pic =  uploadFile($file,'upload',$type);
    $Name = 'http://www.63218860.com/APP/admin/admin/'.$pic['newName'];
    $title = isset($_POST['title']) ? $_POST['title'] :'';
    $keyword = isset($_POST['keyword']) ? $_POST['keyword'] :'';
    $description = isset($_POST['description']) ? $_POST['description'] :'';
    //删除百度编辑器产生的标签
    $content = isset($_POST['content']) ? strip_tags($_POST['content']) :'';
    date_default_timezone_set('PRC'); //设置中国时区
    $time = date("Y-m-d H:i:s");
    //截取文章的第一段内容
    $cont = article($content);
    if($title && $pic && $description && $content && $cont !==''){
        mysqli_set_charset($conn, "utf8");
        $sql  = "insert into kq_article(`title`,`pic`,`description`,`content`,`addtime`,`keyword`,`cont`) values('$title','$Name','$description','$content',
    '$time','$keyword','$cont')";
        $query = mysqli_query($conn,$sql);
        $echo ="<script>alert('文章发布成功!');window.location.href='../home/Article_list.php'</script>";
        echo $echo;


    }else{
        $echo ="<script>alert('文章发布失败!');window.location.href='../home/add_Article.html'</script>";
        echo $echo;
    }

}else{
    $echo ="<script>alert('您还没有登录,请登录!');window.location.href='./admin/index.html'</script>";
    echo $echo;
}



if(!$conn){
    echo "mysqli_erron()";
}

