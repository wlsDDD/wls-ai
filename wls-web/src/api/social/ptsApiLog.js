import request from '@/utils/request'

// 查询pts日志列表
export function listPtsApiLog(query) {
  return request({
    url: '/social/ptsApiLog/list',
    method: 'get',
    params: query
  })
}

// 查询pts日志详细
export function getPtsApiLog(id) {
  return request({
    url: '/social/ptsApiLog/' + id,
    method: 'get'
  })
}

// 新增pts日志
export function addPtsApiLog(data) {
  return request({
    url: '/social/ptsApiLog',
    method: 'post',
    data: data
  })
}

// 修改pts日志
export function updatePtsApiLog(data) {
  return request({
    url: '/social/ptsApiLog',
    method: 'put',
    data: data
  })
}

// 删除pts日志
export function delPtsApiLog(id) {
  return request({
    url: '/social/ptsApiLog/' + id,
    method: 'delete'
  })
}
