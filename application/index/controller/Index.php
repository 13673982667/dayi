<?php
namespace app\index\controller;
use \think\Cache;

class Index {
	public function index(Cache $Cache) {
		// p($Cache::get('asd', 'asdads'));
		// $Users = Loader::model('Users');
		// p($Users->where(`id` = ?)->find());
		// return \think\Response::create(\think\Url::build('/api'), 'redirect');
		list($t1, $t2) = explode(' ', microtime());
		p($t1);
		p($t2);

		p((float) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000));

	}
}
