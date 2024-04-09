<template>
  <div class="app-container">
    <el-form :model="queryParams" ref="queryRef" :inline="true" v-show="showSearch" label-width="68px">
      <el-form-item label="requestId" prop="requestId">
        <el-input
          v-model="queryParams.requestId"
          placeholder="请输入requestId"
          clearable
          @keyup.enter="handleQuery"
        />
      </el-form-item>
      <el-form-item label="bizNo" prop="requestNum">
        <el-input
          v-model="queryParams.requestNum"
          placeholder="请输入bizNo"
          clearable
          @keyup.enter="handleQuery"
        />
      </el-form-item>
      <el-form-item label="来源ip" prop="requestIp">
        <el-input
          v-model="queryParams.requestIp"
          placeholder="请输入请求来源ip"
          clearable
          @keyup.enter="handleQuery"
        />
      </el-form-item>
      <el-form-item label="请求路径" prop="requestPtsUrl">
        <el-input
            v-model="queryParams.requestPtsUrl"
            placeholder="请输入请求路径"
            clearable
            @keyup.enter="handleQuery"
        />
      </el-form-item>
      <el-form-item label="请求时间" style="width: 308px">
        <el-date-picker
          v-model="daterangeCreateTime"
          value-format="YYYY-MM-DD"
          type="daterange"
          range-separator="-"
          start-placeholder="开始日期"
          end-placeholder="结束日期"
        ></el-date-picker>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" icon="Search" @click="handleQuery">搜索</el-button>
        <el-button icon="Refresh" @click="resetQuery">重置</el-button>
      </el-form-item>
    </el-form>

    <el-row :gutter="10" class="mb8">
<!--      <el-col :span="1.5">-->
<!--        <el-button-->
<!--          type="primary"-->
<!--          plain-->
<!--          icon="Plus"-->
<!--          @click="handleAdd"-->
<!--          v-hasPermi="['social:ptsApiLog:add']"-->
<!--        >新增</el-button>-->
<!--      </el-col>-->
<!--      <el-col :span="1.5">-->
<!--        <el-button-->
<!--          type="success"-->
<!--          plain-->
<!--          icon="Edit"-->
<!--          :disabled="single"-->
<!--          @click="handleUpdate"-->
<!--          v-hasPermi="['social:ptsApiLog:edit']"-->
<!--        >修改</el-button>-->
<!--      </el-col>-->
<!--      <el-col :span="1.5">-->
<!--        <el-button-->
<!--          type="danger"-->
<!--          plain-->
<!--          icon="Delete"-->
<!--          :disabled="multiple"-->
<!--          @click="handleDelete"-->
<!--          v-hasPermi="['social:ptsApiLog:remove']"-->
<!--        >删除</el-button>-->
<!--      </el-col>-->
      <el-col :span="1.5">
        <el-button
          type="warning"
          plain
          icon="Download"
          @click="handleExport"
          v-hasPermi="['social:ptsApiLog:export']"
        >导出</el-button>
      </el-col>
      <right-toolbar v-model:showSearch="showSearch" @queryTable="getList"></right-toolbar>
    </el-row>

    <el-table v-loading="loading" :data="ptsApiLogList" @selection-change="handleSelectionChange" stripe height="650">
      <el-table-column type="selection" width="55" align="center" />
      <el-table-column label="id" width="60" align="center" prop="id"/>

      <el-table-column label="企业名称" align="center" prop="requestUrl" show-overflow-tooltip/>
      <el-table-column label="请求参数" align="center" prop="requestParam" show-overflow-tooltip/>
      <el-table-column label="返回结果" align="center" prop="responseBody" show-overflow-tooltip/>

      <el-table-column label="requestId" align="center" prop="requestId" show-overflow-tooltip/>
      <el-table-column label="bizNo" align="center" prop="requestNum" show-overflow-tooltip/>
      <el-table-column label="请求方式" align="center" prop="requestMethod" show-overflow-tooltip/>
