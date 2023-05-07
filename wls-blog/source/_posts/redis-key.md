---
title: Redis基本命令-key相关
date: 2021-02-01 17:10:09
updated: 2021-02-01 17:10:09
cover: https://wls-blog-img.oss-cn-shenzhen.aliyuncs.com/wallhaven-o3x3pp.png

categories:
  - 后端开发
tags:
  - Redis
---


### 添加元素

```shell
    set k1 v1
```

### DEL命令 删除

```shell
    DEL k1
```
### DUMP命令 序列化

```shell
    DUMP k1
```
### EXISTS命令

```shell
    127.0.0.1:6379> EXISTS k1
    (integer) 1
    127.0.0.1:6379> EXISTS k2
    (integer) 0
    127.0.0.1:6379>
    
    1 存在 
    0 不存在
```

### TTL命令 查看一个key给定的有效期

```shell
    127.0.0.1:6379> TTL k1
    (integer) -1
    127.0.0.1:6379> TTL k2
    (integer) -2
    
    -2表示key不存在或者已过期；-1表示key存在并且没有设置过期时间（永久有效
```

### EXPIRE命令 给key设置有效期

```shell
    127.0.0.1:6379> EXPIRE k1 30
    (integer) 1
    127.0.0.1:6379> TTL k1
    (integer) 25

    30表示30秒，TTL k1返回25表示这个key的有效期还剩25秒。
```

### PERSIST命令 PERSIST命令表示移除一个key的过期时间，这样该key就永远不会过期

 ```shell
    127.0.0.1:6379> EXPIRE k1 60
    (integer) 1
    127.0.0.1:6379> ttl k1
    (integer) 57
    127.0.0.1:6379> PERSIST k1
    (integer) 1
    127.0.0.1:6379> ttl k1
    (integer) -1
```

### PEXPIRE命令

```shell
    PEXPIRE命令的功能和EXPIRE命令的功能基本一致，只不过这里设置的参数是毫秒
    127.0.0.1:6379> PEXPIRE k1 60000
    (integer) 1
```

### PTTL命令

```shell
    PTTL命令和TTL命令基本一致，只不过PTTL返回的是毫秒数
```

### KEYS 命令

```shell
    127.0.0.1:6379> KEYS *
    1) "k3"
    2) "k2"
    3) "k1"

    KEYS *表示获取所有的KEY，*也可以是一个正则表达式
```
    


