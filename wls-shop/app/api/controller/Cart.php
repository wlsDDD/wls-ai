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
     * 首页
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2017-02-22T16:50:32+0800
     */
    public function Index()
    {
        // 汇总
        $result = GoodsCartService::UserGoodsCartTotal(['user'=>$this->user]);

        // 列表
        $list = GoodsCartService::GoodsCartList(['user'=>$this->user]);
        $result['data'] = $list['data'];
        return ApiService::ApiDataReturn(SystemBaseService::DataReturn($result));
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