<?php
namespace app\api\controller;
use \think\Loader;

/**
 *店铺
 */
class Dp extends Base {
	public function _initialize() {
		parent::_initialize();
	}

	//获取店铺列表
	public function getDpList() {
		$Users = Loader::model('Users');
		$where = [
			'status' => 1,
		];
		if ($res = $Users->setval('map', $where)->getDpList()) {
			return show(1, '', $res);
		}
		return show();
	}
	//获取店铺下的医师列表  状态正常的
	public function getYsList() {
		if (!($id = input('uId'))) {
			return show(2);
		}
		$Users = Loader::model('Users');
		$where = [
			'parent_id' => $id,
			'status' => 1,
		];
		if ($res = $Users->setval('map', $where)->getDoctorList()) {
			return show(1, '', $res);
		}

		return show();
	}
	//获取店铺下的医师列表  被禁用和正在申请的
	public function getYsListOut() {
		if (!($id = input('uId'))) {
			return show(2);
		}
		$Users = Loader::model('Users');
		$where = [
			'parent_id' => $id,
			'status' => ['neq', 1],
		];
		if ($res = $Users->setval('map', $where)->getDoctorList()) {
			return show(1, '', $res);
		}

		return show();
	}

}
