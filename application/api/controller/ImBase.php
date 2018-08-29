<?php
namespace app\api\controller;
use \think\Cache;
use \think\Controller;

class ImBase extends Controller {
	public $api;
	private $sdkappid = 1400110826;
	private $identifier = "admin";
	private $private_key_path = "./imSdk/key/1400110826/private_key";
	private $signature = "./imSdk/";

	public function _initialize() {
		parent::_initialize();
		// 设置 REST API 调用基本参数
		$this->system(); //判断用的是什么系统
		include_once './imSdk/TimRestApi.php';
		$this->api = createRestAPI();
		$this->api->init($this->sdkappid, $this->identifier);
		$this->getSig($this->identifier, '86400'); //获取管理员的sig
	}

	public function index() {

	}

	//获取sig
	public function getSig($identifier, $time = '86400') {
		if ($Sig = Cache::get('im_sig_' . $identifier)) {
			if ($identifier == $this->identifier) {
				$this->api->set_user_sig($Sig[0]);
			}
			return $Sig;
		}
		// 生成签名，有效期一天
		// 对于FastCGI，可以一直复用同一个签名，但是必须在签名过期之前重新生成签名
		$Sig = $this->api->generate_user_sig($identifier, $time, $this->private_key_path, $this->signature);
		if ($Sig == null) {
			// 签名生成失败
			return false;
		}
		//存缓存
		Cache::set('im_sig_' . $identifier, $Sig, 86400);
		return $Sig;
	}

	/**
	 * 判断操作系统
	 */
	public function system() {
		/**
		 * 判断操作系统位数
		 */
		function is_64bit() {
			$int = "9223372036854775807";
			$int = intval($int);
			if ($int == 9223372036854775807) {
				/* 64bit */
				return true;
			} elseif ($int == 2147483647) {
				/* 32bit */
				return false;
			} else {
				/* error */
				return "error";
			}
		}
		if (is_64bit()) {
			if (PATH_SEPARATOR == ':') {
				$this->signature .= "signature/linux-signature64";
			} else {
				$this->signature .= "signature\\windows-signature64.exe";
			}

		} else {
			if (PATH_SEPARATOR == ':') {
				$this->signature .= "signature/linux-signature32";
			} else {
				$this->signature .= "signature\\windows-signature32.exe";
			}
		}

	}
}
