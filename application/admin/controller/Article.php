<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path'), EXT);
use app\admin\Controller;
use \think\Config;
use \think\Loader;

class Article extends Controller {
	use \app\admin\traits\controller\Controller;
	// 方法黑名单
	protected static $blacklist = [];

	protected static $isdelete = false;
	//文章列表
	public function News() {
		$this->maparr = [
			// 'type' => 2,
		];
		$this->view_html = 'Article/index';

		return $this->index();
	}
	public function Video() {
		$this->maparr = [
			'type' => 1,
		];
		$this->view_html = 'Article/video/index';

		return $this->index();
	}

	/**
	 * 添加
	 * @return mixed
	 */
	public function add_1() {
		$this->template = 'Article/video/edit';
		return $this->add();
	}

	/**
	 * 编辑
	 * @return mixed
	 */
	public function edit_1() {
		$this->template = 'Article/video/edit';
		return $this->edit();
	}

	/**
	 * 编辑
	 * @return mixed
	 */
	public function edit() {
		$controller = $this->request->controller();

		if ($this->request->isAjax()) {
			// 更新
			$data = $this->request->post();
			if (!$data['id']) {
				return ajax_return_adv_error("缺少参数ID");
			}

			// 验证
			if (class_exists($validateClass = Loader::parseClass(Config::get('app.validate_path'), 'validate', $controller))) {
				$validate = new $validateClass();
				if (!$validate->check($data)) {
					return ajax_return_adv_error($validate->getError());
				}
			}

			//处理视频  如果视频地址更改了就删除掉原来的
			$Article = Loader::model('Article');
			if ($url = $Article->where(['id' => $data['id']])->value('v_url')) {
				if (isset($data['v_url']) && $data['v_url'] != $url) {
					deleteUrl($url);
				}
			}

			// 更新数据
			if (
				class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $this->parseCamelCase($controller)))
				|| class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $controller))
			) {
				// 使用模型更新，可以在模型中定义更高级的操作
				$model = new $modelClass();
				$ret = $model->isUpdate(true)->save($data, ['id' => $data['id']]);
			} else {
				// 简单的直接使用db更新
				Db::startTrans();
				try {
					$model = Db::name($this->parseTable($controller));
					$ret = $model->where('id', $data['id'])->update($data);
					// 提交事务
					Db::commit();
				} catch (\Exception $e) {
					// 回滚事务
					Db::rollback();

					return ajax_return_adv_error($e->getMessage());
				}
			}

			return ajax_return_adv("编辑成功");
		} else {
			// 编辑
			$id = $this->request->param('id');
			if (!$id) {
				throw new HttpException(404, "缺少参数ID");
			}
			$vo = $this->getModel($controller)->find($id);
			if (!$vo) {
				throw new HttpException(404, '该记录不存在');
			}

			$this->view->assign("vo", $vo);

			return $this->view->fetch(isset($this->template) ? $this->template : 'edit');
		}
	}
}
