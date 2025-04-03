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

use app\service\ApiService;

/**
 * 空控制器响应
 * @author   wls
 * @blog    http://gong.gg/
 * @version 1.0.0
 * @date    2018-11-30
 * @desc    description
 */
class Error extends Common
{
    /**
     * 空控制器响应
     * @author   wls
     * @blog    http://gong.gg/
     * @version 1.0.0
     * @date    2018-11-30
     * @desc    description
     * @param   [string]         $method [方法名称]
     * @param   [array]          $args   [参数]
     */
    public function __call($method, $args)
    {
        $msg = MyLang('controller_not_exist_tips').'('.RequestController().')';
        if(IS_AJAX)
        {
            return ApiService::ApiDataReturn(DataReturn($msg, -1000));
        } else {
            MyViewAssign('msg', $msg);
            return MyView('public/tips_error');
        }
    }

    /**
     * 错误信息提示
     * @author  Devil
     * @blog    http://gong.gg/
     * @version 1.0.0
     * @date    2022-08-17
     * @desc    description
     */
    public function Tips()
    {
        $msg = empty($this->data_request['msg']) ? MyLang('error') : urldecode(base64_decode($this->data_request['msg']));
        return MyView('public/tips_error', ['msg'=>$msg]);
    }
}
?>