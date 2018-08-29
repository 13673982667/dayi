<?php
namespace app\api\controller;
use \think\Controller;
use \think\Loader;

class Im extends ImBase {

	public function _initialize() {
		parent::_initialize();
	}

	public function index() {

	}

	public function test() {
		//注册
		$res = $this->api->register_account('asdadasd', 3, 'im_123456');
		p($res);
	}
	//
	public function test1() {
		$res = $this->api->account_import('asdadasd', 'woshini', '');
		p($res);
	}

	//设置昵称 头像
	public function setNickName() {
		$profile_list = [];
		$account_id = 'im_13673982667';
		$headurl = [
			"Tag" => "Tag_Profile_IM_Image",
			"Value" => "https://static001.geekbang.org/resource/image/14/90/14a627175f4a0b5eeb5d484f87fe6490.jpg",
		];
		$nickname = [
			"Tag" => "Tag_Profile_IM_Nick",
			"Value" => "cuixudong",
		];
		array_push($profile_list, $headurl);
		$res = $this->api->profile_portrait_set2($account_id, $profile_list);
		p($res);
	}

	//注册im用户
	public function registerUser($identifier, $type = 3, $pwd = 'im_123456') {
		$res = $this->api->register_account($identifier, $type, $pwd);
		$arr = [];
		if ($res['ErrorCode'] == 0) {
			$arr['identifier'] = $identifier;
			$arr['pwd'] = $pwd;
		} else if ($res['ErrorCode'] == 70402) {
			//已经注册
			$arr['identifier'] = $identifier;
			$arr['pwd'] = $pwd;
		}
		if ($arr['identifier'] && $arr['pwd']) {
			return $arr;
		}
		return false;
	}

	/**
	 * 获取用户登陆信息
	 * @return [type] [description]
	 */
	public function userLoginInfo() {
		if (!$uid = input('uid')) {
			return show(2);
		}
		$Users = Loader::model('Users');
		$where = [
			'id' => $uid,
		];
		$res = $Users
			->field('id,nickname,im_identifier,im_pwd,pic,phone')
			->where(['id' => $uid])
			->find();
		if ($res) {
			//没有im的账号密码的话注册
			if ($res['im_identifier'] != '' && $res['im_pwd'] != '') {
				//有
				$res['Sig'] = $this->getSig($res['im_identifier']);
				return show(1, '', $res);
			} else {
				$im_identifier = 'im_' . $res['phone']; //账号
				//注册
				if ($imarr = $this->registerUser($im_identifier)) {
					//注册成功
					$data = [];
					$res['im_identifier'] = $data['im_identifier'] = $imarr['identifier'];
					$res['im_pwd'] = $data['im_pwd'] = $imarr['pwd'];
					//加入数据库
					$Users->isUpdate(true)->save($data, ['id' => $uid]);
					//生成sig
					$res['Sig'] = $this->getSig($res['im_identifier']);
					return show(1, '', $res);
				}
			}
		}
		return show();
	}

	//添加一个好友 返回好友的Identifier数组
	public function addIdentifier() {
		if (!($identifier = input('identifier')) || !($Toidentifier = input('Toidentifier'))) {
			return show(2);
		}
		$res = $this->api->sns_friend_import($identifier, $Toidentifier);
		if ($res['ErrorCode'] == 0) {
			return show(1, '', $res['ResultItem'][0]);
		}
		return show(0);
	}

	//获取一个客服Identifier
	public function getKfIdentifier() {
		$data = Loader::model('Users')->where('id', 14)->find();
		return show(1, '', $data);
	}

}
