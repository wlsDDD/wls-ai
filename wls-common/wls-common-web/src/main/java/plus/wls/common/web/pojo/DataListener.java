package plus.wls.common.web.pojo;

import cn.hutool.core.util.ObjectUtil;
import com.alibaba.excel.context.AnalysisContext;
import com.alibaba.excel.event.AnalysisEventListener;
import lombok.Data;
import lombok.EqualsAndHashCode;
import lombok.experimental.Accessors;
import lombok.extern.slf4j.Slf4j;

import java.util.Collection;
import java.util.LinkedList;
import java.util.List;
import java.util.Map;
import java.util.function.Consumer;

/**
 * easyExcel解析类
 *
 * @author wls
 * @since 2021/05/07 09:48:16
 */
@Slf4j
@EqualsAndHashCode(callSuper = false)
@Data
@Accessors(chain = true)
public class DataListener<T> extends AnalysisEventListener<T> {
    
    /**
     * clazz
     */
    public Class<T> clazz;
    /**
     * 每隔1000条存储数据库，然后清理list ，方便内存回收
     */
    private int batchCount = 1000;
    /**
     * 成功列表
     */
    private List<T> batchList = new LinkedList<>();
    /**
     * 行处理函数
     */
    private Consumer<? super T> lineFunc;
    /**
     * 批处理函数
     */
    private Consumer<? super Collection<T>> batchFunc;
    /**
     * 处理excel表头函数
     */
    private Consumer<? super Map<Integer, String>> headFunc;
    
    /**
     * 构造函数
     */
    public DataListener(Consumer<? super Collection<T>> batchFunc) {
        this.batchFunc = batchFunc;
    }
    
    /**
     * 这个每一条数据解析都会来调用
     *
     * @param data    one row value. same as {@link AnalysisContext#readRowHolder()}
     * @param context 上下文
     */
    @Override
    public void invoke(T data, AnalysisContext context) {
        if (ObjectUtil.isNotNull(lineFunc)) {
            lineFunc.accept(data);
        }
        batchList.add(data);
        if (batchList.size() > batchCount) {
            batchFunc.accept(batchList);
            batchList.clear();
        }
    }
    
    /**
     * 数据处理完后执行一次
     *
     * @param analysisContext 分析上下文
     */
    @Override
    public void doAfterAllAnalysed(AnalysisContext analysisContext) {
        batchFunc.accept(batchList);
        batchList.clear();
    }
    
    /**
     * 处理Excel title
     *
     * @param headMap title
     * @param context 上下文
     */
    @Override
    public void invokeHeadMap(Map<Integer, String> headMap, AnalysisContext context) {
        if (ObjectUtil.isNotNull(headFunc)) {
            headFunc.accept(headMap);
        }
    }
    
}
    