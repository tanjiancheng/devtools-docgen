# 文档标题

采用websocket协议发送

全局错误码:

  -1000: 协议错误

  -1002: 请求参数缺失

---

- [send]
  - [发送聊天消息](##发送聊天消息)
- [Test3]
  - [test3Function2](##test3Function2)
- [Test4]
  - [test4Function1](##test4Function1)
  - [test4Function2](##test4Function2)
- [Test2]
  - [匹配玩家](##匹配玩家)
- [test1Function1](##test1Function1)


## 发送聊天消息

* 请求地址: 

```
{
   "id": "yHs6ndAXiyi6spTSKPRXX26dSeTRa4xx",
   "jsonrpc": "2.0",
   "method": "game/send_chat_msg",
   "params": {
       "chat_msg": "123",
       "chat_sn": "Dhy84razsSeh7WPSiAdW7EsZ76fyt267"
  }
}
```
* 请求方法: game/send_chat_msg
* 请求参数: 

|参数名|是否必选|参数类型|说明|
|:---|---|---|---|
|chat_msg|是|string|聊天消息|
|chat_sn|是|string|消息唯一ID|

* 响应数据: 

|字段|说明|
|:---|---|
|code|操作码|
|message|操作说明|
|data{}|返回数据|
|data{}.send_player_id|发送消息玩家ID|
|data{}.chat_msg|聊天消息|
|data{}.chat_sn|消息唯一ID|

* 错误码: 

|字段|说明|
|:---:|---|
|40000|参数缺失|
|40004|操作失败！未找到进行中的聊天房间|

* 返回数据示例: 

```
{
   "jsonrpc": "2.0",
   "result": {
       "code": 20002,
       "message": "聊天数据",
       "data": {
           "send_player_id": "rPBDTm5PKh",
           "chat_msg": "123",
           "chat_sn": "Dhy84razsSeh7WPSiAdW7EsZ76fyt267"
      }
  },
  "id": "29ad53a591c26c8a0e698208118b6ea6"
}

```


---
## test3Function2

* 请求地址: 

```
http://<domain>/app/get_config
```
* 请求方法: POST
* 前置说明: 

前置说明

* 请求参数: 

|参数名|是否必选|参数类型|说明|
|:---|---|---|---|
|id|是|int|商品id|
|game_zone|是|string|游戏大区|

* 响应数据: 

|字段|说明|
|:---|---|
|account|账号|

* 错误码: 

|字段|说明|
|:---:|---|
|-20001|系统处理中|
|-20002|系统错误|

* 其他说明: 

后置说明

* 返回数据示例: 

```
{
    "code": 1,
    "status": 1,
    "msg": "",
    "message": "",
    "data": {
        "session_id": "RC5HhrnjO0ij6aqf5Ym9d0mFeENj7I7rLBJswuEx",
        "request_id": "0fc71fd42706dc7717e7e053617e4f1ac9fbf3c0"
    }
}

```


---
## test4Function1

* 请求地址: 

```
http://<domain>/app/get_config
```
* 请求方法: POST
* 前置说明: 

前置说明

* 请求参数: 

|参数名|是否必选|参数类型|说明|
|:---|---|---|---|
|id|是|int|商品id|
|game_zone|是|string|游戏大区|

* 响应数据: 

|字段|说明|
|:---|---|
|account|账号|

* 错误码: 

|字段|说明|
|:---:|---|
|-20001|系统处理中|
|-20002|系统错误|

* 其他说明: 

后置说明

* 返回数据示例: 

```
{
    "code": 1,
    "status": 1,
    "msg": "",
    "message": "",
    "data": {
        "session_id": "RC5HhrnjO0ij6aqf5Ym9d0mFeENj7I7rLBJswuEx",
        "request_id": "0fc71fd42706dc7717e7e053617e4f1ac9fbf3c0"
    }
}

```


---
## test4Function2

* 请求地址: 

```
http://<domain>/app/get_config
```
* 请求方法: POST
* 前置说明: 

前置说明

* 请求参数: 

|参数名|是否必选|参数类型|说明|
|:---|---|---|---|
|id|是|int|商品id|
|game_zone|是|string|游戏大区|

* 响应数据: 

|字段|说明|
|:---|---|
|account|账号|

* 错误码: 

|字段|说明|
|:---:|---|
|-20001|系统处理中|
|-20002|系统错误|

* 其他说明: 

后置说明

* 返回数据示例: 

```
{
    "code": 1,
    "status": 1,
    "msg": "",
    "message": "",
    "data": {
        "session_id": "RC5HhrnjO0ij6aqf5Ym9d0mFeENj7I7rLBJswuEx",
        "request_id": "0fc71fd42706dc7717e7e053617e4f1ac9fbf3c0"
    }
}

```


---
## test1Function1

* 请求地址: 

```
http://<domain>/app/get_config
```
* 请求方法: POST
* 前置说明: 

前置说明

* 请求参数: 

|参数名|是否必选|参数类型|说明|
|:---|---|---|---|
|id|是|int|商品id|
|game_zone|是|string|游戏大区|

* 响应数据: 

|字段|说明|
|:---|---|
|account|账号|

* 错误码: 

|字段|说明|
|:---:|---|
|-20001|系统处理中|
|-20002|系统错误|

* 其他说明: 

后置说明

* 返回数据示例: 

```
{
    "code": 1,
    "status": 1,
    "msg": "",
    "message": "",
    "data": {
        "session_id": "RC5HhrnjO0ij6aqf5Ym9d0mFeENj7I7rLBJswuEx",
        "request_id": "0fc71fd42706dc7717e7e053617e4f1ac9fbf3c0"
    }
}

```


---
## 匹配玩家

* 请求地址: 

```
{
    "id": "XQPieFsDzettF6HzH8mE682fZMT7336w",
    "jsonrpc": "2.0",
    "method": 'game/match_player',
    'params': []
}
```
* 请求方法: test2Function1
* 响应数据: 

|字段|说明|
|:---|---|
|code|操作码|
|message|操作说明|
|data{}|返回数据|

* 错误码: 

|字段|说明|
|:---:|---|
|40003|您有一场进行中的聊天房间|

* 返回数据示例: 

```
{
    "jsonrpc": "2.0",
    "result": {
        "code": 20000,
        "message": "success",
        "data": []
    },
    "id": "XQPieFsDzettF6HzH8mE682fZMT7336w"
}

```