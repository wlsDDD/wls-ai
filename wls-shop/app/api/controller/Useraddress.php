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
use app\service\ConfigService;
use app\service\UserAddressService;
use app\service\ResourcesService;

/**
 * 用户地址
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2017-03-02T22:48:35+0800
 */
class UserAddress extends Common
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
     * 地址列表
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-07-18
     * @desc    description
     */
    public function Index()
    {
        $ret = UserAddressService::UserAddressList(['user'=>$this->user]);
        $result = [
            'data'  => $ret['data'],
        ];
        return ApiService::ApiDataReturn(SystemBaseService::DataReturn($result));
    }

    /**
     * 地址详情
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-07-18
     * @desc    description
     */
    public function Detail()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        $data = empty($params['id']) ? [] : UserAddressService::UserAddressRow($params);

        // 返回数据
        $result = [
            'data'              => empty($data['data']) ? null : $data['data'],
            'editor_path_type'  => ResourcesService::EditorPathTypeValue(UserAddressService::EditorAttachmentPathType($this->user['id'])),
        ];
        return ApiService::ApiDataReturn(SystemBaseService::DataReturn($result));
    }

    /**
     * 用户地址保存
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-07-18
     * @desc    description
     */
    public function Save()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(UserAddressService::UserAddressSave($params));
    }

    /**
     * 删除地址
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-07-18
     * @desc    description
     */
    public function Delete()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(UserAddressService::UserAddressDelete($params));
    }

    /**
     * 默认地址设置
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-07-18
     * @desc    description
     */
    public function SetDefault()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(UserAddressService::UserAddressDefault($params));
    }

    /**
     * 自提点地址列表
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2019-11-25
     * @desc    description
     */
    public function Extraction()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(ConfigService::SiteTypeExtractionAddressList(null, $params));
    }

    /**
     * 外部系统地址添加
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-09-21
     * @desc    description
     */
    public function OutSystemAdd()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(UserAddressService::OutSystemUserAddressAdd($params));
    }
}
?>