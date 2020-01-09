<?php

namespace Devtools\Docgen;

class Scaner
{
    private $paths = [];
    private $suffixs = ['.php'];

    public function setPaths(array $paths)
    {
        $this->paths = $paths;
    }

    public function getPaths()
    {
        return $this->paths;
    }

    public function setSuffixs(array $suffixs)
    {
        $this->suffixs = $suffixs;
    }

    public function getSuffixs()
    {
        return $this->suffixs;
    }

    public function getAllFilesByPath($path, &$files = []) {
        if(is_dir($path)){
            $dp = dir($path);
            while ($file = $dp ->read()){
                if($file !="." && $file !=".."){
                    $this->getAllFilesByPath($path."/".$file, $files);
                }
            }
            $dp ->close();
        }
        if(is_file($path)){
            $files[] =  $path;
        }
        return $files;
    }

    public function getMatchFiles()
    {
        $files = [];
        foreach ($this->paths as $path) {
            $pathFiles = $this->getAllFilesByPath($path);
            foreach ($pathFiles as $pathFile) {
                $extension = pathinfo($pathFile)['extension'];
                $extensionDot = '.'. $extension;
                if (in_array($extensionDot, $this->suffixs)) {
                    $files[] = $pathFile;
                }
            }
        }
        $files = array_unique($files);
        return $files;
    }
}