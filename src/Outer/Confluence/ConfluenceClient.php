<?php

namespace Devtools\Docgen\Outer\Confluence;

use GuzzleHttp\Client;

/**
 * @link https://docs.atlassian.com/atlassian-confluence/REST/latest/
 * @link https://developer.atlassian.com/confdev/confluence-rest-api/confluence-rest-api-examples
 */
class ConfluenceClient
{
    /**
     * http客户端对象
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * 接口地址
     *
     * @var string
     */
    protected $api;

    /**
     * 账号
     *
     * @var string
     */
    protected $username;

    /**
     * 密码
     *
     * @var string
     */
    protected $password;

    protected $spaceKey;

    /**
     * 构造函数
     *
     * @param string $api 接口地址
     * @param string $username 账号
     * @param string $password 密码
     */
    public function __construct($api, $username, $password, $spaceKey)
    {
        $this->api = rtrim((string)$api, '/');
        $this->username = (string)$username;
        $this->password = (string)$password;
        $this->spaceKey = (string)$spaceKey;
        $this->client = new Client([
            'base_uri' => $this->api,
            'timeout' => 10,
            'http_errors' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->username . ':' . $this->password),
            ],
        ]);
    }

    /**
     * 接口调用
     *
     * @param string $method 请求类型
     * @param string $path 接口路径
     * @param array $params 参数列表
     *
     * @return array
     */
    public function call($method, $path, array $params = [])
    {
        $method = strtoupper($method);

        $options = [];
        switch ($method) {
            case 'GET':
            case 'DELETE':
                $options['query'] = http_build_query($params);
                break;
            case 'POST':
            case 'PUT':
                $options['body'] = json_encode($params);
                break;
        }

        $response = $this->client->request($method, $path, $options);
        $status = $response->getStatusCode();
        $result = (array)json_decode($response->getBody()->getContents(), true);
        return [$status, $result];
    }

    /**
     * 接口调用魔术方法
     *
     * @param string $method http请求类型
     * @param array $args 参数列表
     *
     * @return array
     */
    public function __call($method, $args)
    {
        array_unshift($args, $method);
        return call_user_func_array([$this, 'call'], $args);
    }

    /**
     * 获取文档页
     *
     * @param string $title 文档标题
     * @param string $spaceKey 文档空间key
     *
     * @return array|null
     */
    public function getContentByTitle($title, $spaceKey = '')
    {
        $params = [
            'title' => $title,
            'spaceKey' => $spaceKey,
            'expand' => 'version',
        ];
        list($status, $result) = $this->call('GET', '/rest/api/content', $params);
        if (isset($result['results']) && is_array($result['results'])) {
            foreach ($result['results'] as $content) {
                if ($content['title'] == $title) {
                    return $content;
                }
            }
        }

        return;
    }

    /**
     * 根据标题获取链接
     *
     * @param string $title 标题
     *
     * @return string
     */
    public function getLink($title)
    {
        $confluence = new self(
            $this->api,
            $this->username,
            $this->password,
            $this->spaceKey
        );

        $result = $confluence->getContentByTitle($title, $this->spaceKey);
        if (isset($result['_links'])) {
            $link = sprintf(
                '%s%s',
                rtrim($this->api, '/'),
                $result['_links']['webui']
            );
        } else {
            $link = '#';
        }
        return ($link == '#') ? '' : $link;
    }
}
