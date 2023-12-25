package plus.wls.mq;

import cn.hutool.core.date.LocalDateTimeUtil;
import cn.hutool.cron.CronUtil;
import cn.hutool.cron.TaskTable;
import cn.hutool.cron.task.Task;
import lombok.extern.slf4j.Slf4j;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.time.LocalDateTime;

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
@Slf4j
public class UserController {
    
    String taskId = "";
    
    Integer count = 0;
    
    @PostMapping("/page")
    public String pageUser(String str) {
        CronUtil.setMatchSecond(true);
        String ss = LocalDateTimeUtil.format(LocalDateTime.now(), "ss");
        log.info(ss);
        taskId = CronUtil.schedule("* * * * * *", (Task) () -> {
            log.info(LocalDateTime.now() + "");
            count++;
            System.out.println("count = " + count);
            if (count > 10) {
                boolean remove = CronUtil.remove(taskId);
                System.out.println("remove = " + remove);
            }
        });
        CronUtil.start();
        return str;
    }
    
    @PostMapping("/del")
    public String del(String str) {
        CronUtil.remove(taskId);
        return str;
    }
    
    @PostMapping("/list")
    public TaskTable list(String str) {
        TaskTable taskTable = CronUtil.getScheduler().getTaskTable();
        return taskTable;
    }
    
}
