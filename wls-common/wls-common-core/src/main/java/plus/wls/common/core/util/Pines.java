package plus.wls.common.core.util;

import cn.hutool.core.bean.BeanUtil;
import cn.hutool.core.collection.CollUtil;
import cn.hutool.core.util.ObjUtil;
import cn.hutool.core.util.ReflectUtil;
import cn.hutool.core.util.StrUtil;
import lombok.extern.slf4j.Slf4j;
import plus.wls.common.core.enums.CodeInfoEnum;
import plus.wls.common.core.exception.IllegalArgException;
import plus.wls.common.core.exception.RequestHeaderException;
import plus.wls.common.core.function.FunctionSerializable;

import java.lang.annotation.Annotation;
import java.util.*;
import java.util.function.Supplier;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.util.stream.Collectors;

/**
 * 核心工具类
 *
 * @author wls
 * @since 2021/09/20 23:41:45
 */
@Slf4j
public class Pines {
    
    
    public static final String LOWER = "abcdefghijklmnopqrstuvwxyz";
    public static final String UPPER = LOWER.toUpperCase();
    
    
    /**
     * 代码执行异常时返回默认值
     *
     * @param function   函数
     * @param defaultVal 默认值
     *
     * @return {@link T }
     *
     * @author wls
     * @date 2022-06-09 16:12:07
     * @since 1.0.0
     */
    public static <T> T exceptionOfDefault(Supplier<T> function, T defaultVal) {
        try {
            return function.get();
        } catch (Exception e) {
            log.warn("方法执行异常", e);
            return defaultVal;
        }
    }
    
    /**
     * sql填补
     *
     * @param sql   sql
     * @param param 参数
     *
     * @return {@link String}
     */
    public static String sqlFill(String sql, String param) {
        Object[] params = Arrays.stream(param.split(",")).map(s -> StrUtil.subBefore(s, "(", false)).toArray();
        return StrUtil.format(sql.replace("?", "{}"), params);
    }
    
    /**
     * 必要字段验证
     *
     * @param obj  被验证对象
     * @param func 字段函数
     */
    @SafeVarargs
    public static <T> void requiredField(T obj, FunctionSerializable<T, ?>... func) {
        requiredField(obj, LamUtil.fieldNames(func));
    }
    
    /**
     * 必要字段验证
     *
     * @param obj    被验证对象
     * @param fields 需要必填字段
     */
    public static void requiredField(Object obj, String... fields) {
        List<String> errors = new LinkedList<>();
        for (String field : fields) {
            Object value = BeanUtil.getFieldValue(obj, field);
            if (ObjUtil.isEmpty(value)) {
                errors.add(field);
            }
        }
        if (CollUtil.isNotEmpty(errors)) {
            throw new IllegalArgException(CodeInfoEnum.ARG_REQUIRED_ERROR, errors.toArray());
        }
    }
    
    /**
     * 自定义进制转换
     *
     * @param seq    对应规则的值
     * @param rexStr 规则
     *
     * @return {@link String}
     */
    public static String toSeq(Integer seq, String rexStr) {
        int flag = seq;
        StringBuilder result = new StringBuilder();
        while (true) {
            result.insert(0, rexStr.charAt(seq % rexStr.length()));
            seq = seq / rexStr.length();
            if (seq / rexStr.length() == 0) {
                return flag < rexStr.length() ? result.toString() : rexStr.charAt(seq - 1) + result.toString();
            }
        }
    }
    
    /**
     * 在map中获取指定key 获取不到抛出异常
     *
     * @param map 地图
     * @param key 关键
     *
     * @return {@link V}
     */
    public static <K, V> V getOrException(Map<K, V> map, K key) {
        return Optional.ofNullable(map.get(key)).orElseThrow(() -> new RequestHeaderException(CodeInfoEnum.GATEWAY_HEADER_NOT_FOUND_ERROR));
    }
    
    /**
     * 在map中获取指定key 获取不到抛出异常
     *
     * @param map  地图
     * @param func 函数
     *
     * @return {@link V}
     */
    public static <V, T, R> V getOrException(Map<String, V> map, FunctionSerializable<T, R> func) {
        return Optional.ofNullable(map.get(LamUtil.fieldName(func)))
                       .orElseThrow(() -> new RequestHeaderException(CodeInfoEnum.GATEWAY_HEADER_NOT_FOUND_ERROR));
    }
    
    /**
     * 根据类获取指定所有注解
     *
     * @param clazz 类clazz
     * @param ann   注解clazz
     *
     * @return {@link List<>}
     */
    public static <T extends Annotation> List<T> getFieldAnnotations(Class<?> clazz, Class<T> ann) {
        return BeanUtil.getBeanDesc(clazz).getProps().stream()
                       .map(propDesc -> propDesc.getField().getAnnotation(ann))
                       .filter(Objects::nonNull).collect(Collectors.toList());
    }
    
    /**
     * 浅拷贝-拷贝属性
     * 将old类中的属性拷贝到fresh中
     * 拷贝规则: 属性名相同
     *
     * @param old     源对象
     * @param fresh   拷贝后的对象
     * @param ignores 忽略字段
     *
     * @return fresh
     *
     * @author wls
     */
    @SafeVarargs
    public static <T> T copyBean(Object old, T fresh, FunctionSerializable<T, ?>... ignores) {
        BeanUtil.copyProperties(old, fresh, LamUtil.fieldNames(ignores));
        return fresh;
    }
    
    /**
     * 得到含有指定字符串的简单的堆栈跟踪
     *
     * @param e       e
     * @param contain 包含字符串
     *
     * @return {@link StackTraceElement[]}
     */
    public static StackTraceElement[] toSimpleStackTrace(Throwable e, String contain) {
        return Arrays.stream(e.getStackTrace()).distinct().parallel()
                     .filter(item -> item.getLineNumber() != -1 && item.getClassName().contains(contain))
                     .toArray(StackTraceElement[]::new);
    }
    
    /**
     * json 去除json文本中的转义字符
     *
     * @param text 文本
     *
     * @return {@link String}
     */
    public static String jsonDelEscape(String text) {
        return text.replaceAll("\\\\", "")
                   .replaceAll("\"\\{", "{")
                   .replaceAll("\"\\[", "[")
                   .replaceAll("]\"", "]")
                   .replaceAll("}\"", "}");
    }
    
    /**
     * 从字符串中获取数字数字
     *
     * @param str str
     *
     * @return {@link Integer}
     */
    public static Integer toInt(String str) {
        String regEx = "\\D";
        Pattern p = Pattern.compile(regEx);
        Matcher m = p.matcher(str);
        return Integer.valueOf(m.replaceAll("").trim());
    }
    
    /**
     * 改用 BeanUtil.trimStrFields()
     * 去除对象中所有String类型的前后空白
     *
     * @param coll coll
     */
    @Deprecated
    public static void trimBean(Collection<?> coll) {
        coll.forEach(Pines::trimBean);
    }
    
    /**
     * 去除对象中所有String类型的前后空白
     *
     * @param bean bean
     */
    @Deprecated
    public static void trimBean(Object bean) {
        BeanUtil.getBeanDesc(bean.getClass()).getProps().forEach(prop -> {
            if (String.class.equals(prop.getFieldClass())) {
                Object str = ReflectUtil.invoke(bean, prop.getGetter());
                if (str == null) {
                    return;
                }
                ReflectUtil.invoke(bean, prop.getSetter(), str.toString().trim());
            }
        });
    }
    
}
