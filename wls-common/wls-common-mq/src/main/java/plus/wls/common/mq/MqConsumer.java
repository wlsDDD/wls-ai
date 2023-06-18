package plus.wls.common.mq;

/**
 * 消费者注解配置
 *
 * @author wls
 * @since 2023-12-04
 */
public @interface MqConsumer {
    
    /**
     * 消息主题
     */
    String topic();
    
    
}
