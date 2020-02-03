# api文档生成工具

### Install
```
composer require devtools/docgen
```

### Usage
```php
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

$outer = new Outer($parser);

//生成markdown文件
$link = $outer->toMarkDown([
    //'stream' => 'php://stdout',   //输出到控制台
    'stream' => __DIR__ . '/Doc/api.md',       //输出到指定文件
]);
if (is_file($link)) {
    echo "== markdown文档链接 ==" . PHP_EOL . $link . PHP_EOL . PHP_EOL;
}

//生成html文件
$link = $outer->toHtml([
    //'stream' => 'php://stdout',   //输出到控制台
    'stream' => __DIR__ . '/Doc/api.html',       //输出到指定文件
]);
if (is_file($link)) {
    echo "== html文档链接 ==" . PHP_EOL . $link . PHP_EOL . PHP_EOL;
}
```

> 详细例子可以查看example目录