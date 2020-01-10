<?php

Class Test3
{
    /**
     * 发送聊天消息
     *
     * <pre>
     * group: send
     * method: game/send_chat_msg
     * params:
     *   - name: chat_msg
     *     required: true
     *     param_type: string
     *     desc: 聊天消息
     *   - name: chat_sn
     *     required: true
     *     param_type: string
     *     desc: 消息唯一ID
     * errors:
     *   40000: 参数缺失
     *   40004: 操作失败！未找到进行中的聊天房间
     * result:
     *   code: 操作码
     *   message: 操作说明
     *   data{}: 返回数据
     *   data{}.send_player_id: 发送消息玩家ID
     *   data{}.chat_msg: 聊天消息
     *   data{}.chat_sn: 消息唯一ID
     * remark_before_md: |
     * remark_after_md: |
     * example_request: |
     *   {
     *      "id": "yHs6ndAXiyi6spTSKPRXX26dSeTRa4xx",
     *      "jsonrpc": "2.0",
     *      "method": "game/send_chat_msg",
     *      "params": {
     *          "chat_msg": "123",
     *          "chat_sn": "Dhy84razsSeh7WPSiAdW7EsZ76fyt267"
     *     }
     *   }
     * example_response: |
     *   {
     *      "jsonrpc": "2.0",
     *      "result": {
     *          "code": 20002,
     *          "message": "聊天数据",
     *          "data": {
     *              "send_player_id": "rPBDTm5PKh",
     *              "chat_msg": "123",
     *              "chat_sn": "Dhy84razsSeh7WPSiAdW7EsZ76fyt267"
     *         }
     *     },
     *     "id": "29ad53a591c26c8a0e698208118b6ea6"
     *   }
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