<?php

Class Test2
{
    /**
     * 匹配玩家
     *
     * <pre>
     * group: Test2
     * method: test2Function1
     * params:
     * errors:
     *   40003: 您有一场进行中的聊天房间
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
     * @param Player $player
     * @throws ResultException
     */
    public function test2Function1()
    {
    }

    public function test2Function2()
    {
    }
}