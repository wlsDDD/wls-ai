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
use app\service\OrderAftersaleService;

/**
 * 订单售后
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Orderaftersale extends Base
{
    /**
     * 列表
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-09-28
     * @desc    description
     */
    public function Index()
    {
        // 静态数据
        MyViewAssign('common_order_aftersale_refundment_list', MyConst('common_order_aftersale_refundment_list'));
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
     * 确认
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2019-05-23
     * @desc    description
     */
    public function Confirm()
    {
        $params = $this->data_request;
        $params['creator'] = $this->admin['id'];
        $params['creator_name'] = $this->admin['username'];
        return ApiService::ApiDataReturn(OrderAftersaleService::AftersaleConfirm($params));
    }

    /**
     * 审核
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2019-05-23
     * @desc    description
     */
    public function Audit()
    {
        $params = $this->data_request;
        $params['creator'] = $this->admin['id'];
        $params['creator_name'] = $this->admin['username'];
        return ApiService::ApiDataReturn(OrderAftersaleService::AftersaleAudit($params));
    }

    /**
     * 拒绝
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2019-05-23
     * @desc    description
     */
    public function Refuse()
    {
        $params = $this->data_request;
        $params['creator'] = $this->admin['id'];
        $params['creator_name'] = $this->admin['username'];
        return ApiService::ApiDataReturn(OrderAftersaleService::AftersaleRefuse($params));
    }

    /**
     * 取消
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-09-30
     * @desc    description
     */
    public function Cancel()
    {
        $params = $this->data_request;
        $params['creator'] = $this->admin['id'];
        $params['creator_name'] = $this->admin['username'];
        return ApiService::ApiDataReturn(OrderAftersaleService::AftersaleCancel($params));
    }

    /**
     * 删除
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-09-30
     * @desc    description
     */
    public function Delete()
    {
        $params = $this->data_request;
        $params['creator'] = $this->admin['id'];
        $params['creator_name'] = $this->admin['username'];
        return ApiService::ApiDataReturn(OrderAftersaleService::AftersaleDelete($params));
    }
}
?>