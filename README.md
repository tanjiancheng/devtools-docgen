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

//生成markdown格式文档
$ret = $outer->toMarkDown([
    //'stream' => 'php://stdout',           //输出到控制台
    'stream' => __DIR__. '/Doc/api.md',     //输出到指定文件
]);

if ($ret) {
    echo "文档生成成功！请查看" . $docFileName . PHP_EOL;
}
```

> 详细例子可以查看example目录