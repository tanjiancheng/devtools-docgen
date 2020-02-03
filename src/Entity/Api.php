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
    protected $remarkBefore;
    protected $remarkAfter;
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
    public function getUri(): string
    {
        return (string)$this->uri;
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
    public function setErrors($errors): Api
    {
        if (!is_array($errors)) {
            $errors = [];
        }
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
    public function setParams($params): Api
    {
        if (!is_array($params)) {
            $params = [];
        }
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
    public function setResult($result): Api
    {
        if (!is_array($result)) {
            $result = [];
        }
        $this->result = $result;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRemarkBefore()
    {
        return $this->remarkBefore;
    }

    /**
     * @param mixed $remarkBeforeMd
     * @return Api
     */
    public function setRemarkBefore($remarkBefore)
    {
        $this->remarkBefore = $remarkBefore;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRemarkAfter()
    {
        return $this->remarkAfter;
    }

    /**
     * @param mixed $remarkAfterMd
     * @return Api
     */
    public function setRemarkAfter($remarkAfter)
    {
        $this->remarkAfter = $remarkAfter;
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