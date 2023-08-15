package plus.wls.common.web.aspect;

import cn.hutool.core.bean.BeanDesc;
import cn.hutool.core.bean.BeanUtil;
import cn.hutool.core.collection.CollUtil;
import cn.hutool.core.util.ObjectUtil;
import lombok.extern.slf4j.Slf4j;
import org.aspectj.lang.JoinPoint;
import org.aspectj.lang.annotation.Aspect;
import org.aspectj.lang.annotation.Before;
import org.springframework.stereotype.Component;
import plus.wls.common.core.enums.CodeInfoEnum;
import plus.wls.common.core.exception.IllegalArgException;
import plus.wls.common.web.annotation.RequiredParam;

import java.util.LinkedList;
import java.util.List;

/**
 * 必要参数验证
 *
 * @author wls
 * @date 2022-06-07 19:08:35
 * @since 1.0.0
 */
@Slf4j
@Aspect
@Component
public class RequiredParamAspect {
    
    @Before("@annotation(requiredParam))")
    public void before(JoinPoint point, RequiredParam requiredParam) {
        List<String> errors = new LinkedList<>();
        Object[] args = point.getArgs();
        String[] requiredParams = requiredParam.value();
        for (Object arg : args) {
            BeanDesc beanDesc = BeanUtil.getBeanDesc(arg.getClass());
            for (String required : requiredParams) {
                Object value = beanDesc.getProp(required).getValue(arg);
                if (ObjectUtil.isEmpty(value)) {
                    errors.add(required);
                }
            }
        }
        if (CollUtil.isNotEmpty(errors)) {
            throw new IllegalArgException(CodeInfoEnum.ARG_REQUIRED_ERROR, errors.toArray());
        }
    }
    
}
