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
use app\service\SafetyService;

/**
 * 安全
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2017-03-02T22:48:35+0800
 */
class Safety extends Common
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

        // 是否登录
        $this->IsLogin();
    }

    /**
     * 登录密码修改
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2017-03-28T10:38:23+0800
     */
    public function LoginPwdUpdate()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(SafetyService::LoginPwdUpdate($params));
    }

    /**
     * 账号注销
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2017-03-28T17:04:36+0800
     */
    public function Logout()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(SafetyService::AccountsLogout($params));
    }
}
?>