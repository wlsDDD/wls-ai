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
use app\service\LayoutService;

/**
 * 布局管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Layout extends Base
{
    /**
     * 前端首页布局保存
     * @author  Devil
     * @blog    http://gong.gg/
     * @version 1.0.0
     * @date    2021-06-22
     * @desc    description
     */
    public function LayoutIndexHomeSave()
    {
        return ApiService::ApiDataReturn(LayoutService::LayoutConfigSave('home', $this->data_request));
    }
}
?>