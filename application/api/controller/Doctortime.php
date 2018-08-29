<?php
namespace app\api\controller;
use \think\Config;
use \think\Loader;

class Doctortime extends Base {
	public function _initialize() {
		parent::_initialize();
	}
	public function index() {
		return show('1');
	}
	// //进行预约
	// public function setDoctorTime() {
	// 	if (!($uid = input('uid')) || !($yid = input('yid')) || !($timetype = input('timetype')) || !($date_time = input('date_time'))) {
	// 		return show(0, '参数错误');
	// 	}
	// 	$did = input('dId'); //症状
	// 	$isUpdate = input('isUpdate'); //修改标记

	// 	$Users = Loader::model('Users');
	// 	if ($Users->getType($uid) !== 0) {
	// 		return show(0, '您不是患者，不能预约！');
	// 	}

	// 	$DoctorTime = Loader::model('DoctorTime');
	// 	//获取是不是当天的  如果是超没超过预约时间
	// 	if ($date_time <= date('Y-m-d')) {
	// 		if ($date_time < date('Y-m-d')) {
	// 			return show(0, '超过预约时间');
	// 		}
	// 		//超没超过今天的预约时间
	// 		$timetype_arr = $arr = Config::get('appconf.timetype');
	// 		if ($timetype_arr[$timetype]['val'] <= (date('H') + Config::get('appconf.check_time'))) {
	// 			return show(0, '请最少提前' . Config::get('appconf.check_time') . '小时预约或修改');
	// 		}
	// 	}
	// 	//获取这天这个时间段的预约人数
	// 	$count = $DoctorTime->checkYsTimeOne();
	// 	if (!is_bool($count) && $count >= 4) {
	// 		return show(2, '预约人数已满', []);
	// 	}
	// 	$data = [
	// 		'uid' => $uid,
	// 		'yid' => $yid,
	// 		'timetype' => $timetype,
	// 		'date_time' => $date_time,
	// 		'did' => $did,
	// 		'hour' => gettimetype_arr($timetype)['val'],
	// 	];
	// 	if (!empty($isUpdate) && $isUpdate > 0) {
	// 		//修改
	// 		$DoctorTime->isUpdate(true)->save($data, ['id' => $isUpdate]);
	// 		return show(1, '修改成功');

	// 	} else {
	// 		$where = [
	// 			'uid' => $uid,
	// 			'date_time' => ['>=', date('Y-m-d')],
	// 			'status' => 0,
	// 		];
	// 		//有没有过预约
	// 		if ($res = $DoctorTime->where($where)->find()) {
	// 			//不等于今天的  或者今天的 还没超过预约时间
	// 			if ($res['date_time'] != date('Y-m-d') || gettimetype_arr($res['timetype'])['val'] >= date('H')) {
	// 				return show(0, '您已经预约过了');
	// 			}
	// 		}
	// 		//预约
	// 		if ($DoctorTime->isUpdate(false)->save($data)) {
	// 			return show(1, '预约成功');
	// 		}
	// 	}
	// 	return show(0);
	// }
	// //进行预约
	public function setDoctorTime() {
		if (!($uid = input('uid')) || !($yid = input('yid')) || !($timetype = input('timetype')) || !($date_time = input('date_time'))) {
			return show(0, '参数错误');
		}
		$did = input('dId'); //症状
		$isUpdate = input('isUpdate'); //修改标记
		$Users = Loader::model('Users');
		if ($Users->getType($uid) !== 0) {
			return show(0, '您不是患者，不能预约！');
		}
		$DoctorTime = Loader::model('DoctorTime');
		//计算预约时间
		$timetype_arr = gettimetype_arr($timetype);
		$date_time = strtotime($date_time . ' ' . $timetype_arr['time']);
		//超没超过预约时间 预约的时间要大于当前时间+两个小时
		if ($date_time <= time() + Config::get('appconf.check_time')) {
			return show(0, '请最少提前' . (Config::get('appconf.check_time') / (60 * 60)) . '小时预约或修改');
		}
		//获取这天这个时间段的预约人数
		$count = $DoctorTime->checkYsTimeOne();
		if (!is_bool($count) && $count >= 4) {
			return show(2, '预约人数已满', []);
		}
		$data = [
			'uid' => $uid,
			'yid' => $yid,
			'timetype' => $timetype,
			'date_time' => $date_time,
			'did' => $did,
			'hour' => gettimetype_arr($timetype)['val'],
		];
		if (!empty($isUpdate) && $isUpdate > 0) {
			//修改
			$DoctorTime->isUpdate(true)->save($data, ['id' => $isUpdate]);
			return show(1, '修改成功');

		} else {
			$where = [
				'uid' => $uid,
				'date_time' => ['>=', time()],
				'status' => 0,
			];
			//有没有过预约 状态是正在预约的 并且还没有超时的
			if ($res = $DoctorTime->where($where)->find()) {
				return show(0, '您已经有预约了');
			}
			//预约
			if ($DoctorTime->isUpdate(false)->save($data)) {
				if ($phone = Loader::model('Users')->where('id', $uid)->value('phone')) {
					$microSeconds = $date_time - time() - 60 * 60; //预约的时间减去当前的时间  再提前一小时
					//添加定时任务  提前多长时间发送短信通知
					$url = 'http://122.114.105.173:9501?phone=' . $phone . '&microSeconds=' . $microSeconds;
					file_get_contents($url);
				}

				return show(1, '预约成功');
			}
		}
		return show(0);

	}

