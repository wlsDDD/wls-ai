package plus.wls.social.service.impl;

import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;
import plus.wls.common.utils.DateUtils;
import plus.wls.social.entity.PtsApiLog;
import plus.wls.social.mapper.PtsApiLogMapper;
import plus.wls.social.service.IPtsApiLogService;

import java.util.List;

/**
 * pts日志Service业务层处理
 *
 * @author wls
 * @date 2023-09-12
 */
@Service
@AllArgsConstructor
public class PtsApiLogServiceImpl implements IPtsApiLogService {
    
    private PtsApiLogMapper ptsApiLogMapper;
    
    /**
     * 查询pts日志
     *
     * @param id pts日志主键
     *
     * @return pts日志
     */
    @Override
    public PtsApiLog selectPtsApiLogById(String id) {
        return ptsApiLogMapper.selectPtsApiLogById(id);
    }
    
    /**
     * 查询pts日志列表
     *
     * @param ptsApiLog pts日志
     *
     * @return pts日志
     */
    @Override
    public List<PtsApiLog> selectPtsApiLogList(PtsApiLog ptsApiLog) {
        return ptsApiLogMapper.selectPtsApiLogList(ptsApiLog);
    }
    
    /**
     * 新增pts日志
     *
     * @param ptsApiLog pts日志
     *
     * @return 结果
     */
    @Override
    public int insertPtsApiLog(PtsApiLog ptsApiLog) {
        ptsApiLog.setCreateTime(DateUtils.getNowDate());
        return ptsApiLogMapper.insertPtsApiLog(ptsApiLog);
    }
    
    /**
     * 修改pts日志
     *
     * @param ptsApiLog pts日志
     *
     * @return 结果
     */
    @Override
    public int updatePtsApiLog(PtsApiLog ptsApiLog) {
        ptsApiLog.setUpdateTime(DateUtils.getNowDate());
        return ptsApiLogMapper.updatePtsApiLog(ptsApiLog);
    }
    
    /**
     * 批量删除pts日志
     *
     * @param ids 需要删除的pts日志主键
     *
     * @return 结果
     */
    @Override
    public int deletePtsApiLogByIds(String[] ids) {
        return ptsApiLogMapper.deletePtsApiLogByIds(ids);
    }
    
    /**
     * 删除pts日志信息
     *
     * @param id pts日志主键
     *
     * @return 结果
     */
    @Override
    public int deletePtsApiLogById(String id) {
        return ptsApiLogMapper.deletePtsApiLogById(id);
    }
    
}
