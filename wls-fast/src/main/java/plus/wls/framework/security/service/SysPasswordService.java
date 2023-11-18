package plus.wls.framework.security.service;

import plus.wls.common.constant.CacheConstants;
import plus.wls.common.constant.Constants;
import plus.wls.common.exception.user.UserPasswordNotMatchException;
import plus.wls.common.exception.user.UserPasswordRetryLimitExceedException;
import plus.wls.common.utils.MessageUtils;
import plus.wls.common.utils.SecurityUtils;
import plus.wls.framework.manager.AsyncManager;
import plus.wls.framework.manager.factory.AsyncFactory;
import plus.wls.framework.redis.RedisCache;
import plus.wls.framework.security.context.AuthenticationContextHolder;
import plus.wls.project.system.entity.SysUser;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.security.core.Authentication;
import org.springframework.stereotype.Component;

import java.util.concurrent.TimeUnit;

/**
 * 登录密码方法
 *
 * @author wls
 */
@Component
public class SysPasswordService {
    @Autowired
    private RedisCache redisCache;
    
    @Value(value = "${wls.user.password.maxRetryCount}")
    private int maxRetryCount;
    
    @Value(value = "${wls.user.password.lockTime}")
    private int lockTime;
    
    public void validate(SysUser user) {
        Authentication usernamePasswordAuthenticationToken = AuthenticationContextHolder.getContext();
        String username = usernamePasswordAuthenticationToken.getName();
        String password = usernamePasswordAuthenticationToken.getCredentials().toString();
        
        Integer retryCount = redisCache.getCacheObject(getCacheKey(username));
        
        if (retryCount == null) {
            retryCount = 0;
        }
        
        if (retryCount >= Integer.valueOf(maxRetryCount).intValue()) {
            AsyncManager.me().execute(AsyncFactory.recordLogininfor(username, Constants.LOGIN_FAIL,
                    MessageUtils.message("user.password.retry.limit.exceed", maxRetryCount, lockTime)));
            throw new UserPasswordRetryLimitExceedException(maxRetryCount, lockTime);
        }
        
        if (!matches(user, password)) {
            retryCount = retryCount + 1;
            AsyncManager.me().execute(AsyncFactory.recordLogininfor(username, Constants.LOGIN_FAIL,
                    MessageUtils.message("user.password.retry.limit.count", retryCount)));
            redisCache.setCacheObject(getCacheKey(username), retryCount, lockTime, TimeUnit.MINUTES);
            throw new UserPasswordNotMatchException();
        } else {
            clearLoginRecordCache(username);
        }
    }
    
    /**
     * 登录账户密码错误次数缓存键名
     *
     * @param username 用户名
     *
     * @return 缓存键key
     */
    private String getCacheKey(String username) {
        return CacheConstants.PWD_ERR_CNT_KEY + username;
    }
    
    public boolean matches(SysUser user, String rawPassword) {
        return SecurityUtils.matchesPassword(rawPassword, user.getPassword());
    }
    
    public void clearLoginRecordCache(String loginName) {
        if (redisCache.hasKey(getCacheKey(loginName))) {
            redisCache.deleteObject(getCacheKey(loginName));
        }
    }
    
}
