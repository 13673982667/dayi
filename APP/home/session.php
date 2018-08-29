<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2018/1/10
 * Time: 11:34
 * order: test
 */
    session_start();
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods:GET,POST");
    include_once ('../common/response.php');
//    if($_SESSION['username'] = $A;
    if($_SESSION['username'] != null)
         {
                if($_SESSION['username'] == "8433客官")

           {
               echo json_encode($_SESSION['username']);
//               $code = 0;
//               $message  = "filed";
//               $userinfo = array ('');
//               Response::user($code,$message,$userinfo);       //Your Code Here

             }
     }else{

         echo json_encode($_SESSION['username']);

    }
