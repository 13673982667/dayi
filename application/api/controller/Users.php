<?php
namespace app\api\controller;
use \think\Cache;
use \think\Config;
use \think\Loader;

class Users extends Base {
	public function _initialize() {
		// deleteUrl('http://192.168.0.110/./public/uploads/images/20180726//1532586342.png');
		// http://www.63218860.com/APP/home/MyFiles/20171130022127.jpeg
		// deleteUrl('http://192.168.0.110/./public/uploads/images/20180726/1532589390.png');
		parent::_initialize();
	}

	/**
	 * 获取用户信息
	 * @return [type] [description]
	 */
	public function getUserInfo() {
		if (!$uId = input('uId')) {
			return show(0);
		}

		$Users = Loader::model('Users');
		$res = $Users->setval('map', ['id' => $uId])->getUserInfo();
		if ($res) {
			return show(1, '', $res);
		}
		return show(0);
	}
	//修改用户信息
	public function updateUserInfo() {
		if (!($uId = input('uId'))) {
			return show(2);
		}
		$post = input('post.');
		$Users = Loader::model('Users');

		if (isset($post['image']) && !empty($post['image'])) {
			file_put_contents('asd.php', json_encode($post));
			if ($pic = $Users->where(['id' => $uId])->value('pic')) {
				deleteUrl($pic);
			}
			$post['pic'] = Config::get('apiconfig.this_host') . uploadbase64($post['image']);
		}

		if ($Users->UpdateUserInfo($post, ['id' => $uId])) {

			return show(1);
		}
		return show();
	}
	//修改密码
	public function updateUserPwd() {
		if (!($uId = input('uId')) || !($pwd = input('pwd')) || !($ypwd = input('ypwd'))) {
			return show(2);
		}
		$pwd = md5($pwd);
		$ypwd = md5($ypwd);
		$Users = Loader::model('Users');
		$where = [
			'id' => $uId,
			'password' => $ypwd,
		];
		if ($Users->where($where)->find()) {
			if ($Users->isUpdate(true)->save(['password' => $pwd], ['id' => $uId])) {
				return show(1);
			}
			return show(0);
		}
		return show(0, '原始密码错误');
	}

	public function login() {
		if (!($password = input('password')) || !($phone = input('phone'))) {
			return show(0);
		}
		$password = md5($password);
		$Users = Loader::model('Users');
		$where = [
			'password' => $password,
			'phone' => $phone,
		];
		if ($res = $Users->where($where)->find()) {
			// if ($res['type'] !== 0 && $res['status'] !== 1) {
			// 	return show(0, '请等待账号审核');
			// }
			return show(1, '', $res['id']);
		}
		return show(0, '账号或密码错误！');
	}
	public function register() {
		if (!($code = input('code')) || !($phone = input('phone'))) {
			return show(0);
		}
		$type = input('uType');

		if ($param = Cache::get('send_' . $phone)) {
			if ($code != $param) {
				return show(0, '验证码错误', $param);
			}
		} else {
			return show(0, '验证码已过期');
		}
		$data = [
			'phone' => $phone,
			'password' => md5(input('password')),
			'nickname' => input('phone'),
			'type' => $type,
			'status' => ($type == 0 ? '1' : '0'),
			'pic' => 'http://www.63218860.com/APP/home/MyFiles/20171130022127.jpeg',
		];
		$Users = Loader::model('Users');
		if ($res = $Users->where('phone', $data['phone'])->find()) {
			return show(2, '', '手机号被注册');
		}
		if ($user_id = $Users->insertGetId($data)) {
			return show(1, '', $user_id);
		}
		return show(0);
	}
	// public function send() {
	// 	$phone = $_GET['phone'];
	// 	$rands = rand(1000, 9999);
	// 	$content = '您的注册验证码为：' . $rands . '。验证码有效期为5分钟，请尽快填写！';
	// 	//  $url ="http://106.ihuyi.com/webservice/sms.php?method=Submit&account=cf_huke&password=wyx037798&mobile=".$phone."&content=".$content;
	// 	$url = "http://106.ihuyi.com/webservice/sms.php?method=Submit&account=cf_huke&password=wyx037798&mobile$phone&content=$content";

	// 	// $url = "";
	// 	$data = file_get_contents($url);
	// 	$xml = simplexml_load_string($data);
	// 	$arr = array('code' => 0, 'rand' => $rands, 'phone' => $phone);
	// 	echo json_encode($arr);exit;
	// }

	public function send() {
		if (!$phone = input('phone')) {
			return show(0);
		}
		// if ($a = Cache::get('send_' . $phone)) {
		// 	p($a, 1);
		// }
		//有没有注册过
		$Users = Loader::model('Users');
		if ($Users->where('phone', $phone)->find()) {
			return show(2, '该手机已经注册过');
		}
		//导入第三方类库 Ucpaas.class.php
		include_once "./extend/Ucpaas.php";
		//初始化必填
		$options['accountsid'] = 'da776c1deccc22c682efce0cdf088ca2';
		$options['token'] = 'ad86c5251867b87a40f9602176c2b854';
		//实例化Ucpaas
		$Ucpaas = new \Ucpaas($options);
		//接入产品
		//短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
		$appId = "e8501ac72bd0469cb5f0f3cc06030e06";
		//对象终端
		$to = $phone; //应该是获取到的手机号码
		//短信模板id
		$templateId = "70786";
		//参数 (验证码)
		$param = rand(10000, 50000);
		//原样格式
		$data = $Ucpaas->templateSMS($appId, $to, $templateId, $param);
		$data = json_decode($data, true);
		if ($data['resp']['respCode'] == '000000') {
			//成功 存缓存
			Cache::set('send_' . $phone, $param, 60);
			return show(1, '', $param);
		}
		return show(0);
	}

}
