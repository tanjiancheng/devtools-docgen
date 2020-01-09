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
$apis = $parser->getApis();
$outer = new Outer($apis);
$docFileName = __DIR__ . '/Doc/api.md';
$ret = $outer->toMarkDown([
    //'stream' => 'php://stdout',
    'stream' => $docFileName,
]);
if ($ret) {
    echo "文档生成成功！请查看" . $docFileName . PHP_EOL;
}