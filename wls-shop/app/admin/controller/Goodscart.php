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
use app\service\GoodsCartService;

/**
 * 商品购物车管理
 * @author  Devil
 *
 * @version 1.0.0
 * @date    2020-06-30
 * @desc    description
 */
class GoodsCart extends Base
{
    /**
     * 列表
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-06-30
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
     * @date    2020-06-30
     * @desc    description
     */
    public function Detail()
    {
        return MyView();
    }

    /**
     * 删除
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-06-30
     * @desc    description
     */
    public function Delete()
    {
        $params = $this->data_request;
        $params['user_type'] = 'admin';
        return ApiService::ApiDataReturn(GoodsCartService::GoodsCartDelete($params));
    }
}
?>