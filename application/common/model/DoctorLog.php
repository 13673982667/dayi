<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/27
 * Time: 下午5:57
 */
namespace app\common\model;
use think\Model;

class DoctorLog extends Base {

	// 开启自动写入时间戳字段
	protected $autoWriteTimestamp = false;

	//一条
	public function getOne() {
		$res = $this->where($this->map)->find();

		return $res;
	}

}