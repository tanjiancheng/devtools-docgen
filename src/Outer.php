<?php

namespace Devtools\Docgen;

use Devtools\Docgen\Entity\Api;
use Devtools\Docgen\Entity\Overview;
use Devtools\Docgen\Outer\Base;

/**
 * Class Outer
 * @package Devtools\Docgen
 * @method toConfluence(array $array)
 * @method toMarkDown(array $array)
 * @method toHtml(array $array)
 */
class Outer
{
    /**
     * @var Overview
     */
    private $overview;
    /**
     * @var Api
     */
    private $apis;

    public function __construct(Parser $parser)
    {
        $this->overview = $parser->getOverview(); //获取文档总概况;
        $this->apis = $parser->getApis();         //获取接口对象数组;
    }

    public function __call($name, $arguments)
    {
        list($to, $outer) = explode('to', $name);
        $outer = '\\Devtools\\Docgen\Outer\\' . $outer . '\\' . $outer;
        if (!class_exists($outer)) {
            die("没有相关outer类");
        }

        $class = new $outer($arguments[0] ?? []);
        $class->setOverview($this->overview);
        $class->setApis($this->apis);
        return $class->out();
    }

}