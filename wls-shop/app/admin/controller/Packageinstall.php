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
use app\service\PackageInstallService;

/**
 * 软件包安装
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class PackageInstall extends Base
{
    /**
     * 获取安装参数
     * @author  Devil
     * @blog    http://gong.gg/
     * @version 1.0.0
     * @date    2018-09-28
     * @desc    description
     */
    public function Index()
    {
        $data = PackageInstallService::RequestInstallParams($this->data_request);
        MyViewAssign('data', $data);
        return MyView();
    }

    /**
     * 软件安装
     * @author  Devil
     * @blog    http://gong.gg/
     * @version 1.0.0
     * @date    2021-02-22
     * @desc    description
     */
    public function Install()
    {
        return ApiService::ApiDataReturn(PackageInstallService::Install($this->data_request));
    }
}
?>