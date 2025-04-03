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
use app\service\PayLogService;

/**
 * 支付日志管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class PayLog extends Base
{
    /**
     * 列表
     * @author  Devil
     * @blog    http://gong.gg/
     * @version 1.0.0
     * @date    2022-08-01
     * @desc    description
     */
	public function Index()
	{
        return MyView();
	}

    /**
     * 详情
     * @author  Devil
     * @blog    http://gong.gg/
     * @version 1.0.0
     * @date    2022-08-01
     * @desc    description
     */
    public function Detail()
    {
        return MyView();
    }

    /**
     * 关闭
     * @author  Devil
     * @blog    http://gong.gg/
     * @version 1.0.0
     * @date    2020-07-28
     * @desc    description
     */
    public function Close()
    {
        $params = $this->data_request;
        $params['admin'] = $this->admin;
        return ApiService::ApiDataReturn(PayLogService::PayLogClose($params));
    }
}
?>