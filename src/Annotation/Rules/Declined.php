<?php

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Declined extends ValidatorAnnotation
{
    public function __construct(public string $message = '')
    {
    }

    public function rule(): string
    {
        return 'declined';
    }
}