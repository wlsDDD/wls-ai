package plus.wls.system.project.controller;

import com.baomidou.mybatisplus.core.metadata.IPage;
import com.baomidou.mybatisplus.extension.plugins.pagination.Page;
import lombok.AllArgsConstructor;
import lombok.extern.slf4j.Slf4j;
import org.springframework.validation.annotation.Validated;
import org.springframework.web.bind.annotation.*;
import plus.wls.common.web.pojo.BaseController;
import plus.wls.common.web.pojo.Result;
import plus.wls.dict.api.DictDataApi;
import plus.wls.system.project.entity.User;
import plus.wls.system.project.service.IUserService;

import javax.validation.Valid;
import java.util.ArrayList;
import java.util.List;

/**
 * <p>
 * 用户信息 控制器
 * </p>
 *
 * @author wls
 * @since 2021-11-19
 */
@RestController
@RequestMapping("/user")
@AllArgsConstructor
@Slf4j
public class UserController extends BaseController {
    
    static Page<User> page = new Page<>();
    static int count = 0;
    
    static {
        List<User> list = new ArrayList<>();
        list.add(new User().setUserName("wls1").setNickName("nick1"));
        list.add(new User().setUserName("wls2").setNickName("nick2"));
        page.setRecords(list);
    }
    
    private IUserService userService;
    private DictDataApi dictDataApi;
    
    
    /**
     * 用户信息-分页列表
     */
    @PostMapping("/page")
    public Result<IPage<User>> pageUser(@RequestBody @Validated List<@Valid User> user) {
        return Result.ok(page);
    }
    
    /**
     * 根据id获取用户信息详情
     */
    @GetMapping("/{id}")
    public Result<User> getUserById(@PathVariable("id") Long id) {
        return Result.ok(userService.getUserById(id));
    }
    
    /**
     * 新增-用户信息
     */
    @PostMapping
    public Result<User> insertUser(@RequestBody User user) {
        return Result.ok();
    }
    
    // @PulsarConsumer(topic = "wls", clazz = String.class, subscriptionType = SubscriptionType.Shared)
    // public void consume(PulsarMessage<String> message) throws PulsarClientException {
    //     // message.get
    //     if (count < 10) {
    //         log.info("消费失败了 {}", count++);
    //         throw new RuntimeException("消费失败了");
    //     }
    //     log.info("收到一个消息 wls 并消费成功 {}", message);
    // }
    
    public void consumeBoot(String message) {
        log.info("收到一个消息 bootTopic {}", message);
        throw new RuntimeException("消费失败了");
    }
    
    /**
     * 修改-用户信息
     */
    @PutMapping
    public Result<?> updateUser(@RequestBody @Validated User user) {
        userService.updateUser(user);
        return Result.ok();
    }
    
    /**
     * 删除-用户信息
     */
    @DeleteMapping("/{ids}")
    public Result<?> deleteUser(@PathVariable("ids") List<Long> ids) {
        userService.deleteUser(ids);
        return Result.ok();
    }
    
}
