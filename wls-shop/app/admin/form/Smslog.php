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

/**
 * 短信日志动态表格
 * @author  Devil
 *
 * @version 1.0.0
 * @date    2020-06-26
 * @desc    description
 */
class SmsLog
{
    // 基础条件
    public $condition_base = [];

    /**
     * 入口
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-06-26
     * @desc    description
     * @param   [array]           $params [输入参数]
     */
    public function Run($params = [])
    {
        $lang = MyLang('smslog.form_table');
        return [
            // 基础配置
            'base' => [
                'key_field'     => 'id',
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
                    'label'         => $lang['platform'],
                    'view_type'     => 'field',
                    'view_key'      => 'platform_name',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'select',
                        'form_name'         => 'platform',
                        'where_type'        => 'in',
                        'data'              => MyConst('common_sms_log_platform_list'),
                        'data_key'          => 'value',
                        'data_name'         => 'name',
                        'is_multiple'       => 1,
                    ],
                ],
                [
                    'label'              => $lang['status'],
                    'view_type'          => 'field',
                    'view_key'           => 'status_name',
                    'is_round_point'     => 1,
                    'round_point_key'    => 'status',
                    'round_point_style'  => [1=>'success', 2=>'danger'],
                    'is_sort'            => 1,
                    'search_config'      => [
                        'form_type'         => 'select',
                        'form_name'         => 'status',
                        'where_type'        => 'in',
                        'data'              => MyConst('common_sms_log_status_list'),
                        'data_key'          => 'value',
                        'data_name'         => 'name',
                        'is_multiple'       => 1,
                    ],
                ],
                [
                    'label'         => $lang['mobile'],
                    'view_type'     => 'field',
                    'view_key'      => 'mobile',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'input',
                        'where_type'        => 'like',
                    ],
                ],
                [
                    'label'         => $lang['template_value'],
                    'view_type'     => 'field',
                    'view_type'     => 'module',
                    'view_key'      => 'smslog/module/template_value',
                    'align'         => 'left',
                    'grid_size'     => 'sm',
                    'search_config' => [
                        'form_type'         => 'input',
                        'form_name'         => 'template_value',
                        'where_type'        => 'like',
                    ],
                ],
                [
                    'label'         => $lang['template_var'],
                    'view_type'     => 'field',
                    'view_type'     => 'module',
                    'view_key'      => 'smslog/module/template_var',
                    'align'         => 'left',
                    'grid_size'     => 'sm',
                    'search_config' => [
                        'form_type'         => 'input',
                        'form_name'         => 'template_var',
                        'where_type'        => 'like',
                    ],
                ],
                [
                    'label'         => $lang['sign_name'],
                    'view_type'     => 'field',
                    'view_key'      => 'sign_name',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'input',
                    ],
                ],
                [
                    'label'         => $lang['request_url'],
                    'view_type'     => 'field',
                    'view_key'      => 'request_url',
                    'is_sort'       => 1,
                    'grid_size'     => 'lg',
                    'search_config' => [
                        'form_type'         => 'input',
                        'where_type'        => 'like',
                    ],
                ],
                [
                    'label'         => $lang['request_params'],
                    'view_type'     => 'field',
                    'view_type'     => 'module',
                    'view_key'      => 'smslog/module/request_params',
                    'align'         => 'left',
                    'grid_size'     => 'sm',
                    'search_config' => [
                        'form_type'         => 'input',
                        'form_name'         => 'request_params',
                        'where_type'        => 'like',
                    ],
                ],
                [
                    'label'         => $lang['response_data'],
                    'view_type'     => 'field',
                    'view_type'     => 'module',
                    'view_key'      => 'smslog/module/response_data',
                    'align'         => 'left',
                    'grid_size'     => 'sm',
                    'search_config' => [
                        'form_type'         => 'input',
                        'form_name'         => 'response_data',
                        'where_type'        => 'like',
                    ],
                ],
                [
                    'label'         => $lang['reason'],
                    'view_type'     => 'field',
                    'view_key'      => 'reason',
                    'text_truncate' => 2,
                    'is_popover'    => 1,
                    'is_sort'       => 1,
                    'grid_size'     => 'sm',
                    'search_config' => [
                        'form_type'         => 'input',
                        'where_type'        => 'like',
                    ],
                ],
                [
                    'label'         => $lang['tsc'],
                    'view_type'     => 'field',
                    'view_key'      => 'tsc',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'section',
                        'is_point'          => 1,
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
                    'view_key'      => 'smslog/module/operate',
                    'align'         => 'center',
                    'fixed'         => 'right',
                    'width'         => 120,
                ],
            ],
            // 数据配置
            'data'  => [
                'table_name'            => 'SmsLog',
                'is_page'               => 1,
                'is_handle_time_field'  => 1,
                'is_fixed_name_field'   => 1,
                'fixed_name_data'       => [
                    'platform'  => [
                        'data'  => MyConst('common_sms_log_platform_list'),
                    ],
                    'status'  => [
                        'data'  => MyConst('common_sms_log_status_list'),
                    ],
                ],
            ],
        ];
    }
}
?>