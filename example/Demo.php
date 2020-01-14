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
$outer = new Outer($parser);
$docFileName = __DIR__ . '/Doc/api.md';

//生成markdown文件
$link = $outer->toMarkDown([
    //'stream' => 'php://stdout',   //输出到控制台
    'stream' => $docFileName,       //输出到指定文件
]);
if (is_file($link)) {
    echo "== markdown文档链接 ==" . PHP_EOL . $link . PHP_EOL . PHP_EOL;
}

//发送到confluence文档中心
$link = $outer->toConfluence([
    'api' => env('CONFLUENCE_API'),                         //confluence地址
    'username' => env('CONFLUENCE_USERNAME'),               //用户名
    'password' => env('CONFLUENCE_PASSWORD'),               //密码
    'space_key' => env('CONFLUENCE_SPACE_KEY'),             //空间标识
    'space_page_id' => env('CONFLUENCE_SPACE_PAGE_ID'),     //页面pageId
    'group' => env('CONFLUENCE_GROUP')                      //页面下的组标题
]);
echo "== confluence文档链接 ==" . PHP_EOL . $link . PHP_EOL . PHP_EOL;
