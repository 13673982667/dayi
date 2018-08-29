<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/27
 * Time: 下午5:57
 */
namespace app\common\model;
use think\Model;
use \think\Config;

class DoctorTime extends Base {

	// 开启自动写入时间戳字段
	protected $autoWriteTimestamp = false;

	/**
	 * 获取这个医师这天预约人数 所有时间段
	 * @return [type] [description]
	 */
	public function checkYsTime($yId, $time) {
		$time = strtotime($time) ? strtotime($time) : $time;
		$between = $time . ' AND ' . ($time + (60 * 60 * 24));
		// $res = $this
		// 	->where($this->map)
		// 	->select()
		$sql = 'SELECT count(*) as count,timetype
				FROM kq_doctor_time
				WHERE yid = ' . $yId . '
				AND `date_time` BETWEEN ' . $between . '
				AND `status` = 0
				 GROUP BY timetype';
		$res = $this->query($sql);
		return $res;
	}
	//获取这个医师同个时间段预约人数 单个时间段
	public function checkYsTimeOne() {
		if (!($uid = input('uid')) || !($yid = input('yid')) || (!$timetype = input('timetype')) || (!$date_time = input('date_time'))) {
			return false;
		}
		//计算预约时间
		$timetype_arr = gettimetype_arr($timetype);
		$date_time = strtotime($date_time . ' ' . $timetype_arr['time']);

		//获取这天这个时间段的预约人数
		$where = [
			'yid' => $yid,
			// 'timetype' => $timetype,
			'date_time' => $date_time,
			'status' => 0,
		];
		$res = $this->where($where)->count();
		return $res;
	}
	//获取用户预约列表
	public function getUserTimeList() {
		$arr = Config::get('appconf.timetype');
		$res = $this
			->field('t.*,y.nickname as yname,u.nickname as uname,u.phone as uphone,u.sex as usex,y.phone as yphone,y.jineng,s.disease')
			->alias('t')
			->join('kq_users y', 't.yid = y.id', 'RIGHT')
			->join('kq_users u', 't.uid = u.id', 'RIGHT')
			->join('kq_shops s', 's.id = t.did', 'RIGHT')
			// ->fetchSql(true)
			->limit($this->from, $this->size)
			->where($this->map)
			->select();
		if ($res) {
			foreach ($res as $k => $v) {
				$res[$k]['timetypeinfo'] = empty($v['timetype']) ? '' : $arr[$v['timetype']];
				$res[$k]['time_out'] = $res[$k]['date_time'] < time() ? 1 : 0;
				$res[$k]['date_time'] = date('Y-m-d', $v['date_time']);

				// if ($res[$k]['date_time'] == date('Y-m-d') && $res[$k]['hour'] < date('H')) {
				// 	unset($res[$k]);
				// }
			}
		}
		return $res;
	}
	//获取一条数据
	public function getOneInfo() {

		$res = $this
			->field('t.*,y.nickname as yname,u.nickname as uname,u.phone as uphone,u.sex as usex,y.phone as yphone,y.jineng,s.disease')
			->alias('t')
			->join('kq_users y', 't.yid = y.id', 'RIGHT')
			->join('kq_users u', 't.uid = u.id', 'RIGHT')
			->join('kq_shops s', 's.id = t.did', 'RIGHT')
			->where($this->map)
			->find();
		return $res;
	}

	//获取医师下的所有预约列表
	public function getYsDoctorList($yId) {
		$where = [
			'yid' => $yId,
		];
		$res = $this
			->field('u.nickname,u.phone,t.*')
			->alias('t')
			->join('kq_users u', 't.uid = u.id', 'LEFT')
			->limit($this->from, $this->size)
			->where(array_merge($where, $this->map))
			// ->fetchSql(true)
			->select();
		return $res;
	}
}