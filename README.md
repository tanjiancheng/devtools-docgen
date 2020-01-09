# api文档生成工具

### Usage
```$xslt
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
$outer->toMarkDown([
    //'stream' => 'php://stdout',
    'stream' => __DIR__. '/Doc/api.md',
]);
```

> 详细例子可以查看example目录