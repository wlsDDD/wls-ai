<?php
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
// | Author: wls
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\controller\Base;
use app\service\ApiService;
use app\service\ConfigService;

/**
 * seo设置
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Seo extends Base
{
	/**
     * 列表
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2016-12-06T21:31:53+0800
     */
	public function Index()
	{
		// 模板数据
		$assign = [
			// url模式
			'common_seo_url_model_list'  => MyConst('common_seo_url_model_list'),
			// 配置信息
			'data'                       => ConfigService::ConfigList(),
		];
		MyViewAssign($assign);
		return MyView();
	}

	/**
	 * 保存
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2017-01-02T23:08:19+0800
	 */
	public function Save()
	{
		return ApiService::ApiDataReturn(ConfigService::ConfigSave($this->data_request));
	}
}
?>