package plus.wls.common.web.util;

import com.alibaba.excel.EasyExcel;
import lombok.extern.slf4j.Slf4j;
import org.springframework.web.multipart.MultipartFile;
import plus.wls.common.web.pojo.DataListener;

import java.io.InputStream;
import java.util.List;

/**
 * excel跑龙套
 *
 * @author wls
 * @since 2020/9/27 9:48
 */
@Slf4j
public class ExcelUtil {
    
    /**
     * 导入excel-easyExcel
     *
     * @param file         文件
     * @param dataListener 数据监听器
     *
     * @return {@link List<T>}
     */
    public static <T> void importExcel(MultipartFile file, DataListener<T> dataListener) {
        try (InputStream in = file.getInputStream()) {
            EasyExcel.read(in, dataListener).doReadAll();
        } catch (Exception e) {
            log.error("excel-导入错误" + e.getMessage(), e);
            throw new RuntimeException("Excel解析异常 请检查模版后重试", e);
        }
    }
    
}
