package plus.wls.social.controller;

import lombok.AllArgsConstructor;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.*;
import plus.wls.common.utils.poi.ExcelUtil;
import plus.wls.framework.aspectj.lang.annotation.Log;
import plus.wls.framework.aspectj.lang.enums.BusinessType;
import plus.wls.framework.web.controller.BaseController;
import plus.wls.framework.web.domain.Result;
import plus.wls.framework.web.page.TableDataInfo;
import plus.wls.social.entity.PtsApiLog;
import plus.wls.social.service.IPtsApiLogService;

import javax.servlet.http.HttpServletResponse;
import java.util.List;

/**
 * pts日志Controller
 *
 * @author wls
 * @date 2023-09-12
 */
@RestController
@RequestMapping("/social/ptsApiLog")
@AllArgsConstructor
public class PtsApiLogController extends BaseController {
    
    private IPtsApiLogService ptsApiLogService;
    
    /**
     * 查询pts日志列表
     */
    @PreAuthorize("@ss.hasPermi('social:ptsApiLog:list')")
    @GetMapping("/list")
    public TableDataInfo list(PtsApiLog ptsApiLog) {
        startPage();
        List<PtsApiLog> list = ptsApiLogService.selectPtsApiLogList(ptsApiLog);
        return getDataTable(list);
    }
    
    /**
     * 导出pts日志列表
     */
    @PreAuthorize("@ss.hasPermi('social:ptsApiLog:export')")
    @Log(title = "pts日志", businessType = BusinessType.EXPORT)
    @PostMapping("/export")
    public void export(HttpServletResponse response, PtsApiLog ptsApiLog) {
        List<PtsApiLog> list = ptsApiLogService.selectPtsApiLogList(ptsApiLog);
        ExcelUtil<PtsApiLog> util = new ExcelUtil<PtsApiLog>(PtsApiLog.class);
        util.exportExcel(response, list, "pts日志数据");
    }
    
    /**
     * 获取pts日志详细信息
     */
    @PreAuthorize("@ss.hasPermi('social:ptsApiLog:query')")
    @GetMapping(value = "/{id}")
    public Result getInfo(@PathVariable("id") String id) {
        return success(ptsApiLogService.selectPtsApiLogById(id));
    }
    
    /**
     * 新增pts日志
     */
    @PreAuthorize("@ss.hasPermi('social:ptsApiLog:add')")
    @Log(title = "pts日志", businessType = BusinessType.INSERT)
    @PostMapping
    public Result add(@RequestBody PtsApiLog ptsApiLog) {
        return toAjax(ptsApiLogService.insertPtsApiLog(ptsApiLog));
    }
    
    /**
     * 修改pts日志
     */
    @PreAuthorize("@ss.hasPermi('social:ptsApiLog:edit')")
    @Log(title = "pts日志", businessType = BusinessType.UPDATE)
    @PutMapping
    public Result edit(@RequestBody PtsApiLog ptsApiLog) {
        return toAjax(ptsApiLogService.updatePtsApiLog(ptsApiLog));
    }
    
    /**
     * 删除pts日志
     */
    @PreAuthorize("@ss.hasPermi('social:ptsApiLog:remove')")
    @Log(title = "pts日志", businessType = BusinessType.DELETE)
    @DeleteMapping("/{ids}")
    public Result remove(@PathVariable String[] ids) {
        return toAjax(ptsApiLogService.deletePtsApiLogByIds(ids));
    }
    
}
