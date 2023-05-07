---
title: maven配置环境变量
cover: https://wls-blog-img.oss-cn-shenzhen.aliyuncs.com/wallhaven-7232p9.jpg
date: 2021-02-02 10:09:09
updated: 2021-02-02 10:09:09

categories:
  - 后端开发

tags:
  - maven

---

### win10配置maven环境变量仅需两步

### 1. 添加maven环境变量

```text
key: MAVEN_HOME
value: maven解压目录
```

![](https://erectpine-blog.oss-cn-chengdu.aliyuncs.com/post/maven-profile/1612407402461.png)

### 2. 将maven环境变量追加到path后面

```text
%MAVEN_HOME%\bin\;
```

![](https://erectpine-blog.oss-cn-chengdu.aliyuncs.com/post/maven-profile/1612505955496.png)

### ok maven环境配置搞定 测试

```powershell
mvn -v
```

![](https://erectpine-blog.oss-cn-chengdu.aliyuncs.com/post/maven-profile/1612505916701.png)