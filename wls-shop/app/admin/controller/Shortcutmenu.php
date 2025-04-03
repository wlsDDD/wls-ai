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
use app\service\ResourcesService;
use app\service\ShortcutMenuService;

/**
 * 常用功能管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class ShortcutMenu extends Base
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
        MyViewAssign([
            // 数据
            'data'              => ShortcutMenuService::ShortcutMenuList(['admin'=>$this->admin, 'is_edit'=>1]),
            // 编辑器文件存放地址
            'editor_path_type'  => ResourcesService::EditorPathTypeValue('shortcutmenu'),
        ]);
        return MyView();
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
        return ApiService::ApiDataReturn(ShortcutMenuService::ShortcutMenuSave($params));
    }

    /**
     * 排序
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2016-12-25T22:36:12+0800
     */
    public function Sort()
    {
        $params = $this->data_request;
        $params['admin'] = $this->admin;
        return ApiService::ApiDataReturn(ShortcutMenuService::ShortcutMenuSort($params));
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
        return ApiService::ApiDataReturn(ShortcutMenuService::ShortcutMenuDelete($params));
    }
}
?>