<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotations\Rules;

use Attribute;
use Kooditorm\Validation\Annotations\ValidatorAnnotation;

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