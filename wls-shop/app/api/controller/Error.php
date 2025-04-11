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

/**
 * 空控制器响应
 * @author   wls
 *
 * @version 1.0.0
 * @date    2018-11-30
 * @desc    description
 */
class Error extends Common
{
    /**
     * 空控制器响应
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-11-30
     * @desc    description
     * @param   [string]         $method [方法名称]
     * @param   [array]          $args   [参数]
     */
    public function __call($method, $args)
    {
        return ApiService::ApiDataReturn(DataReturn(MyLang('controller_not_exist_tips').'('.RequestController().')', -1000));
    }
}
?>