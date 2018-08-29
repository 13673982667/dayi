<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6
 * Time: 10:35
 * order:个人资料详情页面(存储)
 */

        session_start();

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods:GET,POST");
		include_once ('../common/response.php');
		include_once ('./userinfo.php');
		$B= json_encode(file_get_contents('userinfo.php'),TRUE);
