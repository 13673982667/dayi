<?php
namespace app\common\model;

use think\Model;

class Article extends Base {
	// 指定表名,不含前缀
	protected $name = 'article';
	// 开启自动写入时间戳字段
	protected $autoWriteTimestamp = 'int';

	public function getContentAttr($value) {
		$res = htmlspecialchars_decode($value);
		return $res;
	}
	public function getCreateTimeAttr($value) {
		$res = date('Y-m-d', $value);
		return $res;
	}
	public function getUpdateTimeAttr($value) {
		$res = date('Y-m-d', $value);
		return $res;
	}
	/**
	 * 获取单个文章
	 * @return [type] [description]
	 */
	public function getNewsInfo() {
		$res = $this->where($this->map)->find();
		if ($res) {
			$res['content'] = htmlspecialchars_decode($res['content']);
		}
		return $res;
	}
	/**
	 * 获取文章列表
	 * @return [type] [description]
	 */
	public function getNewsList() {
		$res = $this
			->order($this->order)
			->where($this->map)
			->order($this->order)
			->limit($this->from, $this->size)
			->select();
		// if ($res) {
		// 	$res['content'] = htmlspecialchars_decode($res['content']);
		// }
		return $res;
	}
}
