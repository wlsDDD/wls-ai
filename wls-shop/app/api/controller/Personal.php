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
use app\service\UserService;

/**
 * 用户资料
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2017-03-02T22:48:35+0800
 */
class Personal extends Common
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

        // 是否登录、排除用户头像方法
        if(!in_array($this->action_name, ['useravatarupload']))
        {
            $this->IsLogin();
        }
    }

    /**
     * 个人资料
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2022-11-18
     * @desc    description
     */
    public function Index()
    {
        $data = [
            // 用户数据
            'data'          => UserService::UserHandle(UserService::UserInfo('id', $this->user['id'])),
            // 性别
            'gender_list'   => MyConst('common_gender_list'),
        ];
        return ApiService::ApiDataReturn(DataReturn('success', 0, $data));
    }

    /**
     * 保存
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2022-11-18
     * @desc    description
     */
    public function Save()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(UserService::PersonalSave($params));
    }

    /**
     * 用户头像上传
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-12-03
     * @desc    description
     */
    public function UserAvatarUpload()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        $params['img_field'] = 'file';
        return ApiService::ApiDataReturn(UserService::UserAvatarUpload($params));
    }
}
?>