<?php
declare(strict_types=1);

namespace Kooditorm\Hyperf\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Hyperf\Validation\Annotation\BaseRules;
use Kooditorm\Hyperf\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证的字段必须是一个数组，并且必须至少包含指定的键。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class RequiredArrayKeys extends BaseRules
{
}