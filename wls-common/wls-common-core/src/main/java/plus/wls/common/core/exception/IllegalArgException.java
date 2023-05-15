package plus.wls.common.core.exception;

import plus.wls.common.core.enums.CodeInfoEnum;

/**
 * 非法请求异常
 *
 * @author wls
 * @since 2021/10/03 21:01:37
 */
public class IllegalArgException extends BaseRunTimeException {
    private static final long serialVersionUID = 1L;
    
    /**
     * 基本运行时异常
     * 构造方法-带code
     *
     * @param codeInfoEnum 返回状态枚举
     * @param params       参数个数
     */
    public IllegalArgException(CodeInfoEnum codeInfoEnum, Object... params) {
        super(codeInfoEnum, params);
    }
    
    public IllegalArgException() {
        super();
    }
    
    public IllegalArgException(String message) {
        super(message);
    }
    
    public IllegalArgException(String message, Throwable cause) {
        super(message, cause);
    }
    
    public IllegalArgException(Throwable cause) {
        super(cause);
    }
    
    protected IllegalArgException(String message, Throwable cause, boolean enableSuppression, boolean writableStackTrace) {
        super(message, cause, enableSuppression, writableStackTrace);
    }
    
}
