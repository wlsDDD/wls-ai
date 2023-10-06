package plus.wls.common.enums;


import java.util.HashMap;
import java.util.Map;

/**
 * 请求方式
 *
 * @author wls
 */
public enum HttpMethod {
    GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS, TRACE;
    
    private static final Map<String, HttpMethod> mappings = new HashMap<>(16);
    
    static {
        for (HttpMethod httpMethod : values()) {
            mappings.put(httpMethod.name(), httpMethod);
        }
    }
    
    public boolean matches(String method) {
        return (this == resolve(method));
    }
    
    public static HttpMethod resolve(String method) {
        return (method != null ? mappings.get(method) : null);
    }
}
