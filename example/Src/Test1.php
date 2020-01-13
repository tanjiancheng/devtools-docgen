<?php
Class Test1 {

    /**
     * test1Function1
     *
     * <yamlDoc>
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
     * remark_before: |
     *   前置说明
     * remark_after: |
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
     * </yamlDoc>
     */
    public function test1Function1(){}
    public function test1Function2(){}
}