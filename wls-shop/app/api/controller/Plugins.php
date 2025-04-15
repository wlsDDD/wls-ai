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
use app\service\PluginsService;

/**
 * 应用调用入口
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Plugins extends Common
{
    /**
     * 构造方法
     * @author   wls
     *
     * @version 1.0.0
     * @date    2020-01-02
     * @desc    description
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 首页
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-01-02
     * @desc    description
     */
    public function Index()
    {
        // 参数
        $params = $this->GetClassVars();

        // 请求参数校验
        $p = [
            [
                'checked_type'      => 'empty',
                'key_name'          => 'pluginsname',
                'error_msg'         => MyLang('plugins_name_tips'),
            ],
            [
                'checked_type'      => 'empty',
                'key_name'          => 'pluginscontrol',
                'error_msg'         => MyLang('plugins_control_tips'),
            ],
            [
                'checked_type'      => 'empty',
                'key_name'          => 'pluginsaction',
                'error_msg'         => MyLang('plugins_action_tips'),
            ],
        ];
        $ret = ParamsChecked($params['data_request'], $p);
        if($ret === true)
        {
            // 应用名称/控制器/方法
            $pluginsname = $params['data_request']['pluginsname'];
            $pluginscontrol = strtolower($params['data_request']['pluginscontrol']);
            $pluginsaction = strtolower($params['data_request']['pluginsaction']);

            // 调用
            $ret = PluginsService::PluginsControlCall($pluginsname, $pluginscontrol, $pluginsaction, 'api', $params);
            if($ret['code'] == 0)
            {
                $ret = $ret['data'];
            }
        } else {
            $ret = DataReturn($ret, -5000);
        }
        return ApiService::ApiDataReturn($ret);
    }

    /**
     * 获取类属性数据
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-06-07
     * @desc    description
     */
    public function GetClassVars()
    {
        $data = [];
        $vers = get_class_vars(get_class($this));
        foreach($vers as $k=>$v)
        {
            if(property_exists($this, $k))
            {
                $data[$k] = $this->$k;
            }
        }
        return $data;
    }
}
?>