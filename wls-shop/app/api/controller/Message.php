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
use app\service\SystemBaseService;
use app\service\MessageService;

/**
 * 消息
 * @author   wls
 *
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Message extends Common
{
    /**
     * 构造方法
     * @author   wls
     *
     * @version  0.0.1
     * @datetime 2016-12-03T12:39:08+0800
     */
    public function __construct()
    {
        // 调用父类前置方法
        parent::__construct();

        // 是否登录
        $this->IsLogin();
    }

    /**
     * [Index 获取记录]
     * @author   wls
     *
     * @version  1.0.0
     * @datetime 2018-04-08T15:08:01+0800
     */
    public function Index()
    {
        // 参数
        $params = $this->data_request;
        $params['user'] = $this->user;

        // 消息更新未已读
        MessageService::MessageRead($params);

        // 条件
        $where = MessageService::MessageListWhere($params);

        // 获取总数
        $total = MessageService::MessageTotal($where);
        $page_total = ceil($total/$this->page_size);
        $start = intval(($this->page-1)*$this->page_size);

        // 获取列表
        $data_params = [
            'm'         => $start,
            'n'         => $this->page_size,
            'where'     => $where,
        ];
        $data = MessageService::MessageList($data_params);
        
        // 返回数据
        $result = [
            'total'         => $total,
            'page_total'    => $page_total,
            'data'          => $data['data'],
        ];
        return ApiService::ApiDataReturn(SystemBaseService::DataReturn($result));
    }
}
?>