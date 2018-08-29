<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/29
 * Time: 20:38
 * order:补充医师信息
 */
session_start();
header ( "Content-type: text/html; charset=utf-8" );
include_once("../common/config.php");

    $ID = isset($_POST['ID']) ? $_POST['ID'] :"";
    $doc_username = isset($_POST['doc']) ? $_POST['doc'] :"";
    $truename = isset($_POST['truename']) ? $_POST['truename'] : "";
    $sex = isset($_POST['sex']) ? $_POST['sex'] : "";
    $iphone = isset($_POST['iphone']) ? $_POST['iphone'] : "";
    $QQ = isset($_POST['QQ']) ? $_POST['QQ'] : "";
    $Email = isset($_POST['Email']) ? $_POST['Email'] : "";
    $wechat = isset($_POST['wechat']) ? $_POST['wechat'] : "";
    $jineng = isset($_POST['jin']) ? $_POST['jin'] : "";
    if($doc_username == $_SESSION['usernc']){
        if($ID || $truename || $sex || $iphone || $jineng !== null){
            mysqli_set_charset($conn, "utf8");
            $sql = "update kq_doctor  set `doc_username` ='{$doc_username}',`truename`='{$truename}',`sex`='{$sex}',`jineng`='{$jineng}',`iphone`='{$iphone}',`QQ`='{$QQ}',`Email`='{$Email}',`wechat`='{$Email}' where id = '{$ID}'";
            $query = mysqli_query($conn,$sql);
                if(mysqli_affected_rows($conn)>0){
                    $_SESSION['usernc'] = $doc_username;
                    $code = 0;
                    $message = "succ";
                    $data =array('code'=>$code,'message'=>$message);
                    echo json_encode($data);
                }else{
                    $code = 1;
                    $message = "failed";
                    $data =array('code'=>$code,'message'=>$message);
                    echo json_encode($data);
                }
        }else{
            $code = 2;
            $message = "error";
            $data =array('code'=>$code,'message'=>$message);
            echo json_encode($data);

        }

    }else{
        $code = 3;
        $message="登录失败";
        $data =array('code'=>$code,'message'=>$message);
        echo json_encode($data);
    }


