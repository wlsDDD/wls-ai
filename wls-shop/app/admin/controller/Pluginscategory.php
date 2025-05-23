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
use app\service\PluginsCategoryService;

/**
 * 应用分类管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class PluginsCategory extends Base
{
    /**
     * 列表
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2016-12-06T21:31:53+0800
     */
    public function Index()
    {
        return MyView();
    }

    /**
     * 获取节点子列表
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2016-12-25T15:19:45+0800
     */
    public function GetNodeSon()
    {
        return ApiService::ApiDataReturn(PluginsCategoryService::PluginsCategoryNodeSon($this->data_request));
    }

    /**
     * 保存
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2016-12-25T22:36:12+0800
     */
    public function Save()
    {
        $params = $this->data_request;
        $params['admin'] = $this->admin;
        return ApiService::ApiDataReturn(PluginsCategoryService::PluginsCategorySave($params));
    }

    /**
     * 状态更新
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2021-03-31
     * @desc    description
     */
    public function StatusUpdate()
    {
        $params = $this->data_request;
        $params['admin'] = $this->admin;
        return ApiService::ApiDataReturn(PluginsCategoryService::PluginsCategoryStatusUpdate($params));
    }

    /**
     * 删除
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2016-12-25T22:36:12+0800
     */
    public function Delete()
    {
        $params = $this->data_request;
        $params['admin'] = $this->admin;
        return ApiService::ApiDataReturn(PluginsCategoryService::PluginsCategoryDelete($params));
    }
}
?>