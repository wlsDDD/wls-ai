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

use think\facade\Db;

/**
 * 商品评论动态表格
 * @author  Devil
 *
 * @version 1.0.0
 * @date    2020-06-08
 * @desc    description
 */
class GoodsComments
{
    // 基础条件
    public $condition_base = [];

    /**
     * 入口
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-06-08
     * @desc    description
     * @param   [array]           $params [输入参数]
     */
    public function Run($params = [])
    {
        $lang = MyLang('goodscomments.form_table');
        return [
            // 基础配置
            'base' => [
                'key_field'     => 'id',
                'status_field'  => 'is_show',
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
                    'label'         => $lang['user'],
                    'view_type'     => 'module',
                    'view_key'      => 'lib/module/user',
                    'grid_size'     => 'sm',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'             => 'input',
                        'form_name'             => 'user_id',
                        'where_type_custom'     => 'in',
                        'where_value_custom'    => 'SystemModuleUserWhereHandle',
                        'placeholder'           => '请输入用户名/昵称/手机/邮箱',
                    ],
                ],
                [
                    'label'         => $lang['goods'],
                    'view_type'     => 'module',
                    'view_key'      => 'goodscomments/module/goods',
                    'grid_size'     => 'lg',
                    'is_sort'       => 1,
                    'sort_field'    => 'goods_id',
                    'search_config' => [
                        'form_type'             => 'input',
                        'form_name'             => 'id',
                        'where_type_custom'     => 'in',
                        'where_value_custom'    => 'WhereGoodsInfo',
                        'placeholder'           => $lang['goods_placeholder'],
                    ],
                ],
                [
                    'label'         => $lang['business_type'],
                    'view_type'     => 'field',
                    'view_key'      => 'business_type',
                    'view_data_key' => 'name',
                    'view_data'     => MyConst('common_goods_comments_business_type_list'),
                    'width'         => 120,
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'select',
                        'where_type'        => 'in',
                        'data'              => MyConst('common_goods_comments_business_type_list'),
                        'data_key'          => 'value',
                        'data_name'         => 'name',
                        'is_multiple'       => 1,
                    ],
                ],
                [
                    'label'         => $lang['content'],
                    'view_type'     => 'module',
                    'view_key'      => 'goodscomments/module/content',
                    'grid_size'     => 'sm',
                    'search_config' => [
                        'form_type'         => 'input',
                        'form_name'         => 'content',
                        'where_type'        => 'like',
                    ],
                ],
                [
                    'label'         => $lang['reply'],
                    'view_type'     => 'module',
                    'view_key'      => 'goodscomments/module/reply',
                    'grid_size'     => 'sm',
                    'search_config' => [
                        'form_type'         => 'input',
                        'form_name'         => 'reply',
                        'where_type'        => 'like',
                    ],
                ],
                [
                    'label'         => $lang['rating'],
                    'view_type'     => 'star',
                    'view_key'      => 'rating',
                    'star_max'      => 5,
                    'color_style'   => 'danger',
                    'star_text_key' => 'rating_text',
                    'width'         => 130,
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'select',
                        'form_name'         => 'rating',
                        'where_type'        => 'in',
                        'data'              => MyConst('common_goods_comments_rating_list'),
                        'data_key'          => 'value',
                        'data_name'         => 'name',
                        'is_multiple'       => 1,
                    ],
                ],
                [
                    'label'         => $lang['images'],
                    'view_type'     => 'many_images',
                    'view_key'      => 'images',
                ],
                [
                    'label'         => $lang['is_show'],
                    'view_type'     => 'status',
                    'view_key'      => 'is_show',
                    'post_url'      => MyUrl('admin/goodscomments/statusupdate'),
                    'is_form_su'    => 1,
                    'align'         => 'center',
                    'width'         => 130,
                    'is_sort'       => 1,
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
                    'label'         => $lang['is_anonymous'],
                    'view_type'     => 'status',
                    'view_key'      => 'is_anonymous',
                    'post_url'      => MyUrl('admin/goodscomments/statusupdate'),
                    'align'         => 'center',
                    'width'         => 130,
                    'is_sort'       => 1,
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
                    'label'         => $lang['is_reply'],
                    'view_type'     => 'status',
                    'view_key'      => 'is_reply',
                    'post_url'      => MyUrl('admin/goodscomments/statusupdate'),
                    'align'         => 'center',
                    'width'         => 130,
                    'is_sort'       => 1,
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
                    'label'         => $lang['reply_time_time'],
                    'view_type'     => 'field',
                    'view_key'      => 'reply_time_time',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'datetime',
                        'form_name'         => 'reply_time',
                    ],
                ],
                [
                    'label'         => $lang['add_time_time'],
                    'view_type'     => 'field',
                    'view_key'      => 'add_time_time',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'datetime',
                        'form_name'         => 'add_time',
                    ],
                ],
                [
                    'label'         => $lang['upd_time_time'],
                    'view_type'     => 'field',
                    'view_key'      => 'upd_time_time',
                    'is_sort'       => 1,
                    'search_config' => [
                        'form_type'         => 'datetime',
                        'form_name'         => 'upd_time',
                    ],
                ],
                [
                    'label'         => MyLang('operate_title'),
                    'view_type'     => 'operate',
                    'view_key'      => 'goodscomments/module/operate',
                    'align'         => 'center',
                    'fixed'         => 'right',
                ],
            ],
            // 数据配置
            'data'  => [
                'table_name'    => 'GoodsComments',
                'data_handle'   => 'GoodsCommentsService::GoodsCommentsListHandle',
                'data_params'   => [
                    'is_public'     => 0,
                    'is_goods'      => 1,
                ],
            ],
        ];
    }

    /**
     * 商品信息条件处理
     * @author  Devil
     *
     * @version 1.0.0
     * @date    2020-06-08
     * @desc    description
     * @param   [string]          $value    [条件值]
     * @param   [array]           $params   [输入参数]
     */
    public function WhereGoodsInfo($value, $params = [])
    {
        if(!empty($value))
        {
            // 获取关联的商品 id
            $ids = Db::name('GoodsComments')->alias('gc')->join('goods g', 'gc.goods_id=g.id')->where('g.title|g.model', 'like', '%'.$value.'%')->column('gc.id');

            // 避免空条件造成无效的错觉
            return empty($ids) ? [0] : $ids;
        }
        return $value;
    }
}
?>