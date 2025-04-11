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
use app\service\OrderAftersaleService;
use app\service\ResourcesService;

/**
 * 订单售后
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2019-10-04T21:51:08+0800
 */
class Orderaftersale extends Common
{
    /**
     * 构造方法
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-11-30
     * @desc    description
     */
    public function __construct()
    {
        parent::__construct();

        // 是否登录
        $this->IsLogin();
    }

    /**
     * 订单列表
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-09-28
     * @desc    description
     */
    public function Index()
    {
        // 参数
        $params = $this->data_request;
        $params['user'] = $this->user;
        $params['user_type'] = 'user';

        // 条件
        $where = OrderAftersaleService::OrderAftersaleListWhere($params);

        // 获取总数
        $total = OrderAftersaleService::OrderAftersaleTotal($where);
        $page_total = ceil($total/$this->page_size);
        $start = intval(($this->page-1)*$this->page_size);

        // 获取列表
        $data_params = [
            'm'                 => $start,
            'n'                 => $this->page_size,
            'where'             => $where,
            'is_orderaftersale' => 1,
        ];
        $data = OrderAftersaleService::OrderAftersaleList($data_params);

        // 返回数据
        $result = [
            'total'         => $total,
            'page_total'    => $page_total,
            'data'          => $data['data'],
        ];
        return ApiService::ApiDataReturn(SystemBaseService::DataReturn($result));
    }

    /**
     * 售后页面
     * @author   wls
     *
     * @version 1.0.0
     * @date    2019-05-21
     * @desc    description
     */
    public function Aftersale()
    {
        $order_id = isset($this->data_request['oid']) ? intval($this->data_request['oid']) : 0;
        $order_detail_id = isset($this->data_request['did']) ? intval($this->data_request['did']) : 0;
        $ret = OrderAftersaleService::OrdferGoodsRow($order_id, $order_detail_id, $this->user['id']);
        if($ret['code'] == 0)
        {
            // 获取当前订单商品售后最新的一条纪录
            $data_params = [
                'm'     => 0,
                'n'     => 1,
                'where' => [
                    ['order_detail_id', '=', $order_detail_id],
                    ['user_id', '=', $this->user['id']],
                ],
            ];
            $new_aftersale = OrderAftersaleService::OrderAftersaleList($data_params);
            if(!empty($new_aftersale['data'][0]))
            {
                $new_aftersale_data = $new_aftersale['data'][0];
                $new_aftersale_data['tips_msg'] = OrderAftersaleService::OrderAftersaleTipsMsg($new_aftersale_data);
            } else {
                $new_aftersale_data = [];
            }

            // 进度
            $step_data = OrderAftersaleService::OrderAftersaleStepData($new_aftersale_data);

            // 可退款退货
            $returned = OrderAftersaleService::OrderAftersaleCalculation($order_id, $order_detail_id);

            // 仅退款原因
            $return_only_money_reason = MyC('home_order_aftersale_return_only_money_reason');

            // 退款退货原因
            $return_money_goods_reason = MyC('home_order_aftersale_return_money_goods_reason');

            // 退货地址
            $return_goods_address = OrderAftersaleService::OrderAftersaleReturnGoodsAddress($order_id);

            // 返回数据
            $result = [
                'order_data'                => $ret['data'],
                'new_aftersale_data'        => $new_aftersale_data,
                'step_data'                 => $step_data,
                'returned_data'             => $returned['data'],
                'return_only_money_reason'  => empty($return_only_money_reason) ? [] : explode("\n", $return_only_money_reason),
                'return_money_goods_reason' => empty($return_money_goods_reason) ? [] : explode("\n", $return_money_goods_reason),
                'aftersale_type_list'       => MyConst('common_order_aftersale_type_list'),
                'return_goods_address'      => $return_goods_address,
                'editor_path_type'          => ResourcesService::EditorPathTypeValue(OrderAftersaleService::EditorAttachmentPathType($this->user['id'], $order_id, $order_detail_id)),
            ];
            $ret = SystemBaseService::DataReturn($result);
        } else {
            $ret = DataReturn($ret['msg'], -1);
        }
        return ApiService::ApiDataReturn($ret);
    }

    /**
     * 申请售后创建
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2019-05-23
     * @desc    description
     */
    public function Create()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(OrderAftersaleService::AftersaleCreate($params));
    }

    /**
     * 用户退货
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2019-05-23
     * @desc    description
     */
    public function Delivery()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(OrderAftersaleService::AftersaleDelivery($params));
    }

    /**
     * 订单取消
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-09-30
     * @desc    description
     */
    public function Cancel()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(OrderAftersaleService::AftersaleCancel($params));
    }
}
?>