<!--      <el-table-column label="请求路径" align="center" prop="requestNum" show-overflow-tooltip/>-->
      <el-table-column label="用时" align="center" prop="costTime" show-overflow-tooltip/>
      <el-table-column label="来源ip" align="center" prop="requestIp" show-overflow-tooltip/>
      <el-table-column label="请求时间" align="center" prop="createTime" width="180">
        <template #default="scope">
          <span>{{ parseTime(scope.row.createTime, '{y}-{m}-{d} {h}:{i}:{s}') }}</span>
        </template>
      </el-table-column>
      <el-table-column label="请求路径" align="center" prop="requestPtsPath" show-overflow-tooltip/>
      <el-table-column label="请求税友url" align="center" prop="requestPtsUrl" show-overflow-tooltip/>
<!--      <el-table-column label="操作" align="center" class-name="small-padding fixed-width">-->
<!--        <template #default="scope">-->
<!--          <el-button link type="primary" icon="Edit" @click="handleUpdate(scope.row)" v-hasPermi="['social:ptsApiLog:edit']">修改</el-button>-->
<!--          <el-button link type="primary" icon="Delete" @click="handleDelete(scope.row)" v-hasPermi="['social:ptsApiLog:remove']">删除</el-button>-->
<!--        </template>-->
<!--      </el-table-column>-->
    </el-table>
    
    <pagination
      v-show="total>0"
      :total="total"
      v-model:page="queryParams.pageNum"
      v-model:limit="queryParams.pageSize"
      @pagination="getList"
    />

    <!-- 添加或修改pts日志对话框 -->
    <el-dialog :title="title" v-model="open" width="500px" append-to-body>
      <el-form ref="ptsApiLogRef" :model="form" :rules="rules" label-width="80px">
        <el-form-item label="请求原始url" prop="requestUrl">
          <el-input v-model="form.requestUrl" placeholder="请输入请求原始url" />
        </el-form-item>
        <el-form-item label="请求税友url" prop="requestPtsUrl">
          <el-input v-model="form.requestPtsUrl" placeholder="请输入请求税友url" />
        </el-form-item>
        <el-form-item label="请求税友参数" prop="requestParam">
          <el-input v-model="form.requestParam" type="textarea" placeholder="请输入内容" />
        </el-form-item>
        <el-form-item label="请求税友返回结果" prop="responseBody">
          <el-input v-model="form.responseBody" type="textarea" placeholder="请输入内容" />
        </el-form-item>
        <el-form-item label="获取反馈requestId" prop="requestId">
          <el-input v-model="form.requestId" placeholder="请输入获取反馈requestId" />
        </el-form-item>
        <el-form-item label="请求税友bizNo" prop="requestNum">
          <el-input v-model="form.requestNum" placeholder="请输入请求税友bizNo" />
        </el-form-item>
        <el-form-item label="请求用时" prop="costTime">
          <el-input v-model="form.costTime" placeholder="请输入请求用时" />
        </el-form-item>
        <el-form-item label="请求来源ip" prop="requestIp">
          <el-input v-model="form.requestIp" placeholder="请输入请求来源ip" />
        </el-form-item>
      </el-form>
      <template #footer>
        <div class="dialog-footer">
          <el-button type="primary" @click="submitForm">确 定</el-button>
          <el-button @click="cancel">取 消</el-button>
        </div>
      </template>
    </el-dialog>
  </div>
</template>

<script setup name="PtsApiLog">
import {addPtsApiLog, delPtsApiLog, getPtsApiLog, listPtsApiLog, updatePtsApiLog} from "@/api/social/ptsApiLog";
// import JsonViewer from 'vue-json-viewer';

const { proxy } = getCurrentInstance();

const ptsApiLogList = ref([]);
const open = ref(false);
const loading = ref(true);
const showSearch = ref(true);
const ids = ref([]);
const single = ref(true);
const multiple = ref(true);
const total = ref(0);
const title = ref("");
const daterangeCreateTime = ref([]);

