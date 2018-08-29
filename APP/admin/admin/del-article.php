<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/8
 * Time: 10:56
 * order: 删除文章(数据库文章少于五条禁止删除)
 */
    include_once("../common/config.php");
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
if($id !== ""  && $keyword !== ""){
    mysqli_set_charset($conn, "utf8");
    $search = "select id from kq_article  where keyword = '{$keyword}'";
    $query = mysqli_query($conn,$search);
    $count = mysqli_num_rows($query);

    if($count <= 5){
        $echo ="<script>alert('文章禁止删除');window.location.href='../home/Article_list.php';</script>";
        echo $echo;
    }else{
        $delete = "delete from kq_article where id = '{$id}'" ;
        mysqli_query($conn,$delete);
        $echo ="<script>alert('文章删除成功');window.location.href='../home/Article_list.php';</script>";
        echo $echo;
    }

}