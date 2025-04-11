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
use app\service\AttachmentService;

/**
 * 附件管理
 * @author  Devil
 *
 * @version 1.0.0
 * @date    2024-07-18
 * @desc    description
 */
class Attachment extends Base
{
    /**
     * 列表
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2024-07-18
     * @desc    description
     */
    public function Index()
    {
        return MyView();
    }

    /**
     * 详情
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2024-07-18
     * @desc    description
     */
    public function Detail()
    {
        return MyView();
    }

    /**
     * 添加/编辑页面
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2024-07-18
     * @desc    description
     */
    public function SaveInfo()
    {
        return MyView();
    }

    /**
     * 添加/编辑
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2024-07-18
     * @desc    description
     */
    public function Save()
    {
        $params = $this->data_request;
        $params['admin'] = $this->admin;
        return ApiService::ApiDataReturn(AttachmentService::AttachmentSave($params));
    }

    /**
     * 删除
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2024-07-18
     * @desc    description
     */
    public function Delete()
    {
        $params = $this->data_request;
        $params['admin'] = $this->admin;
        return ApiService::ApiDataReturn(AttachmentService::AttachmentDelete($params));
    }
}
?>