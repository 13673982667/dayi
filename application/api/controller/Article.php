<?php
namespace app\api\controller;
use \think\Loader;

class Article extends Base {
	public function _initialize() {
		parent::_initialize();
	}
	public function index() {
		return show('1');
	}

	/**
	 * 获取单个文章
	 * @return [type] [description]
	 */
	public function getNewsInfo() {
		if (!($news_id = input('news_id'))) {
			return show(2);
		}
		$Article = Loader::model('Article');
		$where = [
			'id' => $news_id,
		];
		$res = $Article->setval('map', $where)->getNewsInfo();
		if ($res) {
			return show(1, '', $res);
		}
		return show();
	}

	/**
	 * 获取文章列表
	 */
	public function getNewsList() {
		$Article = Loader::model('Article');
		$where = [
			'type' => 0,
		];
		$res = $Article->setval('map', $where)->getNewsList();
		if ($res) {
			return show(1, '', $res);
		}
		return show();
	}
	/**
	 * 获取视频列表
	 */
	public function getVideoList() {
		$Article = Loader::model('Article');
		$where = [
			'type' => 1,
		];
		$res = $Article->setval('map', $where)->getNewsList();
		if ($res) {
			return show(1, '', $res);
		}
		return show();
	}

}
