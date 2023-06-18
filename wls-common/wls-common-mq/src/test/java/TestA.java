import cn.hutool.cron.CronUtil;
import cn.hutool.cron.task.Task;
import lombok.extern.slf4j.Slf4j;
import org.junit.jupiter.api.Test;

import java.time.LocalDateTime;

@Slf4j
public class TestA {
    
    
    @Test
    void test02() throws InterruptedException {
        for (int i = 0; i < 100; i++) {
            int second = LocalDateTime.now().getSecond();
            log.info(second + "");
            Thread.sleep(1000);
        }
    }
    
    @Test
    void test01() {
        CronUtil.setMatchSecond(true);
        CronUtil.schedule("* * * * * *", (Task) () -> log.info(LocalDateTime.now() + ""));
        CronUtil.start();
    }
    
}
