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
use app\service\ErrorLogService;

/**
 * 错误日志管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class ErrorLog extends Base
{
    /**
     * 列表
     * @author  Devil
     *
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
     *
     * @version 1.0.0
     * @date    2022-08-01
     * @desc    description
     */
    public function Detail()
    {
        return MyView();
    }

    /**
     * 删除
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-07-28
     * @desc    description
     */
    public function Delete()
    {
        $params = $this->data_request;
        $params['admin'] = $this->admin;
        return ApiService::ApiDataReturn(ErrorLogService::ErrorLogDelete($params));
    }

    /**
     * 全部删除
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2021-11-18
     * @desc    description
     */
    public function AllDelete()
    {
        $params = $this->data_request;
        $params['admin'] = $this->admin;
        return ApiService::ApiDataReturn(ErrorLogService::ErrorLogAllDelete($params));
    }
}
?>