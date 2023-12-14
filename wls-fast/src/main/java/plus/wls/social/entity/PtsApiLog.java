package plus.wls.social.entity;

import lombok.Data;
import lombok.EqualsAndHashCode;
import lombok.experimental.Accessors;
import plus.wls.framework.aspectj.lang.annotation.Excel;
import plus.wls.framework.web.domain.BaseEntity;

/**
 * pts日志对象 pts_api_log
 *
 * @author wls
 * @date 2023-09-12
 */
@EqualsAndHashCode(callSuper = false)
@Data
@Accessors(chain = true)
public class PtsApiLog extends BaseEntity {
    private static final long serialVersionUID = 1L;
    
    /**
     * 主键、自动增长
     */
    private String id;
    
    /**
     * 请求原始url
     */
    @Excel(name = "请求原始url")
    private String requestUrl;
    
    /**
     * 请求税友url
     */
    @Excel(name = "请求税友url")
    private String requestPtsUrl;
    
    /**
     * 请求方式
     */
    @Excel(name = "请求方式")
    private String requestMethod;
    
    /**
     * 请求方式
     */
    @Excel(name = "请求方式")
    private String requestPtsPath;
    
    /**
     * 请求税友参数
     */
    @Excel(name = "请求税友参数")
    private String requestParam;
    
    /**
     * 请求税友返回结果
     */
    @Excel(name = "请求税友返回结果")
    private String responseBody;
    
    /**
     * 获取反馈requestId
     */
    @Excel(name = "获取反馈requestId")
    private String requestId;
    
    /**
     * 请求税友bizNo
     */
    @Excel(name = "请求税友bizNo")
    private String requestNum;
    
    /**
     * 请求用时
     */
    @Excel(name = "请求用时")
    private String costTime;
    
    /**
     * 请求来源ip
     */
    @Excel(name = "请求来源ip")
    private String requestIp;
    
}
