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

/**
 * 基础公共接口
 * @author  Devil
 * @blog    http://gong.gg/
 * @version 1.0.0
 * @date    2020-09-12
 * @desc    description
 */
class Base extends Common
{
    /**
     * 配置信息
     * @author  Devil
     * @blog    http://gong.gg/
     * @version 1.0.0
     * @date    2020-09-12
     * @desc    description
     */
    public function Common()
    {
        // 参数
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(SystemBaseService::Common($params));
    }
}
?>