<?php 
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3
 * Time: 14:46
 * order: 检测验证码
 */
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods:GET,POST");
	include_once ('../common/response.php');

	$sendCode = isset($_POST['val'])?$_POST['val']:'';

	$codes= file_get_contents('param.php');
	
	if($sendCode == $codes){
		$code = 1;
		$message = 'succ';
		$data = array('');
		response::user($code,$message,$data);
	}else{
		$code = 0;
		$message = 'filed';
		$data = array('');
		response::user($code,$message,$data);

	}
	


