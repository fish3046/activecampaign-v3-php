<?php

namespace Jetimob\ActiveCampaign\Http\Exceptions;

use Jetimob\ActiveCampaign\Http\Resource;
use Throwable;

abstract class Exception extends \Exception
{
    protected ?Resource $resource = null;

    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function setResource(Resource $resource): void
    {
        $this->resource = $resource;
    }

    public function getResource(): ?Resource
    {
        return $this->resource;
    }
}
