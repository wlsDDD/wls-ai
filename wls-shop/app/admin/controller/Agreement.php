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
use app\service\ConfigService;
use app\service\ResourcesService;

/**
 * 协议管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Agreement extends Base
{
    /**
     * 配置列表
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2019-05-16
     * @desc    description
     */
    public function Index()
    {
        // 导航
        $type = empty($this->data_request['type']) ? 'register' : $this->data_request['type'];
        $assign = [
            // 配置信息
            'data'              => ConfigService::ConfigList(),
            // 管理导航
            'nav_data'          => MyLang('agreement.base_nav_list'),
            // 编辑器文件存放地址
            'editor_path_type'  => ResourcesService::EditorPathTypeValue('agreement'),
            // 页面导航
            'type'              => $type,
        ];
        MyViewAssign($assign);
        return MyView($type);
    }

    /**
     * 配置数据保存
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2019-05-16
     * @desc    description
     */
    public function Save()
    {
        return ApiService::ApiDataReturn(ConfigService::ConfigSave($_POST));
    }
}
?>