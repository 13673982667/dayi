<?php
namespace app\api\controller;

use \think\Loader;

class Appconfig extends Base {
	public function _initialize() {

		parent::_initialize();
	}

	//获取静默更新版本 和下载地址
	public function getVersion() {
		$AppConfig = Loader::model('AppConfig');
		$data = [];
		if ($res = $AppConfig->where('config_name', 'appUpdateUrl')->value('config_canshu')) {
			$data['url'] = $res;
		}
		if ($res = $AppConfig->where('config_name', 'version')->value('config_canshu')) {
			$data['version'] = $res;
		}
		if (count($data) > 0) {
			return show(1, '', $data);
		}
		return show();
	}
}
