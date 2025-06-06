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
use app\service\AdminPowerService;

/**
 * 权限菜单管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Power extends Base
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
		return MyView();
	}

	/**
	 * 获取节点子列表
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2016-12-25T15:19:45+0800
	 */
	public function GetNodeSon()
	{
		return ApiService::ApiDataReturn(AdminPowerService::PowerNodeSon($this->data_request));
	}

	/**
	 * 权限添加/编辑
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2016-12-13T21:41:03+0800
	 */
	public function Save()
	{
		$params = $this->data_request;
		$params['admin'] = $this->admin;
		return ApiService::ApiDataReturn(AdminPowerService::PowerSave($params));
	}

	/**
	 * 状态更新
	 * @author  Devil
     *
     * @version 1.0.0
     * @date    2021-03-31
     * @desc    description
	 */
	public function StatusUpdate()
	{
		$params = $this->data_request;
		$params['admin'] = $this->admin;
		return ApiService::ApiDataReturn(AdminPowerService::PowerStatusUpdate($params));
	}

	/**
	 * 删除
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2016-12-14T21:40:29+0800
	 */
	public function Delete()
	{
		$params = $this->data_request;
		$params['admin'] = $this->admin;
		return ApiService::ApiDataReturn(AdminPowerService::PowerDelete($params));
	}
}
?>