<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

/**
 * 和 after:date 相对，验证字段必须是指定日期之前的一个数值，日期将会传递给 PHP strtotime 函数。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Before extends ValidatorAnnotation
{
    public function __construct(public string $value, public string $message = '')
    {
    }

    public function rule():string
    {
        return 'before';
    }

}