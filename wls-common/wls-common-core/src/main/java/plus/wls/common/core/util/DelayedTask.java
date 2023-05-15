package plus.wls.common.core.util;

import cn.hutool.core.thread.ThreadUtil;
import cn.hutool.core.util.IdUtil;
import cn.hutool.json.JSONUtil;
import lombok.Data;
import lombok.experimental.Accessors;
import lombok.extern.slf4j.Slf4j;
import plus.wls.common.core.function.Task;

import java.time.LocalDateTime;
import java.util.concurrent.*;


/**
 * 消息体
 */
@Slf4j
@Data
@Accessors(chain = true)
public class DelayedTask implements Delayed {
    
    /**
     * 延迟消息队列
     */
    private static final DelayQueue<DelayedTask> DELAYE_FUNC_QUEUE = new DelayQueue<>();
    /**
     * 线程池
     */
    private static final ThreadPoolExecutor THREAD_POOL = new ThreadPoolExecutor(1, 1024,
            30, TimeUnit.MINUTES,
            new LinkedBlockingQueue<>(1024),
            ThreadUtil.createThreadFactory("DelayQueue-"),
            new ThreadPoolExecutor.CallerRunsPolicy());
    
    static {
        THREAD_POOL.execute(() -> {
            while (true) {
                try {
                    DelayedTask task = DELAYE_FUNC_QUEUE.take();
                    String jsonStr = JSONUtil.toJsonStr(DELAYE_FUNC_QUEUE);
                    THREAD_POOL.execute(() -> {
                        try {
                            task.taskFunc.execute();
                        } catch (Exception e) {
                            log.error("任务执行异常", e);
                            if (task.retry) {
                                task.retry();
                            }
                        }
                    });
                } catch (InterruptedException e) {
                    log.error("消息异常", e);
                }
            }
        });
    }
    
    /**
     * 任务唯一id
     */
    private String taskId;
    /**
     * 延迟时间
     */
    private int time;
    /**
     * 延迟时间单位
     */
    private TimeUnit unit;
    /**
     * 到期时间戳
     */
    private long delayedTime;
    /**
     * 执行任务函数
     */
    private Task taskFunc;
    /**
     * 消息创建时间
     */
    private LocalDateTime startTime;
    
    /**
     * 消息重试次数
     */
    private int num;
    /**
     * 是否重试 默认是
     */
    private boolean retry = true;
    /**
     * 重试间隔时间
     */
    private int retryTime = 20;
    /**
     * 重试间隔时间单位
     */
    private TimeUnit retryUnit = TimeUnit.SECONDS;
    /**
     * 最大重试次数
     */
    private int retryNum = 3 * 60 * 2;
    
    /**
     * 构造
     */
    public DelayedTask(int time, Task taskFunc) {
        this(time, TimeUnit.SECONDS, taskFunc);
    }
    
    /**
     * 构造方法
     */
    public DelayedTask(int time, TimeUnit unit, Task taskFunc) {
        this.taskId = IdUtil.fastSimpleUUID();
        this.time = time;
        this.unit = unit;
        this.taskFunc = taskFunc;
        this.startTime = LocalDateTime.now();
        delayedTime = System.currentTimeMillis() + unit.toMillis(time);
    }
    
    /**
     * 发送延迟消息
     *
     * @param time 延迟时间
     */
    public static void send(int time, Task task) {
        DELAYE_FUNC_QUEUE.put(new DelayedTask(time, task));
    }
    
    /**
     * 任务重试
     */
    public void retry() {
        // resetTime();
        retryNum++;
        delayedTime = System.currentTimeMillis() + retryUnit.toMillis(retryTime);
        log.info("开始任务重试 重试次数 {}", retryNum);
        DELAYE_FUNC_QUEUE.put(this);
    }
    
    
    /**
     * 重置执行时间 当前时间+延迟时间
     *
     * @param time 延迟时间
     * @param unit 延迟时间单位
     */
    public void resetTime(Integer time, TimeUnit unit) {
        delayedTime = System.currentTimeMillis() + unit.toMillis(time);
    }
    
    /**
     * Returns the remaining delay associated with this object, in the
     * given time unit.
     *
     * @param unit the time unit
     *
     * @return the remaining delay; zero or negative values indicate
     * that the delay has already elapsed
     */
    @Override
    public long getDelay(TimeUnit unit) {
        return this.delayedTime - System.currentTimeMillis();
    }
    
    /**
     * Compares this object with the specified object for order.  Returns a
     * negative integer, zero, or a positive integer as this object is less
     * than, equal to, or greater than the specified object.
     * <p>The implementor must ensure <tt>sgn(x.compareTo(y)) ==
     * -sgn(y.compareTo(x))</tt> for all <tt>x</tt> and <tt>y</tt>.  (This
     * implies that <tt>x.compareTo(y)</tt> must throw an exception iff
     * <tt>y.compareTo(x)</tt> throws an exception.)
     * <p>The implementor must also ensure that the relation is transitive:
     * <tt>(x.compareTo(y)&gt;0 &amp;&amp; y.compareTo(z)&gt;0)</tt> implies
     * <tt>x.compareTo(z)&gt;0</tt>.
     * <p>Finally, the implementor must ensure that <tt>x.compareTo(y)==0</tt>
     * implies that <tt>sgn(x.compareTo(z)) == sgn(y.compareTo(z))</tt>, for
     * all <tt>z</tt>.
     * <p>It is strongly recommended, but <i>not</i> strictly required that
     * <tt>(x.compareTo(y)==0) == (x.equals(y))</tt>.  Generally speaking, any
     * class that implements the <tt>Comparable</tt> interface and violates
     * this condition should clearly indicate this fact.  The recommended
     * language is "Note: this class has a natural ordering that is
     * inconsistent with equals."
     * <p>In the foregoing description, the notation
     * <tt>sgn(</tt><i>expression</i><tt>)</tt> designates the mathematical
     * <i>signum</i> function, which is defined to return one of <tt>-1</tt>,
     * <tt>0</tt>, or <tt>1</tt> according to whether the value of
     * <i>expression</i> is negative, zero or positive.
     *
     * @param o the object to be compared.
     *
     * @return a negative integer, zero, or a positive integer as this object
     * is less than, equal to, or greater than the specified object.
     *
     * @throws NullPointerException if the specified object is null
     * @throws ClassCastException   if the specified object's type prevents it
     *                              from being compared to this object.
     */
    @Override
    public int compareTo(Delayed o) {
        return this.unit.toMillis(time) > o.getDelay(TimeUnit.MICROSECONDS) ? 1 : -1;
    }
    
}
