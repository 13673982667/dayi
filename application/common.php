<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use \think\Config;
// 应用公共文件
/**
 * 模拟tab产生空格
 * @param int $step
 * @param string $string
 * @param int $size
 * @return string
 */
function tab($step = 1, $string = ' ', $size = 4) {
	
	return str_repeat($string, $size * $step);
}
/**
 * 通用化API接口数据输出
 * @param int $code 业务状态码
 * @param string $message 信息提示
 * @param [] $data  数据
 * @param int $httpCode http状态码
 * @return array
 */
function show($code = 0, $message = '', $data = [], $httpCode = 200) {
	if ($message == '') {
		if ($code == 1) {
			$message = 'ok';
		} else if ($code == 0) {
			$message = 'error!';
		} else if ($code == 2) {
			$message = '参数错误!';
		}
	}

	$data = [
		'code' => $code,
		'message' => $message,
		'data' => $data,
	];

	return json($data, $httpCode);
}
/**
 * 打印数据
 * @param  [type] $var    [description]
 * @param  int  是否结束
 */
function p($var, $is_die = 0) {
	if (is_array($var)) {
		echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#f5f5f5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>" . print_r($var, true) . "</pre>";
	} else {
		var_dump($var);
	}
	if ($is_die == 1) {
		exit;
	}
}

/**
 * 把timetype转换成字符串  没有的补上
 * @param  array  $data [description]
 * @return [type]       [description]
 */
function timetypeInfo($data = []) {
	$arr = Config::get('appconf.timetype');

	$res = [];
	foreach ($arr as $key => $value) {
		$res[$key] = [];
		//先给默认值
		$res[$key]['type'] = $key;
		$res[$key]['info'] = $value['str'];
		$res[$key]['count'] = '0人已约';
		foreach ($data as $k => $v) {
			if ($v['timetype'] == $key) {
				if (isset($res[$key]['count']) && $res[$key]['count'] >= 3) {
					$res[$key]['count'] = '约满';
				} else {
					$res[$key]['count'] = $v['count'] . '人已约';
				}
			}
		}
	}
	return $res;
}
/**
 * 将base64转图片并保存
 * @param $base64_image_content string base64编码
 * @param $url
 */
function uploadbase64($base64_image_content, $url = '') {
	//匹配出图片的格式
	if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {

		$type = $result[2];
		$new_file = './public/uploads/images/' . date('Ymd', time());
		$new_file = empty($url) ? $new_file : $url;
		$filepath = '';
		$pathArr = explode('/', $new_file);
		foreach ($pathArr as $k => $v) {
			$filepath .= $v . '/';
			if (!is_dir($filepath)) {
				mkdir($filepath);
			}
		}
		$name = time();
		$new_file = $filepath . $name . ".{$type}";
		if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))) {
			return $new_file;
		} else {
			return false;
		}
	}
}
//删除链接对应的文件
function deleteUrl($url) {
	//将http://192.168.0.110/  这样的给提取出来
	preg_match('/http[s]?:\/\/[^\/]+\/(.*)/i', $url, $arr);
	if (count($arr) > 1) {
		if (file_exists($arr[1])) {
			@unlink($arr[1]);
		}
	}

}
/**
 * 获取timetype对应的值
 */
function gettimetype_arr($id) {
	$arr = Config::get('appconf.timetype');
	return $arr[$id];
}
/**
 * 用户类型
 */
function getUserType($type) {
	$arr = [
		'0' => '患者',
		'1' => '客服',
		'2' => '医师',
		'3' => '店铺',
	];
	if (isset($arr[$type])) {
		return $arr[$type];
	}
	return '';
}
/**
 * 性别
 */
function getUserSex($sex) {
	$arr = [
		'0' => '男',
		'1' => '女',
	];
	if (isset($arr[$sex])) {
		return $arr[$sex];
	}
	return '';
}