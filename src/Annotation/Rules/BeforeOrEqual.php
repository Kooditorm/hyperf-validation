<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证字段必须小于等于给定日期。日期将会传递给 PHP 的 strtotime 函数。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class BeforeOrEqual extends ValidatorAnnotation
{
    public function __construct(public string $value, public string $message = '')
    {
    }

    public function rule(): string
    {
        return 'before_or_equal';
    }
}