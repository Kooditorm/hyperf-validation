<?php
declare(strict_types=1);

namespace Kooditorm\Hyperf\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Hyperf\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证字段必须为大写。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Uppercase extends ValidatorAnnotation
{
}