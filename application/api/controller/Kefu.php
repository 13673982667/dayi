<?php
namespace app\api\controller;
use \think\Loader;

/**
 * 客服  医师  店铺
 */
class Kefu extends Base {
	public function _initialize() {
		parent::_initialize();
	}

	//获取这个客服下的所有用户  暂时先把数据库所有用户拿来  以后改
	public function updateUserArr() {
		if (!($kf_id = input('kf_id'))) {
			return show(2);
		}
		$Users = Loader::model('Users');
		$res = $Users->updateUserArr($kf_id);
		if ($res) {
			$arr = [];
			foreach ($res as $k => $v) {
				$arr[$v['im_identifier']] = $v;
			}

			return show(1, '', $arr);
		}
		return show();
	}

}
