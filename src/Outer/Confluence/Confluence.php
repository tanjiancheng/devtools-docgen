<?php

namespace Devtools\Docgen\Outer\Confluence;

use Devtools\Docgen\Outer\Base;
use Michelf\MarkdownExtra;

class Confluence extends Base
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function out()
    {
        $content = $this->getConfluenceFormatText();
        $title = $this->overview->getTitle();
        $link = $this->sendToConfluence($title, $content);
        return $link;
    }

    private function getConfluenceFormatText()
    {
        $doc = '';
        $doc .= "<h2>目录</h2>\n";
        $doc .= "<p>\n<ac:structured-macro ac:name=\"toc\">\n";
        $doc .= "<ac:parameter ac:name=\"exclude\">目录|接口使用说明</ac:parameter>\n";
        $doc .= "</ac:structured-macro>\n</p>\n";
        $doc .= "<h2>接口使用说明</h2>\n";
        $doc .= sprintf("%s\n", MarkdownExtra::defaultTransform($this->overview->getDescription()));

        $divideToGroups = [];
        /**
         * @var $api Api
         */
        foreach ($this->apis as $api) {
            $divideToGroups[$api->getGroup()][] = $api;
        }

        foreach ($divideToGroups as $groupName => $apis) {
            /**
             * @var $api Api
             */
            foreach ($apis as $api) {
                if (!empty($groupName)) {
                    $doc .= "<h2>{$groupName}</h2>\n\n";
                }

                $uri = sprintf("<code>%s</code>", $api->getUri());
                $method = sprintf('<code>%s</code>', $api->getMethod());

                //params处理
                $params = '';
                if (!empty($api->getParams())) {
                    $params .= "<table>\n<tr>\n<th><code>参数名</code></th>\n<th><code>是否必选</code></th>\n<th><code>参数类型</code></th>\n<th><code>说明</code></th>\n</tr>";
                    foreach ($api->getParams() as $param) {
                        $params .= sprintf(
                            "\n<tr>\n<td><code>%s</code></td>\n<td><code>%s</code></td>\n<td><code>%s</code></td>\n<td><code>%s</code></td>\n</tr>",
                            $param['name'],
                            $param['required'] ? '是' : '否',
                            $param['param_type'],
                            $param['desc']
                        );
                    }
                    $params .= "\n</table>";
                }

                //错误码
                $errors = '<table>';
                $errors .= "\n<tr>\n<th><code>字段</code></th>\n<th><code>说明</code></th>\n</tr>";
                if (!empty($api->getErrors())) {
                    foreach ($api->getErrors() as $errorKey => $errorValue) {
                        $errors .= sprintf("\n<tr>\n<td><code>%s</code></td>\n<td><code>%s</code></td>\n</tr>", $errorKey, $errorValue);
                    }
                }
                $errors .= "\n</table>";

                //响应数据
                $result = '<table>';
                $result .= "\n<tr>\n<th><code>字段</code></th>\n<th><code>说明</code></th>\n</tr>";
                foreach ($api->getResult() as $resultKey => $resultValue) {
                    $result .= sprintf("\n<tr>\n<td><code>%s</code></td>\n<td><code>%s</code></td>\n</tr>", $resultKey, $resultValue);
                }
                $result .= "\n</table>";

                $remarkBefore = '';
                if ($api->getRemarkBefore()) {
                    $remarkBefore = '<pre>' . rtrim(htmlspecialchars($api->getRemarkBefore(), ENT_NOQUOTES)) . '</pre>';
                }

                $remarkAfter = '';
                if ($api->getRemarkAfter()) {
                    $remarkAfter = '<pre>' . rtrim(htmlspecialchars($api->getRemarkAfter(), ENT_NOQUOTES)) . '</pre>';
                }

                $exampleRequest = '';
                if ($api->getExampleRequest()) {
                    $exampleRequest = '<ac:structured-macro ac:name="code"><ac:plain-text-body><![CDATA[' . rtrim($api->getExampleRequest()) . ']]></ac:plain-text-body></ac:structured-macro>';
                }

                $exampleResponse = '';
                if ($api->getExampleResponse()) {
                    $temp = json_decode($api->getExampleResponse(), true);
                    if (is_array($temp)) {
                        $api->setExampleResponse(json_encode($temp, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                    }
                    $exampleResponse = '<ac:structured-macro ac:name="code"><ac:plain-text-body><![CDATA[' . rtrim($api->getExampleResponse()) . ']]></ac:plain-text-body></ac:structured-macro>';
                }

                if (!empty($groupName)) {
                    $doc .= "<h3>{$api->getTitle()}</h3>\n";
                } else {
                    $doc .= "<h2>{$api->getTitle()}</h2>\n";
                }

                $doc .= "<table>\n";
                $doc .= "<tr>\n<th style=\"min-width: 56px;\">接口地址</th>\n<td style=\"max-width: 800px; overflow: hidden;\">{$uri}</td>\n</tr>\n";
                $doc .= "<tr>\n<th style=\"min-width: 56px;\">请求方法</th>\n<td style=\"max-width: 800px; overflow: hidden;\">{$method}</td>\n</tr>\n";
                $doc .= "<tr>\n<th style=\"min-width: 56px;\">前置说明</th>\n<td style=\"max-width: 800px; overflow: hidden;\">\n{$remarkBefore}\n</td>\n</tr>\n";
                $doc .= "<tr>\n<th style=\"min-width: 56px;\">请求参数</th>\n<td style=\"max-width: 800px; overflow: hidden;\">\n{$params}\n</td>\n</tr>\n";
                $doc .= "<tr>\n<th style=\"min-width: 56px;\">错误码</th>\n<td style=\"max-width: 800px; overflow: hidden;\">\n{$errors}\n</td>\n</tr>\n";
                $doc .= "<tr>\n<th style=\"min-width: 56px;\">响应数据</th>\n<td style=\"max-width: 800px; overflow: hidden;\">\n{$result}\n</td>\n</tr>\n";
                $doc .= "<tr>\n<th style=\"min-width: 56px;\">其他说明</th>\n<td style=\"max-width: 800px; overflow: hidden;\">\n{$remarkAfter}\n</td>\n</tr>\n";
                $doc .= "<tr>\n<th style=\"min-width: 56px;\">请求示例</th>\n<td style=\"max-width: 800px; overflow: hidden;\">\n{$exampleRequest}\n</td>\n</tr>\n";
                $doc .= "<tr>\n<th style=\"min-width: 56px;\">响应示例</th>\n<td style=\"max-width: 800px; overflow: hidden;\">\n{$exampleResponse}\n</td>\n</tr>\n";

                $doc .= "</table>\n";
            }
        }

        return trim($doc);
    }

    /**
     * 发送文档到confluence
     *
     * @param string $group 分组
     * @param string $title 文档标题
     * @param string $document 文档内容
     */
    protected function sendToConfluence($title, $document)
    {
        $confluence = new ConfluenceClient(
            $this->config['api'],
            $this->config['username'],
            $this->config['password'],
            $this->config['space_key']
        );

        $spaceKey = (string)$this->config['space_key'];
        $spacePageId = (int)$this->config['space_page_id'];
        $groupTitle = $this->config['group'];
        $groupDocument = '<h2>目录</h2><p><ac:structured-macro ac:name="children" /></p>';
        $groupContent = $confluence->getContentByTitle($groupTitle, $spaceKey);
        if (!$groupContent) {
            list($status, $result) = $confluence->post('/rest/api/content', [
                'type' => 'page',
                'space' => ['key' => $spaceKey],
                'ancestors' => [['id' => $spacePageId]],
                'title' => $groupTitle,
                'body' => ['storage' => ['value' => $groupDocument, 'representation' => 'storage']],
            ]);
            $groupContent = $confluence->getContentByTitle($groupTitle, $spaceKey);
        }
        $groupPageId = isset($groupContent['id']) ? $groupContent['id'] : 0;

        $content = $confluence->getContentByTitle($title, $spaceKey);
        if ($content) {
            list($status, $result) = $confluence->put('/rest/api/content/' . $content['id'], [
                'id' => $content['id'],
                'type' => 'page',
                'space' => ['key' => $spaceKey],
                'ancestors' => [['id' => $groupPageId]],
                'title' => $title,
                'body' => ['storage' => ['value' => $document, 'representation' => 'storage']],
                'version' => ['number' => $content['version']['number'] + 1],
            ]);
        } else {
            list($status, $result) = $confluence->post('/rest/api/content', [
                'type' => 'page',
                'space' => ['key' => $spaceKey],
                'ancestors' => [['id' => $groupPageId]],
                'title' => $title,
                'body' => ['storage' => ['value' => $document, 'representation' => 'storage']],
            ]);
        }

        if (!isset($result['_links'])) {
            var_dump($result);
        } else {
            $link = sprintf("%s%s", $result['_links']['base'], $result['_links']['webui']);
            return $link;
        }
    }
}