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
use app\service\GoodsCategoryService;
use app\service\GoodsParamsService;

/**
 * 商品参数管理
 * @author  Devil
 *
 * @version 1.0.0
 * @date    2020-11-27
 * @desc    description
 */
class GoodsParamsTemplate extends Base
{
	/**
     * 列表
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-11-27
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
     * @date    2020-11-27
     * @desc    description
     */
    public function Detail()
    {
        // 模板数据
        $assign = [
            // 商品参数类型
            'common_goods_parameters_type_list' =>  MyConst('common_goods_parameters_type_list'),
            // 数据
            'data'                              => $this->data_detail,
            // 参数配置
            'parameters'                        => empty($this->data_detail['config_data']) ? [] : $this->data_detail['config_data'],
        ];
        MyViewAssign($assign);
        return MyView();
    }

    /**
     * 添加/编辑页面
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-11-27
     * @desc    description
     */
    public function SaveInfo()
    {
        // 参数
        $params = $this->data_request;

        // 数据
        $data = $this->data_detail;

        // 模板数据
        $assign = [
            // 商品参数类型
            'common_goods_parameters_type_list' => MyConst('common_goods_parameters_type_list'),
            // 参数配置
            'parameters'                        => empty($data['config_data']) ? [] : $data['config_data'],
            // 商品分类
            'goods_category_list'               => GoodsCategoryService::GoodsCategoryList(['where'=>[['pid', '=', 0]]]),
        ];

        // 编辑页面钩子
        $hook_name = 'plugins_view_admin_goods_params_template_save';
        MyViewAssign($hook_name.'_data', MyEventTrigger($hook_name,
        [
            'hook_name'     => $hook_name,
            'is_backend'    => true,
            'data_id'       => isset($params['id']) ? $params['id'] : 0,
            'data'          => &$data,
            'params'        => &$params,
        ]));

        // 数据/参数
        unset($params['id']);
        $assign['data'] = $data;
        $assign['params'] = $params;

        // 数据赋值
        MyViewAssign($assign);
        return MyView();
    }

	/**
     * 保存
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-11-27
     * @desc    description
     */
	public function Save()
	{
        $params = $this->data_request;
        return ApiService::ApiDataReturn(GoodsParamsService::GoodsParamsTemplateSave($params));
	}

	/**
     * 删除
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-11-27
     * @desc    description
     */
	public function Delete()
	{
        $params = $this->data_request;
        $params['user_type'] = 'admin';
        return ApiService::ApiDataReturn(GoodsParamsService::GoodsParamsTemplateDelete($params));
	}

    /**
     * 状态更新
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-11-27
     * @desc    description
     */
    public function StatusUpdate()
    {
        $params = $this->data_request;
        return ApiService::ApiDataReturn(GoodsParamsService::GoodsParamsTemplateStatusUpdate($params));
    }
}
?>