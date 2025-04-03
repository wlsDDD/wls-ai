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
use app\service\ArticleService;
use app\service\ArticleCategoryService;
use app\service\ResourcesService;

/**
 * 文章管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Article extends Base
{
	/**
     * 列表
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2016-12-06T21:31:53+0800
     */
	public function Index()
	{
        return MyView();
	}

    /**
     * 详情
     * @author   wls
     *
     * @version  1.0.0
     * @datetime 2019-08-05T08:21:54+0800
     */
    public function Detail()
    {
        return MyView();
    }

	/**
	 * 添加/编辑页面
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2016-12-14T21:37:02+0800
	 */
	public function SaveInfo()
	{
		// 模板数据
		$assign = [
			// 编辑器文件存放地址
			'editor_path_type'	=> ResourcesService::EditorPathTypeValue('article'),
		];

		// 文章分类
        $article_category = ArticleCategoryService::ArticleCategoryList(['field'=>'id,name']);
        $assign['article_category_list'] = $article_category['data'];

        // 参数
        $params = $this->data_request;

        // 数据
        $data = $this->data_detail;

        // 文章编辑页面钩子
        $hook_name = 'plugins_view_admin_article_save';
        $assign[$hook_name.'_data'] = MyEventTrigger($hook_name,
        [
            'hook_name'     => $hook_name,
            'is_backend'    => true,
            'article_id'    => isset($params['id']) ? $params['id'] : 0,
            'data'          => &$data,
            'params'        => &$params,
        ]);

        // 数据/参数
        unset($params['id']);
        $assign['data'] = $data;
        $assign['params'] = $params;

        // 模板赋值
		MyViewAssign($assign);
        return MyView();
	}

	/**
	 * 添加/编辑
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2016-12-14T21:37:02+0800
	 */
	public function Save()
	{
        $params = $this->data_request;
        return ApiService::ApiDataReturn(ArticleService::ArticleSave($params));
	}

	/**
	 * 删除
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2016-12-15T11:03:30+0800
	 */
	public function Delete()
	{
        $params = $this->data_request;
        $params['admin'] = $this->admin;
        return ApiService::ApiDataReturn(ArticleService::ArticleDelete($params));
	}

	/**
	 * 状态更新
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2017-01-12T22:23:06+0800
	 */
	public function StatusUpdate()
	{
        $params = $this->data_request;
        $params['admin'] = $this->admin;
        return ApiService::ApiDataReturn(ArticleService::ArticleStatusUpdate($params));
	}
}
?>