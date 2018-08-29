<?php
namespace app\api\controller;
use \think\Loader;

class Doctor extends Base {
	public function _initialize() {
		parent::_initialize();
	}
	public function index() {
		return show('1');
	}

	/**
	 * 获取医师列表
	 * @return [type] [description]
	 */
	public function getList() {
		// $Doctor = Loader::model('Doctor');
		// $res = $Doctor->getList();
		// if ($res) {
		// 	return show(1, '', $res);
		// }
		// return show(0);

		if (!($parent_id = input('dpId'))) {
			return show(2);
		}
		$Users = Loader::model('Users');
		$where = [
			'type' => 2,
			'parent_id' => $parent_id,
			'status' => 1,
		];
		$res = $Users->setval('map', $where)->getDoctorList();
		if ($res) {
			return show(1, '', $res);
		}
		return show();
	}

	/**
	 * 获取医师信息
	 * @return [type] [description]
	 */
	public function getYsInfo() {
		if (!($yId = input('yId')) || !($time = input('Time'))) {
			return show(0, '参数错误');
		}

		$Users = Loader::model('Users');
		$DoctorTime = Loader::model('DoctorTime');
		$where = [
			'id' => $yId,
		];
		$res = $Users->setval('map', $where)->getYsInfo($yId);
		//获取每个医师同个时间段的预约人数
		if ($res) {
			$r = $DoctorTime->checkYsTime($res['id'], $time);
			// return show(1, '', $r);

			$res['info'] = timetypeInfo($r);
			return show(1, '', $res);
		}
		return show(0);
	}

}
