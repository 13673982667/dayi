<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/12/8
 * Time: 11:07
 * order:清除缓存
 */

$userinfo = './tmp.php';
$param = './param.php';
if (file_exists($userinfo )) {
    if(unlink($userinfo) == TRUE){
        echo "缓存清除成功";
    }else{
        echo "filed";
    };

}else{
    if(unlink($userinfo) == TRUE){
        echo "缓存清除成功";
    }else{
        echo "filed";
    };
}


?>


