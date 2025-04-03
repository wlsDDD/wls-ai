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
use app\service\SqlConsoleService;

/**
 * sql控制台
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Sqlconsole extends Base
{
    /**
     * 首页
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2017-02-26T19:13:29+0800
     */
    public function Index()
    {
        return MyView();
    }

    /**
     * sql执行
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2016-12-15T11:03:30+0800
     */
    public function Implement()
    {
        // 是否开启开发者模式
        if(MyConfig('shopxo.is_develop') !== true)
        {
            $ret = DataReturn(MyLang('not_open_developer_mode_tips'), -1);
        } else {
            $ret = SqlConsoleService::Implement($this->data_request);
        }
        return ApiService::ApiDataReturn($ret);
    }
}
?>