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
 * 短信设置
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Sms extends Base
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
		// 导航
		$type = empty($this->data_request['type']) ? 'index' : $this->data_request['type'];
		$assign = [
            // 配置信息
            'data'      => ConfigService::ConfigList(),
            // 管理导航
            'nav_data'  => MyLang('sms.base_nav_list'),
            // 页面导航
            'type'      => $type,
		];
		MyViewAssign($assign);
		return MyView($type);
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
		return ApiService::ApiDataReturn(ConfigService::ConfigSave($_POST));
	}
}
?>