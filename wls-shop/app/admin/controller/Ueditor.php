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

use app\service\UeditorService;
use app\service\ApiService;

/**
 * 百度编辑器控制器入口
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Ueditor extends Common
{
    /**
     * 构造方法
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2016-12-03T12:39:08+0800
     */
    public function __construct()
    {
        // 调用父类前置方法
        parent::__construct();

        // 登录校验
        $this->IsLogin();
    }

    /**
     * 运行入口
     * @author  Devil
     * @blog    http://gong.gg/
     * @version 1.0.0
     * @date    2019-08-06
     * @desc    description
     */
    public function Index()
    {
        return ApiService::ApiDataReturn(UeditorService::Run($this->data_request));
    }
}
?>