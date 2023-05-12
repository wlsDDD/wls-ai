package plus.wls.common.core.function;

/**
 * 无入参 无返回值函数 用于执行代码块
 *
 * @author wls
 * @since 2023-12-13
 */
@FunctionalInterface
public interface Task {
    
    void execute();
    
}
