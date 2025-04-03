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
use app\service\SlideService;
use app\service\ResourcesService;

/**
 * 轮播图片管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Slide extends Base
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
     * 详情
     * @author   wls
     *
     * @version  1.0.0
     * @datetime 2019-08-05T08:21:54+0800
     */
    public function Detail()
    {
        return MyView();
    }

    /**
     * 添加/编辑页面
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2016-12-14T21:37:02+0800
     */
    public function SaveInfo()
    {
        // 模板数据
        $assign = [
            // 当前数据
            'data'                  => $this->data_detail,
            // 编辑器文件存放地址
            'editor_path_type'      => ResourcesService::EditorPathTypeValue('slide'),
        ];

        // 参数
        $params = $this->data_request;
        unset($params['id']);
        $assign['params'] = $params;

        // 数据赋值
        MyViewAssign($assign);
        return MyView();
    }

    /**
     * 添加/编辑
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2016-12-14T21:37:02+0800
     */
    public function Save()
    {
        $params = $this->data_request;
        return ApiService::ApiDataReturn(SlideService::SlideSave($params));
    }

    /**
     * 删除
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2016-12-15T11:03:30+0800
     */
    public function Delete()
    {
        $params = $this->data_request;
        return ApiService::ApiDataReturn(SlideService::SlideDelete($params));
    }

    /**
     * 状态更新
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2017-01-12T22:23:06+0800
     */
    public function StatusUpdate()
    {
        $params = $this->data_request;
        return ApiService::ApiDataReturn(SlideService::SlideStatusUpdate($params));
    }
}
?>