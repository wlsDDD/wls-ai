package plus.wls.common.mq;

import cn.hutool.core.thread.ThreadUtil;
import lombok.extern.slf4j.Slf4j;
import org.springframework.stereotype.Component;

import javax.annotation.PostConstruct;
import java.util.concurrent.DelayQueue;
import java.util.concurrent.TimeUnit;

/**
 * mq主类
 *
 * @author wls
 * @since 2023-12-01
 */

@Slf4j
@Component
public class WlsMq {
    /**
     * 延迟消息队列
     */
    private static final DelayQueue<Message<Object>> MESSAGE_QUEUE = new DelayQueue<>();
    
    /**
     * 发送消息
     *
     * @param topic 消息主题
     * @param time  延迟时间
     * @param unit  时间单位
     * @param body  消息内容
     */
    public static void send(String topic, int time, TimeUnit unit, Object body) {
        MESSAGE_QUEUE.put(new Message<>(topic, time, unit, body));
    }
    
    /**
     * 监听消息队列 有消息时执行方法进行消费
     */
    @PostConstruct
    public <T> void execMq() {
        ThreadUtil.execute(() -> {
            while (true) {
                try {
                    Message<Object> message = MESSAGE_QUEUE.take();
                    log.debug("从消息队列中获取消息成功 {}", message);
                } catch (InterruptedException e) {
                    log.error("mq 消息消费异常 消息内容", e);
                }
            }
        });
    }
    
    /**
     * 扫描消费者注解
     */
    public void scan() {
    
    }
    
}
