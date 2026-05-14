<?php

namespace Kooditorm\Hyperf\Validation\Annotation;

class BaseRules extends ValidatorAnnotation
{

    public function __construct(public string $value, public string $message = '')
    {
        parent::__construct($message);
    }
}