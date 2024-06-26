package plus.wls.common.core.enums;


import lombok.Getter;

import java.util.Arrays;

/**
 * 返回状态枚举
 * 2000-请求成功
 * <p>
 * 3000-请求失败-参数
 * <p>
 * 4000-请求失败-业务
 * <p>
 * 5000-请求失败-内部-代码
 * 5100-请求失败-内部-数据库
 * 5200-请求失败-内部-缓存
 * 5300-请求失败-内部-文件
 * 5400-请求失败-内部-IO
 * 5410-请求失败-内部-IO-ES
 * <p>
 * 6000-请求失败-外部
 *
 * @author wls
 * @since 2021/01/13
 */
@Getter
public enum CodeInfoEnum {
    
    /**
     * 成功
     */
    SUCCESS(2000, "SUCCESS"),
    /**
     * 参数
     */
    ARG_ERROR(3000, "统一验证参数不合法, 请检查参数后重试! 以下信息仅供参考"),
    ARG_REQUIRED_ERROR(3000, "缺少必填参数"),
    SIGNATURE_ERROR(3001, "签名验证不通过, 请排查后重试!"),
    /**
     * 业务类异常，提示信息由抛异常时定义
     */
    BUSINESS_ERROR(4000, ""),
    /**
     * 项目启动时根据环境设置提示信息
     * 最终兜底方案
     * 其他状态码应避开此状态码
     */
    UNKNOWN_ERROR(5000, ""),
    UNKNOWN_GATEWAY_ERROR(5001, "网关服务出现了未知异常 给您带来了不便敬请谅解 "),
    GATEWAY_HEADER_NOT_FOUND_ERROR(5002, "请求头缺失! "),
    GATEWAY_SERVER_NOT_FOUND_ERROR(5004, "网关未找到服务! "),
    ES_SERVER_IO_ERROR(5410, "ES IO 异常! "),
    /**
     * 数据库
     */
    DATA_INSERT_ERROR(5101, "新增数据失败，请联系数据库管理员"),
    DATA_UPDATE_ERROR(5102, "修改数据失败，请联系数据库管理员"),
    DATA_DELETE_ERROR(5103, "删除数据失败，请联系数据库管理员"),
    ;
    
    private final Integer code;
    private String info;
    
    CodeInfoEnum(Integer code, String info) {
        this.code = code;
        this.info = info;
    }
    
    public CodeInfoEnum setInfo(Object... info) {
        this.info = this.info + Arrays.asList(info);
        return this;
    }
    
}
