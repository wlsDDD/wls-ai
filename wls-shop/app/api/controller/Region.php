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
use app\service\RegionService;

/**
 * 地区
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Region extends Common
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
    }

    /**
     * 获取地区节点
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-12-29
     * @desc    description
     */
    public function Index()
    {
        // 获取地区
        $pid = empty($this->data_request['pid']) ? 0 : intval($this->data_request['pid']);
        $params = [
            'where' => [
                ['pid', '=', $pid],
            ],
        ];
        $result = RegionService::RegionNode($params);
        return ApiService::ApiDataReturn(SystemBaseService::DataReturn($result));
    }

    /**
     * 获取地区所有数据
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-12-29
     * @desc    description
     */
    public function All()
    {
        return ApiService::ApiDataReturn(RegionService::RegionAll());
    }

    /**
     * 获取地区编号数据
     * @author   wls
     *
     * @version 1.0.0
     * @date    2018-09-21
     * @desc    description
     */
    public function CodeData()
    {
        return ApiService::ApiDataReturn(RegionService::RegionCodeData($this->data_request));
    }
}
?>