<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/27
 * Time: 下午5:57
 */
namespace app\common\model;
use think\Model;

class Users extends Base {

	// public function getUpdateTimeAttr($value) {
	// 	$res = date('Y-m-d', $value);
	// 	return $res;
	// }
	// public function getCreateTimeAttr($value) {
	// 	$res = date('Y-m-d', $value);
	// 	return $res;
	// }

	//关联自己
	public function users() {
		return $this->hasOne('Users', 'id', 'parent_id');
	}
	//用户信息
	public function getUserInfo() {
		$res = $this
			->where($this->map)
			->find();
		if ($res && $res['parent_id'] > 0) {
			$res['parent_info'] = $this->where('id', $res['parent_id'])->find();
		}
		return $res;
	}
	//修改用户信息
	public function updateUserInfo($data = [], $where = []) {
		$res = $this->save($data, $where);
		return $res;
	}

	//获取店铺列表
	public function getDpList() {
		$this->map['type'] = 3;
		$res = $this->where($this->map)->select();
		return $res;
	}
	//获取医师列表
	public function getDoctorList() {
		$this->map['type'] = 2;
		$res = $this
			->where($this->map)
			// ->fetchSql(true)
			->limit($this->from, $this->size)
			->select();
		return $res;
	}
	/**
	 * 获取医师信息
	 * @return [type] [description]
	 */
	public function getYsInfo() {
		$res = $this
			->where($this->map)
			->find();
		return $res;
	}
	/**
	 * 获取用户type
	 */
	public function getType($id) {
		return $this->where('id', $id)->value('type');
	}
	//获取这个客服下的所有用户  暂时先把数据库所有用户拿来  以后改
	public function updateUserArr($kf_id = '') {
		$res = $this
			->field('nickname,im_identifier,pic,id,phone')
			->select();

		return $res;
	}
}