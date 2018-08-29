<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/27
 * Time: 下午5:57
 */
namespace app\common\model;
use think\Model;

class Shops extends Base {
	//获取症状列表
	public function getShops() {
		$res = $this->where($this->map)->select();

		return $res;
	}
}