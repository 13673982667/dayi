<?php
namespace app\api\controller;
use app\common\lib\yunxin;
use \think\Config;
use \think\Controller;

class Im extends Controller {
	private $cu;

	public function _initialize() {
		parent::_initialize();
		$this->cu = new yunxin(Config::get('im.AppKey'), Config::get('im.AppSecret'));
	}

	public function index() {
		// p($this->cu->createUserId('user1'), 1);
		p($this->cu->getUinfos(['asd']));
	}

}
