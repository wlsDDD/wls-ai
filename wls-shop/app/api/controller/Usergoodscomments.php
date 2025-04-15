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
use app\service\GoodsCommentsService;

/**
 * 用户商品评论
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class UserGoodsComments extends Common
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
     * 列表
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2017-02-22T16:50:32+0800
     */
    public function Index()
    {
        // 参数
        $params = $this->data_request;
        $params['user'] = $this->user;

        // 条件
        $where = GoodsCommentsService::UserGoodsCommentsListWhere($params);

        // 获取总数
        $total = GoodsCommentsService::GoodsCommentsTotal($where);
        $page_total = ceil($total/$this->page_size);
        $start = intval(($this->page-1)*$this->page_size);

        // 获取列表
        $data_params = [
            'm'         => $start,
            'n'         => $this->page_size,
            'where'     => $where,
            'is_goods'  => 1,
        ];
        $ret = GoodsCommentsService::GoodsCommentsList($data_params);

        // 返回数据
        $result = [
            'total'         => $total,
            'page_total'    => $page_total,
            'data'          => $ret['data'],
        ];
        return ApiService::ApiDataReturn(SystemBaseService::DataReturn($result));
    }

    /**
     * 详情
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2017-02-22T16:50:32+0800
     */
    public function Detail()
    {
        $data = null;
        if(!empty($this->data_request['id']))
        {
            $data_params = [
                'm'         => 0,
                'n'         => 1,
                'where'     => [
                    ['id', '=', intval($this->data_request['id'])],
                    ['user_id', '=', $this->user['id']],
                ],
                'is_goods'  => 1,
            ];
            $ret = GoodsCommentsService::GoodsCommentsList($data_params);
            if(!empty($ret['data']) && !empty($ret['data'][0]))
            {
                $data = $ret['data'][0];
            }
        }
        return ApiService::ApiDataReturn(SystemBaseService::DataReturn($data));
    }

    /**
     * 保存
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2018-07-17
     * @desc    description
     */
    public function Save()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(GoodsCommentsService::GoodsCommentsSave($params));
    }

    /**
     * 删除
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2018-07-17
     * @desc    description
     */
    public function Delete()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(GoodsCommentsService::GoodsCommentsDelete($params));
    }
}
?>