const data = reactive({
  form: {},
  queryParams: {
    pageNum: 1,
    pageSize: 20,
    requestUrl: null,
    requestPtsUrl: null,
    requestId: null,
    requestNum: null,
    costTime: null,
    requestIp: null,
    createTime: null,
  },
  rules: {
    requestUrl: [
      { required: true, message: "请求原始url不能为空", trigger: "blur" }
    ],
    requestPtsUrl: [
      { required: true, message: "请求税友url不能为空", trigger: "blur" }
    ],
    requestParam: [
      { required: true, message: "请求税友参数不能为空", trigger: "blur" }
    ],
    responseBody: [
      { required: true, message: "请求税友返回结果不能为空", trigger: "blur" }
    ],
    requestId: [
      { required: true, message: "获取反馈requestId不能为空", trigger: "blur" }
    ],
    requestNum: [
      { required: true, message: "请求税友bizNo不能为空", trigger: "blur" }
    ],
    costTime: [
      { required: true, message: "请求用时不能为空", trigger: "blur" }
    ],
    requestIp: [
      { required: true, message: "请求来源ip不能为空", trigger: "blur" }
    ],
    createTime: [
      { required: true, message: "创建时间不能为空", trigger: "blur" }
    ],
    updateTime: [
      { required: true, message: "更新时间不能为空", trigger: "blur" }
    ]
  }
});

const { queryParams, form, rules } = toRefs(data);

/** 查询pts日志列表 */
function getList() {
  loading.value = true;
  queryParams.value.params = {};
  if (null != daterangeCreateTime && '' != daterangeCreateTime) {
    queryParams.value.params["beginCreateTime"] = daterangeCreateTime.value[0];
    queryParams.value.params["endCreateTime"] = daterangeCreateTime.value[1];
  }
  listPtsApiLog(queryParams.value).then(response => {
    ptsApiLogList.value = response.rows;
    total.value = response.total;
    loading.value = false;
  });
}

// 取消按钮
function cancel() {
  open.value = false;
  reset();
}

// 表单重置
function reset() {
  form.value = {
    id: null,
    requestUrl: null,
    requestPtsUrl: null,
    requestParam: null,
    responseBody: null,
    requestId: null,
    requestNum: null,
    costTime: null,
    requestIp: null,
    createTime: null,
    updateTime: null
  };
  proxy.resetForm("ptsApiLogRef");
}

/** 搜索按钮操作 */
function handleQuery() {
  queryParams.value.pageNum = 1;
  getList();
}

/** 重置按钮操作 */
function resetQuery() {
  daterangeCreateTime.value = [];
  proxy.resetForm("queryRef");
  handleQuery();
}

// 多选框选中数据
function handleSelectionChange(selection) {
  ids.value = selection.map(item => item.id);
  single.value = selection.length != 1;
  multiple.value = !selection.length;
}

/** 新增按钮操作 */
function handleAdd() {
  reset();
  open.value = true;
  title.value = "添加pts日志";
}

/** 修改按钮操作 */
function handleUpdate(row) {
  reset();
  const _id = row.id || ids.value
  getPtsApiLog(_id).then(response => {
    form.value = response.data;
    open.value = true;
    title.value = "修改pts日志";
  });
}

/** 提交按钮 */
function submitForm() {
  proxy.$refs["ptsApiLogRef"].validate(valid => {
    if (valid) {
      if (form.value.id != null) {
        updatePtsApiLog(form.value).then(response => {
          proxy.$modal.msgSuccess("修改成功");
          open.value = false;
          getList();
        });
      } else {
        addPtsApiLog(form.value).then(response => {
          proxy.$modal.msgSuccess("新增成功");
          open.value = false;
          getList();
        });
      }
    }
  });
}

/** 删除按钮操作 */
function handleDelete(row) {
  const _ids = row.id || ids.value;
  proxy.$modal.confirm('是否确认删除pts日志编号为"' + _ids + '"的数据项？').then(function() {
    return delPtsApiLog(_ids);
  }).then(() => {
    getList();
    proxy.$modal.msgSuccess("删除成功");
  }).catch(() => {});
}

/** 导出按钮操作 */
function handleExport() {
  proxy.download('social/ptsApiLog/export', {
    ...queryParams.value
  }, `ptsApiLog_${new Date().getTime()}.xlsx`)
}

getList();
</script>
