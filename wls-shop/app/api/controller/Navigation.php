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
namespace app\api\controller;

use app\service\ApiService;
use app\service\SystemBaseService;
use app\service\AppHomeNavService;

/**
 * 导航
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Navigation extends Common
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
    }

    /**
     * [Index 入口]
     * @author   wls
     *
     * @version  1.0.0
     * @datetime 2018-05-25T11:03:59+0800
     */
    public function Index()
    {
        // 获取轮播
        $result = AppHomeNavService::AppHomeNav();
        return ApiService::ApiDataReturn(SystemBaseService::DataReturn($result));
    }
}
?>