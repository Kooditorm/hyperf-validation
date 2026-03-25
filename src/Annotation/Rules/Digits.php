<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证字段必须是数值类型，并且必须包含指定的小数位数：
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Digits extends ValidatorAnnotation
{
    public function __construct(public string $value, public string $message = '')
    {

    }

    public function rule():string
    {
        return 'decimal';
    }
}