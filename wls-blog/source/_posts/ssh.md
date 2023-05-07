---
title: git配置ssh秘钥实现免密登录
date: 2021-01-29 11:46:02
updated: 2021-02-02 09:50:16
cover: https://wls-blog-img.oss-cn-shenzhen.aliyuncs.com/wallhaven-wqyk77.png

categories:
  - 学习笔记
tags:
  - git
  - ssh

---

### 生成秘钥

- ED25519 密钥

- RSA 密钥

  [Practical Cryptography With Go](https://leanpub.com/gocrypto/read#leanpub-auto-chapter-5-digital-signatures) 一书中表明 ED25519 密钥比 RSA 密钥更为安全。

此处以ED25519为例
打开Git Bash Here, 输入以下命令, 此处需要连敲三次回车：

```shell
    ssh-keygen -t ed25519 -C "<comment>" 
```
### 添加公钥到版本管理服务器
	以码云为例:
    此时生成好的秘钥位于用户目录下.ssh文件夹中

### 复制公钥(ssh文件夹下以.pub结尾的文件)中的内容

![](https://erectpine-blog.oss-cn-chengdu.aliyuncs.com/git-ssh/1611901840050.png)

![](https://erectpine-blog.oss-cn-chengdu.aliyuncs.com/git-ssh/1611901872244.png)

### 打开码云 进入设置页面

![](https://erectpine-blog.oss-cn-chengdu.aliyuncs.com/git-ssh/1611901987885.png)

### 点击左侧ssh公钥

![](https://erectpine-blog.oss-cn-chengdu.aliyuncs.com/git-ssh/1611901711241.png)

### 将公钥内容复制到此处, 起个好听的名字

![](https://erectpine-blog.oss-cn-chengdu.aliyuncs.com/git-ssh/1611902190170.png)

### OK,到此ssh秘钥配置完成,可以开始不用输入密码拉取代码啦!

