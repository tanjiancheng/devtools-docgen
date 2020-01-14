<?php

namespace Devtools\Docgen\Outer;

use Devtools\Docgen\Entity\Api;
use Devtools\Docgen\Entity\Overview;

abstract class Base
{
    /**
     * @var Overview
     */
    protected $overview;
    /**
     * @var Api[]
     */
    protected $apis;

    /**
     * @return Overview
     */
    public function getOverview(): Overview
    {
        return $this->overview;
    }

    /**
     * @param Overview $overview
     */
    public function setOverview(Overview $overview): void
    {
        $this->overview = $overview;
    }

    /**
     * @return Api
     */
    public function getApis(): Api
    {
        return $this->apis;
    }

    /**
     * @param Api $apis
     */
    public function setApis(array $apis): void
    {
        $this->apis = $apis;
    }

    abstract function out();
}