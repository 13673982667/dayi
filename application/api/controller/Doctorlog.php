<?php
namespace app\api\controller;
use \think\Loader;

class Doctorlog extends Base {
	public function _initialize() {
		parent::_initialize();
	}
	public function index() {
		return show('1');
	}

	//新增
	public function addOne() {
		$tid = input('tid');
		$data = [
			'name' => input('name'),
			'sex' => input('sex'),
			'shops_name' => input('shops_name'),
			'date_time' => input('date_time'),
			'phone' => input('phone'),
			'describe' => input('describe'),
			'solvent' => input('solvent'),
			'yid' => input('yid'),
			'uid' => input('uid'),
		];

		$DoctorLog = Loader::model('DoctorLog');
		if (count($data) <= 0) {
			return show(2);
		}
		$DoctorTime = Loader::model('DoctorTime');
		//原先有没有  有就修改
		if ($log_id = $DoctorTime->where('id', $tid)->value('log_id')) {
			$DoctorLog->isUpdate(true)->save($data, ['id' => $log_id]);
			return show(1, '', $log_id);
		} else {
			if ($id = $DoctorLog->insertGetId($data)) {
				if ($tid) {
					$DoctorTime->isUpdate(true)->save(['log_id' => $id], ['id' => $tid]);
				}
				return show(1, '', $id);
			}
		}
		return show();
	}
	//一条
	public function getOne() {
		if (!($log_id = input('log_id'))) {
			return show(2);
		}
		$Log = Loader::model('DoctorLog');
		if ($res = $Log->setval('map', ['id' => $log_id])->getOne()) {
			return show(1, '', $res);
		}
		return show();
	}
	//根据预约id获取一条
	public function getyOne() {
		if (!($yyid = input('yyid'))) {
			return show(2);
		}

		if (!$log_id = Loader::model('DoctorTime')->where('id', $yyid)->value('log_id')) {
			return show();
		}
		$Log = Loader::model('DoctorLog');
		if ($res = $Log->setval('map', ['id' => $log_id])->getOne()) {
			return show(1, '', $res);
		}
		return show();
	}

}
