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
namespace app\admin\form;

use app\service\GoodsCategoryService;

/**
 * 商品规格动态表格
 * @author  Devil
 *
 * @version 1.0.0
 * @date    2020-06-19
 * @desc    description
 */
class GoodsSpecTemplate
{
    // 基础条件
    public $condition_base = [];

    // 商品分类
    public $goods_category_list;

    /**
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-06-29
     * @desc    description
     * @param   [array]           $params [输入参数]
     */
    public function __construct($params = [])
    {
        // 商品分类
        $res = GoodsCategoryService::GoodsCategoryList(['where'=>[['pid', '=', 0]]]);
        $this->goods_category_list = empty($res) ? [] : array_column($res, 'name', 'id');
    }

    /**
     * 入口
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-06-18
     * @desc    description
     * @param   [array]           $params [输入参数]
     */
    public function Run($params = [])
    {
        $lang = MyLang('goodsspectemplate.form_table');
        return [
            // 基础配置
            'base' => [
                'key_field'     => 'id',
                'status_field'  => 'is_enable',
                'is_search'     => 1,
                'is_delete'     => 1,
                'is_middle'     => 0,
            ],
            // 表单配置
            'form' => [
                [
                    'view_type'         => 'checkbox',
                    'is_checked'        => 0,
                    'checked_text'      => MyLang('reverse_select_title'),
                    'not_checked_text'  => MyLang('select_all_title'),
                    'align'             => 'center',
                    'width'             => 80,
                ],
                [
                    'label'         => $lang['category_id'],
                    'view_type'     => 'field',
                    'view_key'      => 'category_id',
                    'view_data'     => $this->goods_category_list,
                    'width'         => 150,
                    'search_config' => [
                        'form_type'             => 'select',
                        'where_type'            => 'in',
                        'data'                  => $this->goods_category_list,
                        'is_multiple'           => 1,
                    ],
                ],
                [
                    'label'         => $lang['name'],
                    'view_type'     => 'field',
                    'view_key'      => 'name',
                    'is_sort'       => 1,
                    'width'         => 150,
                    'search_config' => [
                        'form_type'         => 'input',
                        'where_type'        => 'like',
                    ],
                ],
                [
                    'label'         => $lang['is_enable'],
                    'view_type'     => 'status',
                    'view_key'      => 'is_enable',
                    'post_url'      => MyUrl('admin/goodsspectemplate/statusupdate'),
                    'is_form_su'    => 1,
                    'align'         => 'center',
                    'is_sort'       => 1,
                    'width'         => 130,
                    'search_config' => [
                        'form_type'         => 'select',
                        'where_type'        => 'in',
                        'data'              => MyConst('common_is_text_list'),
                        'data_key'          => 'id',
                        'data_name'         => 'name',
                        'is_multiple'       => 1,
                    ],
                ],
                [
                    'label'         => $lang['content'],
                    'view_type'     => 'field',
                    'view_key'      => 'content',
                    'grid_size'     => 'sm',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'input',
                        'where_type'        => 'like',
                    ],
                ],
                [
                    'label'         => $lang['add_time'],
                    'view_type'     => 'field',
                    'view_key'      => 'add_time',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'datetime',
                    ],
                ],
                [
                    'label'         => $lang['upd_time'],
                    'view_type'     => 'field',
                    'view_key'      => 'upd_time',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'datetime',
                    ],
                ],
                [
                    'label'         => MyLang('operate_title'),
                    'view_type'     => 'operate',
                    'view_key'      => 'goodsspectemplate/module/operate',
                    'align'         => 'center',
                    'fixed'         => 'right',
                ],
            ],
            // 数据配置
            'data'  => [
                'table_name'    => 'GoodsSpecTemplate',
                'data_handle'   => 'GoodsSpecService::GoodsSpecTemplateListHandle',
                'data_params'   => [
                    'is_public'     => 0,
                    'user_type'     => 'admin',
                ],
            ],
        ];
    }
}
?>