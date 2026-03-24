<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证字段必须是大于等于给定日期的值，更多信息，请参考 after:date 规则。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class AfterOrEqual extends ValidatorAnnotation
{
    public function __construct(public string $value, public string $message = '')
    {
    }

    public function rule(): string
    {
        return 'after_or_equal';
    }
}