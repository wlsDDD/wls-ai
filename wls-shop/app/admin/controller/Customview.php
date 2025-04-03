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
use app\service\CustomViewService;

/**
 * 自定义页面管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class CustomView extends Base
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
        // 数据
        $data = $this->data_detail;
        if(empty($data))
        {
            $ret = CustomViewService::CustomViewSave();
            if($ret['code'] == 0)
            {
                return MyRedirect(MyUrl('admin/customview/saveinfo', ['id'=>$ret['data']]));
            } else {
                MyViewAssign('msg', $ret['msg']);
                return MyView('public/tips_error');
            }
        }

		// 参数
		$params = $this->data_request;
        unset($params['id']);
        MyViewAssign([
            'data'                => $data,
            'params'              => $params,
            // 编辑器文件存放地址定义
            'editor_path_type'    => 'customview',
            // 加载代码编辑器
            'is_load_ace_builds'  => 1,
        ]);
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
        return ApiService::ApiDataReturn(CustomViewService::CustomViewSave($params));
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
        $params['user_type'] = 'admin';
        return ApiService::ApiDataReturn(CustomViewService::CustomViewDelete($params));
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
        return ApiService::ApiDataReturn(CustomViewService::CustomViewStatusUpdate($params));
	}
}
?>