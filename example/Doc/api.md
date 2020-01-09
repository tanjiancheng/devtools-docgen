- [send]
  - [匹配玩家](##匹配玩家)
- [Test3]
  - [test3Function2](##test3Function2)
- [Test4]
  - [test4Function1](##test4Function1)
  - [test4Function2](##test4Function2)
- [Test1]
  - [test1Function1](##test1Function1)


## 匹配玩家

* 请求URL: 

{
    "id": "XQPieFsDzettF6HzH8mE682fZMT7336w",
    "jsonrpc": "2.0",
    "method": 'game/match_player',
    'params': []
}

* 请求方法: 

game/match_player
* 前置说明: 



* 请求参数: 

* 响应数据	: 

|字段|说明|
|:---:|---|
|code|操作码|
|message|操作说明|
|data{}|返回数据|

* 错误码	: 

|字段|说明|
|:---:|---|
|40003|您有一场进行中的聊天房间|

* 其他说明: 



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

## test3Function2

* 请求URL: 

http://<domain>/app/get_config

* 请求方法: 

POST
* 前置说明: 

前置说明

* 请求参数: 

|参数名|是否必选|参数类型|说明|
|:---:|---|---|---|
|id|1|int|商品id|
|game_zone|1|string|游戏大区|

* 响应数据	: 

|字段|说明|
|:---:|---|
|account|账号|

* 错误码	: 

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

## test4Function1

* 请求URL: 

http://<domain>/app/get_config

* 请求方法: 

POST
* 前置说明: 

前置说明

* 请求参数: 

|参数名|是否必选|参数类型|说明|
|:---:|---|---|---|
|id|1|int|商品id|
|game_zone|1|string|游戏大区|

* 响应数据	: 

|字段|说明|
|:---:|---|
|account|账号|

* 错误码	: 

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

## test4Function2

* 请求URL: 

http://<domain>/app/get_config

* 请求方法: 

POST
* 前置说明: 

前置说明

* 请求参数: 

|参数名|是否必选|参数类型|说明|
|:---:|---|---|---|
|id|1|int|商品id|
|game_zone|1|string|游戏大区|

* 响应数据	: 

|字段|说明|
|:---:|---|
|account|账号|

* 错误码	: 

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

## test1Function1

* 请求URL: 

http://<domain>/app/get_config

* 请求方法: 

POST
* 前置说明: 

前置说明

* 请求参数: 

|参数名|是否必选|参数类型|说明|
|:---:|---|---|---|
|id|1|int|商品id|
|game_zone|1|string|游戏大区|

* 响应数据	: 

|字段|说明|
|:---:|---|
|account|账号|

* 错误码	: 

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

