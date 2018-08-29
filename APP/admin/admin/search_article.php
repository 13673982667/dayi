<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/8
 * Time: 10:56
 * order: 检索文章
 */
    include_once("../common/config.php");
    $title = isset($_POST['title']) ? $_POST['title'] : "";
if($title != ''){
    mysqli_set_charset($conn, "utf8");
    $search = "select  * from kq_article  where title LIKE '%{$title}%'" ;
    $query =  mysqli_query($conn,$search);
    $cont = array();
     while($res = mysqli_fetch_assoc($query)){
        $cont[] = $res;
     };

    if($cont !== null){

        echo json_encode($cont);
        
    }else{

        $code = 0;
        $message = "文章不存在";
        $data = array('code'=>$code,'message'=>$message);
        echo json_encode($data);
       
    }
}