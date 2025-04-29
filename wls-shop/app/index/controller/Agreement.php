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

use app\service\SeoService;
use app\service\AgreementService;

/**
 * 协议
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Agreement extends Common
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
    }

    /**
     * 详情
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2019-05-16
     * @desc    description
     */
    public function Index()
    {
        // 是否仅展示内容
        $is_content = (isset($this->data_request['is_content']) && $this->data_request['is_content'] == 1) ? 0 : 1;
        // 模板数据
        $assign = [
            'is_header' => $is_content,
            'is_footer' => $is_content,
            'data'      => null,
        ];

        // 获取协议内容
        if(!empty($this->data_request['document']))
        {
            // 获取协议内容
            $ret = AgreementService::AgreementData($this->data_request);

            // 浏览器标题
            if(!empty($ret['data']))
            {
                if(!empty($ret['data']['name']))
                {
                    $assign['home_seo_site_title'] = SeoService::BrowserSeoTitle($ret['data']['name']);
                }
                $assign['data'] = $ret['data'];
            }
        }

        // 数据赋值
        MyViewAssign($assign);
        return MyView();
    }
}
?>