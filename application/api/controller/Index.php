<?php
namespace app\api\controller;
use \think\Loader;

class Index extends Base {
	public function _initialize() {
		parent::_initialize();
	}
	public function text() {
		p(strtotime(date('Y-m-d')), 1);
		return show(1, '', Loader::model('Users')
				->field('id,update_time,create_time')
				->find());
		// $date = strtotime('2009-10-21 16:00:10');
		// p($date);
		// p(date('Y-m-d H:i:s', $date));
	}
	//获取首页数据
	public function index() {
		$arr = [];
		//获取症状数据
		$shops = Loader::model('Shops');
		$where = [
			'img' => ['neq', ''],
		];
		if ($res = $shops->setval('map', $where)->getShops()) {
			$arr['Shops'] = $res;
		}

		if ($arr) {
			return show(1, '', $arr);
		}
		return show(0);
	}

	//获取列表
	public function getDoctor() {

		$Shops = Loader::model('Shops');
		$res = $Shops->getShops(); //症状列表
		$data = [];
		if ($res) {
			$data['Shops'] = $res;
		}
		$Users = Loader::model('Users');

		//店铺列表
		if ($res = $Users->getDpList()) {
			$data['DpList'] = $res;
		}

		if (count($data) > 0) {
			return show(1, '', $data);
		}
		return show(0);
	}

}
