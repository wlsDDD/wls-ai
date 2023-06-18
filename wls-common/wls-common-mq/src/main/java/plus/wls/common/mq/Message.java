package plus.wls.common.mq;

import lombok.Data;
import lombok.experimental.Accessors;

import java.time.LocalDateTime;
import java.util.concurrent.Delayed;
import java.util.concurrent.TimeUnit;


/**
 * 消息体
 *
 * @author wls
 * @since 2023-12-01
 */
@Data
@Accessors(chain = true)
public class Message<T> implements Delayed {
    /**
     * 消息主题
     */
    private String topic;
    /**
     * 延迟时间
     */
    private int time;
    /**
     * 延迟时间单位
     */
    private TimeUnit unit;
    /**
     * 可用时间
     */
    private long availableTime;
    /**
     * 消息内容
     */
    private T body;
    /**
     * 消息投递次数
     */
    private int num = 0;
    /**
     * 消息创建时间
     */
    private LocalDateTime joinTime = LocalDateTime.now();
    /**
     * 是否自动重试 默认是
     */
    private boolean retry = true;
    /**
     * 自动重试间隔时间 默认延迟时间
     */
    private int retryTime = time;
    /**
     * 自动重试间隔时间单位 默认延迟时间单位
     */
    private TimeUnit retryUnit = unit;
    /**
     * 最大重试次数
     */
    private int retryNum = 10;
    
    /**
     * 构造方法
     */
    public Message(String topic, int time, TimeUnit unit, T body) {
        this.topic = topic;
        this.unit = unit;
        this.time = time;
        this.body = body;
        availableTime = System.currentTimeMillis() + unit.toMillis(time);
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
        return this.availableTime - System.currentTimeMillis();
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
