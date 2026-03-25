<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证字段必须等于给定日期，日期会被传递到 PHP strtotime 函数。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class DateEquals extends ValidatorAnnotation
{
    public function __construct(public string $value, public string $message = '')
    {

    }
}