---
title: MySQL递归查询
date: 2021-01-29 14:55:32
updated: 2021-02-02 09:50:16
cover: https://wls-blog-img.oss-cn-shenzhen.aliyuncs.com/wallhaven-m9q6e9.jpg

categories:
  - 后端开发

tags:
  - sql
  - mysql
  - 递归查询
---


## MySQL递归查询

### 语法
```oracle
    START WITH 起始节点 CONNECT BY PRIOR 树表ID关联关系
```

### 查询自己及其所有子节点
```oracle
    SELECT * FROM table_name START WITH NAME = '酒水' CONNECT BY PRIOR ID = PID
```

### 查询自己及其所有父节点
```oracle
    SELECT * FROM table_name START WITH NAME = '酒水' CONNECT BY PRIOR PID = ID
```

### 查询所有子节点
```oracle
    SELECT * FROM table_name START WITH PID = 1 CONNECT BY PRIOR ID = PID
```

### 查询所有父节点
```oracle
    SELECT * FROM table_name START WITH ID IN ( SELECT PID FROM T_PRODUCT_TYPE WHERE ID = 137) CONNECT BY PRIOR PID = ID
```

