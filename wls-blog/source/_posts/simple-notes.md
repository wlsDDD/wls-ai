---
title: 随笔记
cover: https://wls-blog-img.oss-cn-shenzhen.aliyuncs.com/wallhaven-rd295j.jpg
date: 2021-02-02 09:34:03
updated: 2021-02-07 14:56:06
sticky: 99

categories:
  - 学习笔记

tags:
  - git
  - npm
  - win10
  - nginx
---



# git

### 	拉取代码并覆盖本地

```shell
git fetch --all && git reset --hard master && git pull
```

### 冲突时强制提交

```
git push -u origin dev -f
```

### 基本配置

```
git config --global user.name "wls"
git config --global user.email 1626961806@qq.com
```



# nacos

### 单机启动

```shell
sh startup.sh -m standalone
```



# npm

### 配置淘宝镜像源

```shell
npm install -g cnpm --registry=https://registry.npm.taobao.org
```

### 解决下载慢问题

```shell
npm install --registry=https://registry.npm.taobao.org
```

# Windows

### 官方装机系统下载

[https://www.microsoft.com/zh-cn/software-download/windows10](https://www.microsoft.com/zh-cn/software-download/windows10)



# MySQL

#### 配置默认创建时间：

```mysql
CURRENT_TIMESTAMP
```

```mysql
DEFAULT CURRENT_TIMESTAMP(3) ON UPDATE CURRENT_TIMESTAMP(3)
```

