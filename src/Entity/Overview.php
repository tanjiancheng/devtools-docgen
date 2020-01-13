<?php

namespace Devtools\Docgen\Entity;

class Overview
{
    protected $title;
    protected $description;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Overview
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Overview
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

}