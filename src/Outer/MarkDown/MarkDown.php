<?php

namespace Devtools\Docgen\Outer\MarkDown;

use Devtools\Docgen\Entity\Api;
use Devtools\Docgen\Outer\Base;

class MarkDown extends Base
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function out()
    {
        $stream = $this->config['stream'] ?? 'php://stdout';
        if ($stream != 'php://stdout' && !is_file($stream)) {
            @mkdir(dirname($stream), 0777, true);
        }
        $fileHandle = fopen($stream, "w");
        $content = $this->getMarkDownFormatText();
        $content = str_replace('\n', PHP_EOL, $content);
        fwrite($fileHandle, $content);
        fclose($fileHandle);
        return $stream;
    }

    private function getMarkDownFormatText()
    {
        $divideToGroups = [];
        /**
         * @var $api Api
         */
        foreach ($this->apis as $api) {
            $divideToGroups[$api->getGroup()][] = $api;
        }

        //文档概况
        $overview = '';
        if ($this->overview->getTitle()) {
            $overview .= sprintf('# %s\n', $this->overview->getTitle());
            $overview .= sprintf('%s\n', $this->overview->getDescription());
            $overview .= '\n---';
        }
        if (strlen($overview)) {
            $overview .= '\n\n';
        }

        //导航头
        $nav = '';
        foreach ($divideToGroups as $groupName => $apis) {
            if (empty($groupName)) {
                continue;
            }
            $nav .= sprintf('- [%s]\n', $groupName);
            /**
             * @var $api Api
             */
            foreach ($apis as $api) {
                $nav .= sprintf('  - [%s](##%s)\n', $api->getTitle(), $api->getTitle());
            }
        }
        //group为空的是一级目录
        foreach ($divideToGroups as $groupName => $apis) {
            if (empty($groupName)) {
                /**
                 * @var $api Api
                 */
                foreach ($apis as $api) {
                    $nav .= sprintf('- [%s](##%s)\n', $api->getTitle(), $api->getTitle());
                }
            }
        }
        if (strlen($nav)) {
            $nav .= '\n\n';
        }


        //文档内容
        $doc = '';
        foreach ($divideToGroups as $groupName => $apis) {
            /**
             * @var $api Api
             */
            foreach ($apis as $api) {
                $doc .= sprintf('## %s\n\n', $api->getTitle());
                if (trim($api->getExampleRequest())) {
                    $doc .= sprintf('* 请求地址: \n\n```\n%s```\n', $api->getExampleRequest());
                }
                if (trim($api->getMethod())) {
                    $doc .= sprintf('* 请求方法: %s\n', $api->getMethod());
                }
                if (trim($api->getRemarkBefore())) {
                    $doc .= sprintf('* 前置说明: \n\n%s\n', $api->getRemarkBefore());
                }


                //params处理
                if (!empty($api->getParams())) {
                    $doc .= sprintf('* 请求参数: \n\n');
                    $doc .= sprintf('|参数名|是否必选|参数类型|说明|\n');
                    $doc .= sprintf('|:---|---|---|---|\n');
                    foreach ($api->getParams() as $param) {
                        $doc .= sprintf('|%s|%s|%s|%s|\n', $param['name'], $param['required'] ? '是' : '否', $param['param_type'], $param['desc']);
                    }

                    $doc .= '\n';
                }

                //result
                if (!empty($api->getResult())) {
                    $doc .= sprintf('* 响应数据: \n\n');
                    $doc .= sprintf('|字段|说明|\n');
                    $doc .= sprintf('|:---|---|\n');
                    foreach ($api->getResult() as $resultKey => $resultValue) {
                        $doc .= sprintf('|%s|%s|\n', $resultKey, $resultValue);
                    }

                    $doc .= '\n';
                }

                //错误码
                if (!empty($api->getErrors())) {
                    $doc .= sprintf('* 错误码: \n\n');
                    $doc .= sprintf('|字段|说明|\n');
                    $doc .= sprintf('|:---:|---|\n');
                    foreach ($api->getErrors() as $errorKey => $errorValue) {
                        $doc .= sprintf('|%s|%s|\n', $errorKey, $errorValue);
                    }

                    $doc .= '\n';
                }

                if (trim($api->getRemarkAfter())) {
                    $doc .= sprintf('* 其他说明: \n\n%s\n', $api->getRemarkAfter());
                }

                if (trim($api->getExampleResponse())) {
                    $doc .= sprintf('* 返回数据示例: \n\n');
                    $doc .= sprintf('```\n');
                    $doc .= sprintf('%s\n', $api->getExampleResponse());
                    $doc .= sprintf('```\n\n');
                }

                $doc .= '\n---\n';
            }
        }
        $doc = rtrim($doc, '\n---\n');

        $content = $overview . $nav . $doc;
        return $content;
    }
}