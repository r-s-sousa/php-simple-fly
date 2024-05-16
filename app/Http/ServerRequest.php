<?php

namespace SimpleFly\Http;

use SimpleFly\Exceptions\NotImplementedException;
use SimpleFly\Http\Interfaces\ServerRequestInterface;

class ServerRequest extends Request implements ServerRequestInterface
{
    public function getServerParams(): array
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getCookieParams(): array
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withCookieParams(array $cookies): ServerRequestInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getQueryParams(): array
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withQueryParams(array $query): ServerRequestInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getUploadedFiles(): array
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withUploadedFiles(array $uploadedFiles): ServerRequestInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getParsedBody()
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withParsedBody($data): ServerRequestInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getAttributes(): array
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function getAttribute(string $name, $default = null)
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withAttribute(string $name, $value): ServerRequestInterface
    {
        throw new NotImplementedException(__METHOD__);
    }

    public function withoutAttribute(string $name): ServerRequestInterface
    {
        throw new NotImplementedException(__METHOD__);
    }
}
