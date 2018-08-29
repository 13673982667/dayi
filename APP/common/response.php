<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/1
 * Time: 13:16
 */
	//接口封装类
	class Response
	{
		public static function user($code, $message = '', $data = array())
		{
			//对状态码进行判断
			if(!is_numeric($code))
			{
				echo "error";exit;
			}
			//三个数据组装成一个数组
			$result = array('code' => $code,'message' => $message,'data' => $data);
			//输出json 格式的数据
			echo json_encode($result);
		}

	}