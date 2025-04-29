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
namespace app\index\controller;

use app\service\ApiService;
use app\service\SeoService;
use app\service\GoodsCartService;

/**
 * 购物车
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Cart extends Common
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
        IsUserLogin();
    }
    
    /**
     * 首页
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2017-02-22T16:50:32+0800
     */
    public function Index()
    {
        // 购物车列表
        $cart_list = GoodsCartService::GoodsCartList(['user'=>$this->user]);

        // 基础信息
        $base = [
            'total_price'   => empty($cart_list['data']) ? 0 : array_sum(array_column($cart_list['data'], 'total_price')),
            'buy_count'     => empty($cart_list['data']) ? 0 : array_sum(array_column($cart_list['data'], 'stock')),
        ];

        // 数据赋值
        $assign = [
            'base'                  => $base,
            'cart_list'             => $cart_list['data'],
            'home_seo_site_title'   => SeoService::BrowserSeoTitle(MyLang('cart.base_nav_title'), 1),
        ];
        MyViewAssign($assign);
        return MyView();
    }

    /**
     * 购物车保存
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-09-13
     * @desc    description
     */
    public function Save()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(GoodsCartService::GoodsCartSave($params));
    }

    /**
     * 购物车删除
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-09-14
     * @desc    description
     */
    public function Delete()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(GoodsCartService::GoodsCartDelete($params));
    }

    /**
     * 数量保存
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-09-14
     * @desc    description
     */
    public function Stock()
    {
        $params = $this->data_request;
        $params['user'] = $this->user;
        return ApiService::ApiDataReturn(GoodsCartService::GoodsCartStock($params));
    }
}
?>