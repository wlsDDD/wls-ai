package plus.wls.social.mapper;


import plus.wls.social.entity.PtsApiLog;

import java.util.List;

/**
 * pts日志Mapper接口
 *
 * @author wls
 * @date 2023-09-12
 */
public interface PtsApiLogMapper {
    /**
     * 查询pts日志
     *
     * @param id pts日志主键
     *
     * @return pts日志
     */
    PtsApiLog selectPtsApiLogById(String id);
    
    /**
     * 查询pts日志列表
     *
     * @param ptsApiLog pts日志
     *
     * @return pts日志集合
     */
    List<PtsApiLog> selectPtsApiLogList(PtsApiLog ptsApiLog);
    
    /**
     * 新增pts日志
     *
     * @param ptsApiLog pts日志
     *
     * @return 结果
     */
    int insertPtsApiLog(PtsApiLog ptsApiLog);
    
    /**
     * 修改pts日志
     *
     * @param ptsApiLog pts日志
     *
     * @return 结果
     */
    int updatePtsApiLog(PtsApiLog ptsApiLog);
    
    /**
     * 删除pts日志
     *
     * @param id pts日志主键
     *
     * @return 结果
     */
    int deletePtsApiLogById(String id);
    
    /**
     * 批量删除pts日志
     *
     * @param ids 需要删除的数据主键集合
     *
     * @return 结果
     */
    int deletePtsApiLogByIds(String[] ids);
    
}
