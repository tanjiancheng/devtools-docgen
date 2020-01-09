<?php
namespace DevtoolsTest\Docgen;

use Devtools\Docgen\Scaner;
use PHPUnit\Framework\TestCase;


class DocgenTest extends TestCase
{
    /**
     * @var Scaner
     */
    private $scaner;

    private $srcPath;

    protected function setUp(): void
    {
        $this->scaner = new Scaner();
        $this->srcPath = dirname(__DIR__)."/example/Src";
    }


    public function testGetAllFilesByPath()
    {
        $files = $this->scaner->getAllFilesByPath($this->srcPath);
        var_dump($files);
        exit;
    }

    public function testGetMatchFiles()
    {
        $this->scaner->setPaths([
            $this->srcPath
        ]);
        $this->scaner->setSuffixs([
            '.php'
        ]);
        $files = $this->scaner->getMatchFiles();
        var_dump($files);
        exit;
    }
}