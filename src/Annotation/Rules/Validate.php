<?php
declare(strict_types=1);

namespace Kooditorm\Hyperf\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Hyperf\Validation\Annotation\ValidatorAnnotation;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Validate extends ValidatorAnnotation
{
    public function __construct(public string $rule, public string $value = '', public string $message = '')
    {
        parent::__construct($message);
    }

    public function rule(): string
    {
        return '';
    }
}