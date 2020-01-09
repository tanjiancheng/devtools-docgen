<?php

Class Test3
{
    /**
     * 匹配玩家
     *
     * <pre>
     * group: send
     * method: game/match_player
     * params:
     * errors:
     *     40003: 您有一场进行中的聊天房间
     * result:
     *   code: 操作码
     *   message: 操作说明
     *   data{}: 返回数据
     * remark_before_md: |
     * remark_after_md: |
     * example_request: |
     *  {
     *      "id": "XQPieFsDzettF6HzH8mE682fZMT7336w",
     *      "jsonrpc": "2.0",
     *      "method": 'game/match_player',
     *      'params': []
     *  }
     * example_response: |
     *  {
     *      "jsonrpc": "2.0",
     *      "result": {
     *          "code": 20000,
     *          "message": "success",
     *          "data": []
     *      },
     *      "id": "XQPieFsDzettF6HzH8mE682fZMT7336w"
     *  }
     * </pre>
     */
    public function test3Function1()
    {
    }

    /**
     * test3Function2
     *
     * <pre>
     * group: Test3
     * uri: /app/get_config
     * method: POST
     * params:
     *   - name: id
     *     required: true
     *     param_type: int
     *     desc: 商品id
     *   - name: game_zone
     *     required: true
     *     param_type: string
     *     desc: 游戏大区
     * errors:
     *   -20001: 系统处理中
     *   -20002: 系统错误
     * result:
     *   account: 账号
     * remark_before_md: |
     *   前置说明
     * remark_after_md: |
     *   后置说明
     * example_request: |
     *   http://<domain>/app/get_config
     * example_response: |
     *   {
     *       "code": 1,
     *       "status": 1,
     *       "msg": "",
     *       "message": "",
     *       "data": {
     *           "session_id": "RC5HhrnjO0ij6aqf5Ym9d0mFeENj7I7rLBJswuEx",
     *           "request_id": "0fc71fd42706dc7717e7e053617e4f1ac9fbf3c0"
     *       }
     *   }
     * </pre>
     */
    public function test3Function2()
    {
    }
}