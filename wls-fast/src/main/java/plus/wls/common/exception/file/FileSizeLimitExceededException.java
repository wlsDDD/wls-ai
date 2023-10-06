package plus.wls.common.exception.file;

/**
 * 文件名大小限制异常类
 *
 * @author wls
 */
public class FileSizeLimitExceededException extends FileException {
    private static final long serialVersionUID = 1L;
    
    public FileSizeLimitExceededException(long defaultMaxSize) {
        super("upload.exceed.maxSize", new Object[]{defaultMaxSize});
    }
    
}
