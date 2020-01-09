<?php

namespace Devtools\Docgen;

use Devtools\Docgen\Entity\Api;
use Devtools\Docgen\Helper\Str;
use Symfony\Component\Yaml\Yaml;

class Parser
{
    /**
     * @var Scaner
     */
    private $scaner;

    public function __construct(Scaner $scaner)
    {
        $this->scaner = $scaner;
    }

    public function getApis()
    {
        $files = $this->scaner->getMatchFiles();
        $fileContents = [];
        foreach ($files as $file) {
            $content = file_get_contents($file);
            $fileContents[$file] = $content;
        }
        $apis = $this->parseText(array_values($fileContents));
        return $apis;
    }

    /**
     * 解析文档并返回Api对象数组
     *
     * @param array $fileContents
     * @return  Api[]
     */
    protected function parseText(array $fileContents): array
    {
        $apiCommentBegin = false;     //标记api注解是否开始
        $apiComnentEnd = false;       //标记api注解是否结束
        $nameReachEnd = false;        //标记标题是否结束
        $apiDocBegin = false;         //标记api接口文档是否开始
        $apiDocEnd = false;           //标记api接口文档是否结束
        $apiDoc = "";                 //api接口文档内容
        $apiObj = new Api();
        $apis = [];

        foreach ($fileContents as $fileContent) {
            $lines = preg_split("[\r|\n]", $fileContent);
            $lines = array_filter($lines);
            foreach ($lines as $line) {
                $plainText = $this->plainText($line);
                if (!strlen($plainText)) {
                    continue;
                }
                if ($this->isApiCommentBegin($line)) {
                    $apiObj = new Api();
                    $apiCommentBegin = true;
                    $apiComnentEnd = false;
                    $apiDocBegin = false;
                    $apiDocEnd = false;
                    $nameReachEnd = false;
                    continue;
                }

                if ($this->isApiCommentEnd($line)) {
                    if ($apiObj->getTitle() && $this->isApiCommentBegin($line)) {
                        $apis[] = $apiObj;
                    }
                    $apiObj = new Api();
                    $apiCommentBegin = true;
                    $apiComnentEnd = true;
                    $apiDocBegin = false;
                    $apiDocEnd = false;
                    $nameReachEnd = false;
                    continue;
                }

                if ($apiCommentBegin && !$apiComnentEnd) {
                    if ($this->isApiDocEnd($plainText)) {
                        $yamlParser = new Yaml();
                        $apiArray = $yamlParser->parse($apiDoc);
                        foreach ($apiArray as $apiKey => $apiValue) {
                            if (property_exists($apiObj, lcfirst(Str::underscoresToCamelCase($apiKey)))) {
                                $setMethodName = 'set' . Str::underscoresToCamelCase($apiKey);
                                $apiObj->$setMethodName($apiValue);
                            }
                        }
                        $apiDocEnd = true;
                    }

                    if ($apiDocBegin && !$apiDocEnd) {
                        $apiDoc .= $plainText . "\n";
                    }

                    if ($this->isApiDocBegin($plainText)) {
                        $apiDoc = '';
                        $apiDocBegin = true;
                        $nameReachEnd = true;
                    }

                    if (!$nameReachEnd) {
                        $apiObj->setTitle($plainText);
                    }
                }


            }
        }
        return $apis;
    }

    private function plainText(string $text)
    {
        return str_replace('*', '', str_replace("* ", '', trim($text)));
    }

    /**
     * 判断是否遇到了api注释的开头标记
     *
     * @param string $text
     * @return bool
     */
    private function isApiCommentBegin(string $text): bool
    {
        if (strpos($text, "/**") !== false) {
            return true;
        }
        return false;
    }

    /**
     * 判断是否遇到了api注释的结尾标记
     *
     * @param string $text
     * @return bool
     */
    private function isApiCommentEnd(string $text): bool
    {
        if (strpos($text, "*/") !== false) {
            return true;
        }
        return false;
    }

    /**
     * 判断是否遇到了api接口文档的开头标记
     *
     * @param string $text
     * @return bool
     */
    private function isApiDocBegin(string $text): bool
    {
        if (strpos($text, "<pre>") !== false) {
            return true;
        }
        return false;
    }

    /**
     * 判断是否遇到了api接口文档的结束标记
     *
     * @param string $text
     * @return bool
     */
    private function isApiDocEnd(string $text): bool
    {
        if (strpos($text, "</pre>") !== false) {
            return true;
        }
        return false;
    }

}