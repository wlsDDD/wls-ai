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
use app\service\ResourcesService;
use app\service\BrandCategoryService;

/**
 * 品牌分类管理
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class BrandCategory extends Base
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
		// 模板数据
		$assign = [
	        // 编辑器文件存放地址
			'editor_path_type'	=> ResourcesService::EditorPathTypeValue('brand_category'),
		];
		MyViewAssign($assign);
		return MyView();
	}

	/**
	 * 获取节点子列表
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2016-12-25T15:19:45+0800
	 */
	public function GetNodeSon()
	{
		return ApiService::ApiDataReturn(BrandCategoryService::BrandCategoryNodeSon($this->data_request));
	}

	/**
	 * 保存
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2016-12-25T22:36:12+0800
	 */
	public function Save()
	{
		return ApiService::ApiDataReturn(BrandCategoryService::BrandCategorySave($this->data_request));
	}

	/**
	 * 删除
	 * @author   wls
	 *
	 * @version  0.0.1
	 * @datetime 2016-12-25T22:36:12+0800
	 */
	public function Delete()
	{
		$params = $this->data_request;
		$params['admin'] = $this->admin;
		return ApiService::ApiDataReturn(BrandCategoryService::BrandCategoryDelete($params));
	}
}
?>