---
title: maven本地仓库安装依赖
cover: https://wls-blog-img.oss-cn-shenzhen.aliyuncs.com/wallhaven-6ok36q.jpg
date: 2021-02-05 11:24:53
updated: 2021-02-05 11:24:53

categories:
  - 后端开发

tags:
  - maven

---


### maven本地仓库安装依赖 仅需一个命令

```cmd
mvn install:install-file -DgroupId=com.github.whvcse -DartifactId=EasyCaptcha -Dversion=1.6.2 -Dpackaging=jar -Dfile=C:\other\easy-captcha-1.6.2.jar
```

### 以上命令参数说明

- -DgroupId			对应pom文件中的groupId

  ![](https://erectpine-blog.oss-cn-chengdu.aliyuncs.com/post/maven-install-jar/1612504592493.png)

- -DartifactId         对应pom文件中的artifactId

  ![](https://erectpine-blog.oss-cn-chengdu.aliyuncs.com/post/maven-install-jar/1612504608216.png)

- -Dversion             对应pom文件中的version

  ![](https://erectpine-blog.oss-cn-chengdu.aliyuncs.com/post/maven-install-jar/1612504629736.png)

- -Dpackaging           安装包类型，通常为jar

- -Dfile                包所在路径（绝对路径，最好不要有中文）

![](https://erectpine-blog.oss-cn-chengdu.aliyuncs.com/post/maven-install-jar/1612504534337.png)

### 出现以上信息即为安装完成

### 若运行命令出现 “不是内部或外部命令，也不是可运行的程序或批处理文件。“ 可参考我[上篇文章](https://erectpine.cn/2021/02/02/maven-profile/)配置mvn环境变量
