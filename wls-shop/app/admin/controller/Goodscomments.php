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
use app\service\GoodsCommentsService;

/**
 * 商品评论管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class GoodsComments extends Base
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
        // 模板数据
        $assign = [
            // 当前数据
            'data'                                      => $this->data_detail,
            // 静态数据
            'common_is_show_list'                       => MyConst('common_is_show_list'),
            'common_is_text_list'                       => MyConst('common_is_text_list'),
            'common_goods_comments_rating_list'         => MyConst('common_goods_comments_rating_list'),
            'common_goods_comments_business_type_list'  => MyConst('common_goods_comments_business_type_list'),
        ];
   
        // 参数
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
        $params['user_type'] = 'admin';
        return ApiService::ApiDataReturn(GoodsCommentsService::GoodsCommentsSave($params));
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
        return ApiService::ApiDataReturn(GoodsCommentsService::GoodsCommentsDelete($params));
    }

    /**
     * 回复
     * @author   wls
     *
     * @version  1.0.0
     * @datetime 2018-03-28T15:07:17+0800
     */
    public function Reply()
    {
        $params = $this->data_request;
        $params['user_type'] = 'admin';
        return ApiService::ApiDataReturn(GoodsCommentsService::GoodsCommentsReply($params));
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
        $params['user_type'] = 'admin';
        return ApiService::ApiDataReturn(GoodsCommentsService::GoodsCommentsStatusUpdate($params));
    }
}
?>