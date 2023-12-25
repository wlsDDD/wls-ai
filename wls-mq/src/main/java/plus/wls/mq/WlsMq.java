package plus.wls.mq;

import lombok.extern.slf4j.Slf4j;
import org.springframework.stereotype.Component;

@Slf4j
@Component
public class WlsMq {
    public static void main(String[] args) throws InterruptedException {
        // DELAYE_FUNC_QUEUE.add(new DelayedTask<>("hello", 5, TimeUnit.SECONDS, "nihao5"));
        // DELAYE_FUNC_QUEUE.add(new DelayedTask<>("hello", 15, TimeUnit.SECONDS, "nihao15"));
        // DELAYE_FUNC_QUEUE.add(new DelayedTask<>("hello", 10, TimeUnit.SECONDS, "nihao10"));
        // DELAYE_FUNC_QUEUE.add(new DelayedTask<>("hello", 20, TimeUnit.SECONDS, "nihao20"));
        
        // while (!DELAYE_FUNC_QUEUE.isEmpty()) {
        //     // DelayedTask<String> poll = DELAYE_FUNC_QUEUE.poll();
        //     // DelayedTask<String> delayedFunc = DELAYE_FUNC_QUEUE.take();
        //     // log.info("laile {}", delayedFunc);
        //     // System.out.println(delayedFunc);
        // }
    }
    
}
