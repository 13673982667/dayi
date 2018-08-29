<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/12/19
 * Time: 14:40
 */
    header('content-type:text/html;charset=utf-8');
    //验证数据库连接
    include_once ('conn.php');
    if(!$conn){
        echo "error";
    }
    //接收数据
    $decsrption = isset($_POST['decsrption']) ? $_POST['decsrption'] : '';

    $title = isset($_POST['title']) ? $_POST['title'] : '';

    $content=isset($_POST['content']) ? $_POST['content'] : '' ;
    //正则匹配数据是否合法
    if($decsrption !== '' && $title !=='' && $decsrption !== ''){
        mysqli_set_charset($conn,'utf8');
        $sql = "insert into  article (`title`,`decsrption`,`content`)values('{$title}','{$decsrption}','{$content}')";
        $query = mysqli_query($conn,$sql);
        $res = mysqli_affected_rows($conn);
        if($res>0){
            echo "succ";
        }else{
            echo "field";
        }
    }




