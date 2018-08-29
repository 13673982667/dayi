<?php
namespace app\api\controller;

use \think\Loader;

class Version extends Base {
	public function _initialize() {

		parent::_initialize();
	}

	//获取静默更新版本 和下载地址
	public function getVersion() {
		$Version = Loader::model('Version');
		$res = $Version->order('id desc')->find();
		if ($res) {
			return show(1, '', $res);
		}
		return show();
	}
}
