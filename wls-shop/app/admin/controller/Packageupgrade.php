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
use app\service\PackageUpgradeService;

/**
 * 软件包更新
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Packageupgrade extends Base
{
    /**
     * 软件更新
     * @author  Devil
     * @blog    http://gong.gg/
     * @version 1.0.0
     * @date    2021-02-22
     * @desc    description
     */
    public function Upgrade()
    {
        return ApiService::ApiDataReturn(PackageUpgradeService::Run($this->data_request));
    }
}
?>