	//我的预约列表 正在预约的
	public function getDoctorTimeList() {
		if (!$uid = input('uId')) {
			return show(0);
		}
		$DoctorTime = Loader::model('DoctorTime');
		$where = [
			't.uid' => $uid,
			't.status' => 0,
			't.date_time' => ['>=', time()],
		];
		$res = $DoctorTime->setval('map', $where)->getUserTimeList();
		if ($res) {
			return show(1, '', $res);
		}
		return show(0);
	}
	//我的预约列表 历史所有的
	public function getDoctorTimeListBefore() {
		if (!$uid = input('uId')) {
			return show(0);
		}
		$DoctorTime = Loader::model('DoctorTime');
		$where = [
			't.uid' => $uid,
			// 't.date_time' => ['>=', date('Y-m-d')],
		];
		$res = $DoctorTime->setval('map', $where)->getUserTimeList();
		if ($res) {
			return show(1, '', $res);
		}
		return show(0);
	}
	//获取医师下的所有预约列表
	public function getYsDoctorList() {
		if (!($yId = input('uId'))) {
			return show(2);
		}
		$DoctorTime = Loader::model('DoctorTime');
		$res = $DoctorTime->getYsDoctorList($yId);
		if ($res) {
			//判断是否超时
			foreach ($res as $k => $v) {
				if ($v['date_time'] < date('Y-m-d')) {
					//超时
					$res[$k]['check_time'] = 1;
				} elseif ($v['date_time'] == date('Y-m-d')) {
					//今天的
					if ($v['hour'] < date('H')) {
						//今天的超时
						$res[$k]['check_time'] = 1;
					} else {
						//今天的还没超时
						$res[$k]['check_time'] = 0;
					}
				} else {
					//没超时
					$res[$k]['check_time'] = 0;
				}
			}
			return show(1, '', $res);
		}
		return show();
	}
	//获取医师的已完成预约
	public function getYsOkList() {
		if (!($yId = input('uId'))) {
			return show(2);
		}
		$DoctorTime = Loader::model('DoctorTime');
		$where = [
			't.status' => 2,
		];
		$res = $DoctorTime->setval('map', $where)->getYsDoctorList($yId);
		if ($res) {
			return show(1, '', $res);
		}
		return show();
	}
	//删除一条数据
	public function deleteOne() {
		if (!$id = input('id')) {
			return show(0);
		}
		$DoctorTime = Loader::model('DoctorTime');

		$where = [
			'id' => $id,
			'date_time' => ['>=', date('Y-m-d')],
		];
		if ($res = $DoctorTime->where($where)->find()) {
			if (($res['date_time'] == date('Y-m-d')) && (gettimetype_arr($res['timetype'])['val'] <= (date('H') + Config::get('appconf.check_time')))) {
				return show(0, Config::get('appconf.check_time') . '小时以内不能取消');
			}
		}
		if ($DoctorTime->where($where)->delete()) {
			return show(1);
		}
		return show(0);
	}
	//获取一条数据
	public function getOneInfo() {
		if (!$id = input('id')) {
			return show(0);
		}
		$DoctorTime = Loader::model('DoctorTime');
		$res = $DoctorTime->setval('map', ['t.id' => $id])->getOneInfo();
		if ($res) {
			$res['date_time'] = date('Y-m-d', $res['date_time']);
			$res['yInfo'] = $DoctorTime->checkYsTime($res['yid'], $res['date_time']);
			$res['yInfo'] = timetypeInfo($res['yInfo']);
			return show(1, '', $res);
		}
		return show(0);
	}
	//修改预约状态
	public function updateStatus() {
		if (!($status = input('status')) || !($id = input('id'))) {
			return show(2);
		}
		$StatusArr = Config::get('appconf.DoctorTimeStatus');
		if (!isset($StatusArr[$status])) {
			return show(2);
		}
		$DoctorTime = Loader::model('DoctorTime');
		$data = [
			'status' => $status,
		];
		if ($DoctorTime->isUpdate(true)->save($data, ['id' => $id])) {
			return show(1);
		}
		return show(0);
	}

	//获取添加病例的信息
	public function getbinglibefore() {
		$tid = input('tid'); //预约id
		$DoctorTime = Loader::model('DoctorTime');
		$tres = $DoctorTime->setval('map', ['t.id' => $tid])->getOneInfo();
		$data = [
			'tres' => $tres, //预约信息  如果有就显示 没有就是空
			'shops' => Loader::model('Shops')->getShops(), //症状列表
		];
		return show(1, '', ($data));
	}

}
