// package plus.wls.mq;
//
// import lombok.AllArgsConstructor;
// import lombok.extern.slf4j.Slf4j;
// import org.springframework.web.bind.annotation.PathVariable;
// import org.springframework.web.bind.annotation.PostMapping;
// import org.springframework.web.bind.annotation.RestController;
//
// import java.util.Map;
// import java.util.concurrent.TimeUnit;
//
// @RestController
// @AllArgsConstructor
// @Slf4j
// public class Producer {
//
//     // private RedissonClient redissonClient;
//
//     @PostMapping("/Producer/{kd}")
//     public String test01(@PathVariable String kd) {
//         return kd;
//     }
//
//     /**
//      * 添加延迟队列
//      *
//      * @param value     队列值
//      * @param delay     延迟时间
//      * @param timeUnit  时间单位
//      * @param queueCode 队列键
//      */
//     public <T> void addDelayQueue(T value, long delay, TimeUnit timeUnit, String queueCode) {
//         try {
//             RBlockingDeque<Object> blockingDeque = redissonClient.getBlockingDeque(queueCode);
//             RDelayedQueue<Object> delayedQueue = redissonClient.getDelayedQueue(blockingDeque);
//             delayedQueue.offer(value, delay, timeUnit);
//             log.info("(添加延时队列成功) 队列键：{}，队列值：{}，延迟时间：{}", queueCode, value, timeUnit.toSeconds(delay) + "秒");
//         } catch (Exception e) {
//             log.error("(添加延时队列失败) {}", e.getMessage());
//             throw new RuntimeException("(添加延时队列失败)");
//         }
//     }
//
//     /**
//      * 获取延迟队列
//      */
//     public <T> T getDelayQueue(String queueCode) throws InterruptedException {
//         RBlockingDeque<Map> blockingDeque = redissonClient.getBlockingDeque(queueCode);
//         T value = (T) blockingDeque.take();
//         return value;
//     }
//
// }
