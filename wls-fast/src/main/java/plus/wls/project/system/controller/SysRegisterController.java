package plus.wls.project.system.controller;

import plus.wls.common.utils.StringUtils;
import plus.wls.framework.security.RegisterBody;
import plus.wls.framework.security.service.SysRegisterService;
import plus.wls.framework.web.controller.BaseController;
import plus.wls.framework.web.domain.Result;
import plus.wls.project.system.service.ISysConfigService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

/**
 * 注册验证
 *
 * @author wls
 */
@RestController
public class SysRegisterController extends BaseController {
    @Autowired
    private SysRegisterService registerService;
    
    @Autowired
    private ISysConfigService configService;
    
    @PostMapping("/register")
    public Result register(@RequestBody RegisterBody user) {
        if (!("true".equals(configService.selectConfigByKey("sys.account.registerUser")))) {
            return error("当前系统没有开启注册功能！");
        }
        String msg = registerService.register(user);
        return StringUtils.isEmpty(msg) ? success() : error(msg);
    }
    
}
