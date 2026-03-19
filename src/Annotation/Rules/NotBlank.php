<?php
declare(strict_types=1);

namespace kooditorm\Validation\Annotations\Rules;

use Attribute;
use kooditorm\Validation\Annotations\ValidatorAnnotation;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class NotBlank extends ValidatorAnnotation
{
    public function __construct(
        public string $message = '',
        public string $rule = 'required',
        public string $filed = '',
    )
    {
    }
}