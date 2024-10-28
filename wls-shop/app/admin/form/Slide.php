<?php
// +----------------------------------------------------------------------
// | ShopXO 国内领先企业级B2C免费开源电商系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2099 http://shopxo.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( https://opensource.org/licenses/mit-license.php )
// +----------------------------------------------------------------------
// | Author: Devil
// +----------------------------------------------------------------------
namespace app\admin\form;

/**
 * 轮播动态表格
 * @author  Devil
 * @blog    http://gong.gg/
 * @version 1.0.0
 * @date    2020-06-18
 * @desc    description
 */
class Slide
{
    // 基础条件
    public $condition_base = [];

    /**
     * 入口
     * @author  Devil
     * @blog    http://gong.gg/
     * @version 1.0.0
     * @date    2020-06-18
     * @desc    description
     * @param   [array]           $params [输入参数]
     */
    public function Run($params = [])
    {
        $lang = MyLang('slide.form_table');
        return [
            // 基础配置
            'base' => [
                'key_field'             => 'id',
                'status_field'          => 'is_enable',
                'is_middle'             => 0,
                'is_search'             => 1,
                'is_delete'             => 1,
                'is_data_export_excel'  => 1,
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
                    'label'          => $lang['describe'],
                    'view_type'      => 'field',
                    'view_key'       => 'describe',
                    'text_truncate'  => 2,
                    'is_popover'     => 1,
                    'is_sort'        => 1,
                    'search_config'  => [
                        'form_type'         => 'input',
                        'where_type'        => 'like',
                    ],
                ],
                [
                    'label'         => $lang['is_enable'],
                    'view_type'     => 'status',
                    'view_key'      => 'is_enable',
                    'post_url'      => MyUrl('admin/slide/statusupdate'),
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
                    'label'         => $lang['images'],
                    'view_type'     => 'module',
                    'view_key'      => 'slide/module/images',
                    'width'         => 160,
                ],
                [
                    'label'         => $lang['event_type'],
                    'view_type'     => 'field',
                    'view_key'      => 'event_type_name',
                    'grid_size'     => 'sm',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'select',
                        'form_name'         => 'event_type',
                        'where_type'        => 'in',
                        'data'              => MyConst('common_app_event_type'),
                        'data_key'          => 'value',
                        'data_name'         => 'name',
                        'is_multiple'       => 1,
                    ],
                ],
                [
                    'label'         => $lang['event_value'],
                    'view_type'     => 'field',
                    'view_key'      => 'event_value',
                    'grid_size'     => 'sm',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'input',
                        'where_type'        => 'like',
                    ],
                ],
                [
                    'label'         => $lang['platform'],
                    'view_type'     => 'field',
                    'view_key'      => 'platform_text',
                    'grid_size'     => 'lg',
                    'search_config' => [
                        'form_type'         => 'select',
                        'form_name'         => 'platform',
                        'where_type'        => 'like',
                        'data'              => MyConst('common_platform_type'),
                        'data_key'          => 'value',
                        'data_name'         => 'name',
                        'is_seat_select'    => 1,
                    ],
                ],
                [
                    'label'         => $lang['sort'],
                    'view_type'     => 'field',
                    'view_key'      => 'sort',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'section',
                    ],
                ],
                [
                    'label'         => $lang['start_time'],
                    'view_type'     => 'field',
                    'view_key'      => 'start_time',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'datetime',
                    ],
                ],
                [
                    'label'         => $lang['end_time'],
                    'view_type'     => 'field',
                    'view_key'      => 'end_time',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'datetime',
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
                    'view_key'      => 'slide/module/operate',
                    'align'         => 'center',
                    'fixed'         => 'right',
                ],
            ],
            // 数据配置
            'data'  => [
                'table_name'            => 'Slide',
                'is_page'               => 1,
                'order_by'              => 'sort asc,id asc',
                'is_handle_time_field'  => 1,
                'is_handle_annex_field' => 1,
                'is_json_data_handle'   => 1,
                'json_config_data'      => [
                    'platform'  => [],
                ],
                'is_fixed_name_field'   => 1,
                'fixed_name_data'       => [
                    'platform'  => [
                        'data'  => MyConst('common_platform_type'),
                        'field' => 'platform_text',
                    ],
                    'event_type'  => [
                        'data'  => MyConst('common_app_event_type'),
                    ],
                ],
            ],
        ];
    }
}
?>