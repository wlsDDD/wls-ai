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
use app\service\FormTableService;

/**
 * 动态表单
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class FormTable extends Common
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
     * 字段选择保存
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-10-08
     * @desc    description
     */
    public function FieldsSelectSave()
    {
        $params = $this->data_request;
        $params['user_id'] = $this->admin['id'];
        $params['user_type'] = 0;
        return ApiService::ApiDataReturn(FormTableService::FieldsSelectSave($params));
    }

    /**
     * 字段选择重置
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-10-08
     * @desc    description
     */
    public function FieldsSelectReset()
    {
        $params = $this->data_request;
        $params['user_id'] = $this->admin['id'];
        $params['user_type'] = 0;
        return ApiService::ApiDataReturn(FormTableService::FieldsSelectReset($params));
    }
}
?>