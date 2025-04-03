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
use app\service\UserAddressService;
use app\service\ResourcesService;

/**
 * 用户地址管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class UserAddress extends Base
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

        // 模板数据
        $assign = [
            // 当前数据
            'data'              => $data,
            // 加载地图api
            'is_load_map_api'   => MyC('home_user_address_map_status'),
        ];

        // 编辑器文件存放地址
        if(!empty($data['user_id']))
        {
            $assign['editor_path_type'] = ResourcesService::EditorPathTypeValue(UserAddressService::EditorAttachmentPathType($data['user_id']));
        }

        // 参数处理
        $params = $this->data_request;
        unset($params['id']);
        $assign['params'] = $params;

        // 数据赋值
        MyViewAssign($assign);
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
        if(empty($params['user_id']))
        {
            $ret = DataReturn(MyLang('no_data'), -1);
        } else {
            $params['user'] = ['id'=>$params['user_id']];
            $ret = UserAddressService::UserAddressSave($params);
        }
        return ApiService::ApiDataReturn($ret);
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
        $params['user_type'] = 'admin';
        return ApiService::ApiDataReturn(UserAddressService::UserAddressAdminDelete($params));
    }
}
?>