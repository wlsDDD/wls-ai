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

/**
 * 二维码生成控制层
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class QrCode extends Common
{
    /**
     * 二维码显示
     * @author   wls
     *
     * @version  1.0.0
     * @datetime 2019-04-16T21:52:09+0800
     */
    public function Index()
    {
        if(empty($this->data_request['content']))
        {
            MyViewAssign('msg', MyLang('content_params_empty_tips'));
            return MyView('public/tips_error');
        }
        (new \base\Qrcode())->View($this->data_request);
    }

    /**
     * 二维码下载
     * @author   wls
     *
     * @version  1.0.0
     * @datetime 2019-04-16T21:52:18+0800
     */
    public function Download()
    {
        $ret = (new \base\Qrcode())->Download($this->data_request);
        if(!empty($ret) && isset($ret['code']) && $ret['code'] != 0)
        {
            MyViewAssign('msg', $ret['msg']);
            return MyView('public/tips_error');
        }
    }
}
?>