<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/27
 * Time: 下午5:57
 */
namespace app\common\model;
use think\Model;

class Doctor extends Base {

	// 开启自动写入时间戳字段
	protected $autoWriteTimestamp = false;

	//获取医师列表
	public function getList() {
		$res = $this
			->where($this->map)
			->order($this->order)
			// ->limit($this->from, $this->size)
			// ->fetchSql(true)
			->select();
		return $res;
	}

	/**
	 * 获取医师信息
	 * @return [type] [description]
	 */
	public function getYsInfo() {
		$res = $this
			->field('*')
			->where($this->map)
			->find();
		return $res;
	}

}