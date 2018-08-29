<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path'), EXT);

use app\admin\Controller;

class Users extends Controller {
	use \app\admin\traits\controller\Controller;
	// 方法黑名单
	protected static $blacklist = [];

	protected function filter(&$map) {

	}

	//医师列表
	public function DoctorList() {
		$this->maparr = [
			'type' => 2,
		];
		$this->view_html = 'users/doctor/index';

		return $this->index();
	}
	//客服列表
	public function KfList() {
		$this->maparr = [
			'type' => 1,
		];
		$this->view_html = 'users/doctor/index';

		return $this->index();
	}
	//店铺列表
	public function DpList() {
		$this->maparr = [
			'type' => 3,
		];
		$this->view_html = 'users/dp_list/index';

		return $this->index();
	}

	// //店铺医师列表
	// public function DpDoctorList() {
	// 	// $this->maparr = [
	// 	// 	'parent_id' => input('id'),
	// 	// 	'type' => 2,
	// 	// ];
	// 	$this->view_html = 'users/doctor/index';

	// 	return $this->index();
	// }

}
