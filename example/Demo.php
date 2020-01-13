<?php

use Devtools\Docgen\Outer;
use Devtools\Docgen\Parser;
use Devtools\Docgen\Scaner;

require(dirname(__DIR__) . '/vendor/autoload.php');

$scaner = new Scaner();
$scaner->setPaths([
    dirname(__DIR__) . '/example/Src'
]);
$scaner->setSuffixs([
    '.php'
]);
$parser = new Parser($scaner);
$overview = $parser->getOverview(); //获取文档总概况
$apis = $parser->getApis();         //获取接口对象数组

$outer = new Outer($apis, $overview);
$docFileName = __DIR__ . '/Doc/api.md';
$ret = $outer->toMarkDown([
    //'stream' => 'php://stdout',   //输出到控制台
    'stream' => $docFileName,       //输出到指定文件
]);
if ($ret) {
    echo "文档生成成功！请查看" . $docFileName . PHP_EOL;
}