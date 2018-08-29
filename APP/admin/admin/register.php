<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/29
 * Time: 9:50
 * order:医师注册
 */


//    session_start();
    include_once ('../common/config.php');
//    include_once ('../common/response.php');

    if(!$conn){
        echo "mysqli_error()";
    }
    //验证用户名(6-8位数字字母下划线)
    $username = isset ($_POST['username']) ? $_POST['username'] : '';
    if(!preg_match(' /^[a-zA-Z0-9_-]{6,8}$/',$_POST['username'])){
        $code = 3;  $message = "用户名不合法";
        $data = array('code'=>$code,'message'=>$message);
        echo json_encode($code);die();
    }
    //验证密码(6位密码长度)
    $pwd = isset($_POST['password']) ? md5($_POST['password']) : '';
    if(!preg_match('/^[a-zA-Zd_]{6,}$/',$_POST['username'])){
        $code = 2;
        $message = "密码不合法";
        $data = array('code'=>$code,'message'=>$message);
        echo json_encode($code);die();
    }
    $codes = isset($_POST['code']) ? md5($_POST['code']) : '';
    date_default_timezone_set('PRC'); //设置中国时区
    $time = date("Y-m-d H:i:s");
    if($username !== '' &&  $pwd !== '' && $codes !=''){
        mysqli_set_charset($conn, "utf8");
        $querysql = "select `doc_username`,`doc_password` from kq_doctor where `doc_username` = '{$username}' and `doc_password`= '{$pwd}'";
        $res = mysqli_query($conn,$querysql);
        $row = mysqli_fetch_assoc($res);
        if( $row['doc_username']){
            $code = 0;
            $message = "reged！";
            $data = array('code'=>$code,'message'=>$message);
            echo json_encode($data);
            exit();
        }else{
            $sql = "insert into kq_doctor (`doc_username`,`doc_password`,`addtime`) values('$username','$pwd','$time')";
            $res1 = mysqli_query($conn,$sql);
            $row1 = mysqli_affected_rows($conn);
            // echo $row1;
            if($row1>0){
//                $_SESSION['doc_username'] = $row1['doc_username'];
//                $_SESSION['id'] = 1;

                $code = 1;
                $message = "succ！";
                $data = array('code'=>$code,'message'=>$message);
                echo json_encode($data);
            }
        }
    }