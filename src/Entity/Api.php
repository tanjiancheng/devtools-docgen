<?php

namespace Devtools\Docgen\Entity;

class Api
{
    protected $title;
    protected $group;
    protected $uri;
    protected $method;
    protected $params = [];
    protected $errors = [];
    protected $result;
    protected $remarkBeforeMd;
    protected $remarkAfterMd;
    protected $exampleRequest;
    protected $exampleResponse;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Api
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     * @return Api
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $uri
     * @return Api
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     * @return Api
     */
    public function setErrors(array $errors): Api
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     * @return Api
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return Api
     */
    public function setParams(array $params): Api
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     * @return Api
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRemarkBeforeMd()
    {
        return $this->remarkBeforeMd;
    }

    /**
     * @param mixed $remarkBeforeMd
     * @return Api
     */
    public function setRemarkBeforeMd($remarkBeforeMd)
    {
        $this->remarkBeforeMd = $remarkBeforeMd;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRemarkAfterMd()
    {
        return $this->remarkAfterMd;
    }

    /**
     * @param mixed $remarkAfterMd
     * @return Api
     */
    public function setRemarkAfterMd($remarkAfterMd)
    {
        $this->remarkAfterMd = $remarkAfterMd;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExampleRequest()
    {
        return $this->exampleRequest;
    }

    /**
     * @param mixed $exampleRequest
     * @return Api
     */
    public function setExampleRequest($exampleRequest)
    {
        $this->exampleRequest = $exampleRequest;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExampleResponse()
    {
        return $this->exampleResponse;
    }

    /**
     * @param mixed $exampleResponse
     * @return Api
     */
    public function setExampleResponse($exampleResponse)
    {
        $this->exampleResponse = $exampleResponse;
        return $this;
    }
}