<?php
declare(strict_types=1);

namespace Kooditorm\Hyperf\Validation\Annotation\Rules;

use Attribute;

/**
 * 验证字段必须小于等于给定日期。日期将会传递给 PHP 的 strtotime 函数。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class BeforeOrEqual extends Before
{
}