<?php
declare(strict_types=1);

namespace Kooditorm\Hyperf\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Hyperf\Validation\Annotation\BaseRules;

/**
 * 给定字段和验证字段必须匹配。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Same extends BaseRules
{
}