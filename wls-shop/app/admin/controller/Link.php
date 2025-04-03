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
use app\service\LinkService;

/**
 * 友情链接
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Link extends Base
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
     * 详情
     * @author   wls
     *
     * @version  1.0.0
     * @datetime 2019-08-05T08:21:54+0800
     */
    public function Detail()
    {
        return MyView();
    }

	/**
	 * 保存
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2017-02-05T20:12:30+0800
	 */
	public function Save()
	{
        $params = $this->data_request;
        return ApiService::ApiDataReturn(LinkService::LinkSave($params));
	}

	/**
	 * 删除
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2016-12-09T21:13:47+0800
	 */
	public function Delete()
	{
        $params = $this->data_request;
        $params['user_type'] = 'admin';
        return ApiService::ApiDataReturn(LinkService::LinkDelete($params));
	}

	/**
	 * 状态更新
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2017-01-12T22:23:06+0800
	 */
	public function StatusUpdate()
	{
        $params = $this->data_request;
        return ApiService::ApiDataReturn(LinkService::LinkStatusUpdate($params));
	}
}
?>