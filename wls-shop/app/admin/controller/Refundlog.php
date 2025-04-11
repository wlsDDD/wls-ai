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

/**
 * 退款日志管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class RefundLog extends Base
{
    /**
     * 列表
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2022-08-01
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
     * @date    2022-08-01
     * @desc    description
     */
    public function Detail()
    {
        return MyView();
    }
}
?>