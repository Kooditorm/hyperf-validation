<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证字段必须匹配指定格式，可以使用 PHP 函数 date 或 date_format 验证该字段。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class DateFormat extends ValidatorAnnotation
{
    public function __construct(public string $value, public string $message = '')
    {

    }
}