package plus.wls.framework.web.controller;

import com.github.pagehelper.PageHelper;
import com.github.pagehelper.PageInfo;
import plus.wls.common.constant.HttpStatus;
import plus.wls.common.utils.DateUtils;
import plus.wls.common.utils.PageUtils;
import plus.wls.common.utils.SecurityUtils;
import plus.wls.common.utils.StringUtils;
import plus.wls.common.utils.sql.SqlUtil;
import plus.wls.framework.security.LoginUser;
import plus.wls.framework.web.domain.Result;
import plus.wls.framework.web.page.PageDomain;
import plus.wls.framework.web.page.TableDataInfo;
import plus.wls.framework.web.page.TableSupport;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.web.bind.WebDataBinder;
import org.springframework.web.bind.annotation.InitBinder;

import java.beans.PropertyEditorSupport;
import java.util.Date;
import java.util.List;

/**
 * web层通用数据处理
 *
 * @author wls
 */
public class BaseController {
    protected final Logger logger = LoggerFactory.getLogger(this.getClass());
    
    /**
     * 将前台传递过来的日期格式的字符串，自动转化为Date类型
     */
    @InitBinder
    public void initBinder(WebDataBinder binder) {
        // Date 类型转换
        binder.registerCustomEditor(Date.class, new PropertyEditorSupport() {
            @Override
            public void setAsText(String text) {
                setValue(DateUtils.parseDate(text));
            }
        });
    }
    
    /**
     * 返回成功消息
     */
    public Result success(String message) {
        return Result.success(message);
    }
    
    /**
     * 返回成功消息
     */
    public Result success(Object data) {
        return Result.success(data);
    }
    
    /**
     * 返回失败消息
     */
    public Result error(String message) {
        return Result.error(message);
    }
    
    /**
     * 返回警告消息
     */
    public Result warn(String message) {
        return Result.warn(message);
    }
    
    /**
     * 获取登录用户id
     */
    public Long getUserId() {
        return getLoginUser().getUserId();
    }
    
    /**
     * 获取用户缓存信息
     */
    public LoginUser getLoginUser() {
        return SecurityUtils.getLoginUser();
    }
    
    /**
     * 获取登录部门id
     */
    public Long getDeptId() {
        return getLoginUser().getDeptId();
    }
    
    /**
     * 获取登录用户名
     */
    public String getUsername() {
        return getLoginUser().getUsername();
    }
    
    /**
     * 设置请求分页数据
     */
    protected void startPage() {
        PageUtils.startPage();
    }
    
    /**
     * 设置请求排序数据
     */
    protected void startOrderBy() {
        PageDomain pageDomain = TableSupport.buildPageRequest();
        if (StringUtils.isNotEmpty(pageDomain.getOrderBy())) {
            String orderBy = SqlUtil.escapeOrderBySql(pageDomain.getOrderBy());
            PageHelper.orderBy(orderBy);
        }
    }
    
    /**
     * 清理分页的线程变量
     */
    protected void clearPage() {
        PageUtils.clearPage();
    }
    
    /**
     * 响应请求分页数据
     */
    @SuppressWarnings({"rawtypes", "unchecked"})
    protected TableDataInfo getDataTable(List<?> list) {
        TableDataInfo rspData = new TableDataInfo();
        rspData.setCode(HttpStatus.SUCCESS);
        rspData.setMsg("查询成功");
        rspData.setRows(list);
        rspData.setTotal(new PageInfo(list).getTotal());
        return rspData;
    }
    
    /**
     * 响应返回结果
     *
     * @param rows 影响行数
     *
     * @return 操作结果
     */
    protected Result toAjax(int rows) {
        return rows > 0 ? Result.success() : Result.error();
    }
    
    /**
     * 响应返回结果
     *
     * @param result 结果
     *
     * @return 操作结果
     */
    protected Result toAjax(boolean result) {
        return result ? success() : error();
    }
    
    /**
     * 返回成功
     */
    public Result success() {
        return Result.success();
    }
    
    /**
     * 返回失败消息
     */
    public Result error() {
        return Result.error();
    }
    
}
