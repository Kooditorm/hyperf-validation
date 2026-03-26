<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Validate extends ValidatorAnnotation
{
    public function __construct(public string $rule, public string $value = '', public string $message = '')
    {
        parent::__construct($value, $message);
    }

    public function rule(): string
    {
        return '';
    }
}