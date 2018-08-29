<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/10
 * Time: 10:46
 * order:验证用户登录信息
 */

    session_start();

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods:GET,POST");
    include_once ('../common/config.php');
    include_once ('../common/response.php');

    if(!$conn)
    {
        echo "mysqli_erron()";
    }

    /*验证用户信息*/

    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $pwd   = isset($_POST['password']) ? MD5($_POST['password']) : '';
    if($phone !== '' && $pwd !== '')
    {       mysqli_set_charset($conn, "utf8");
            $login = "select id,phone,password from kq_login where phone = '{$phone}' and password = '{$pwd}'";
            $que  =  mysqli_query($conn,$login);
            $res  =  mysqli_fetch_assoc($que);


            if($res['phone'] == $phone && $res['password'] == $pwd)
            {
                    mysqli_set_charset($conn, "utf8");
                    $user = "select pic,sex,username from kq_userinfo where uid = '{$res['id']}'";
                    $que  =  mysqli_query($conn,$user);
                    $end  =  mysqli_fetch_assoc($que);
                    if($end['phone']  &&  $end['password']) {
                        $data = array(
                            'id' => $end['id'],
                            'uid' => $end['id'],
                            'username' => $end['username'],
                            'pic' => $end['pic'],
                            'sex' => $end['sex'],
                            'phone' => $res['phone']
                        );
                            $info =file_put_contents('userinfo.php',json_encode($data),TRUE); //把数组装换为json 格式存入文件
                    }


                if(file_exists($info)) {
                    $code = 0;
                    $message = " succ";
                    $userinfo = array('code' => $code, 'message' => 'succ', 'phone' => $res['phone'], 'username' => $end['username']);
                    Response::user($code, $message, $userinfo);
                }else{
                    $code = 0;
                    $message  = "filed";
                    $userinfo = array ('');
                    Response::user($code,$message,$userinfo);
                }
            }

            else

            {
                $code = 0;
                $message  = "用户名和密码不正确!";
                $userinfo = array ('');
                Response::user($code,$message,$userinfo);
            }
    }

    else

    {

            echo "用户民或者密码为空";

    }

