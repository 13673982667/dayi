<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/8
 * Time: 10:56
 * order: 删除项目分类(数据库分类少于6条禁止删除)
 */
    include_once("../common/config.php");
    $id = isset($_GET['id']) ? $_GET['id'] : "";
if($id !== ""){
    mysqli_set_charset($conn, "utf8");
    $search = "select * from kq_products ";
    $query = mysqli_query($conn,$search);
    $count = mysqli_num_rows($query);

    if($count <= 6){
        $echo ="<script>alert('项目分类禁止删除');window.location.href='../home/Products.php';</script>";
        echo $echo;
    }else{
        $delete = "delete from kq_products where id = '{$id}'" ;
        mysqli_query($conn,$delete);
        $echo ="<script>alert('项目分类删除成功');window.location.href='../home/Products.php';</script>";
        echo $echo;
    }

}