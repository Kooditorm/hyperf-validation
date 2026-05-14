<?php
declare(strict_types=1);

namespace Kooditorm\Hyperf\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Hyperf\Validation\Annotation\ValidatorAnnotation;

/**
 * 正在验证的字段必须是 no、off、0 或者 false。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Declined extends ValidatorAnnotation
{
}