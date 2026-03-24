<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

/**
 * 如果另一个正在验证的字段等于指定的值，则验证中的字段必须为 yes、on、1 或 true，这对于验证「服务条款」接受或类似字段很有用。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class AcceptedIf extends ValidatorAnnotation
{
    public function __construct(public string $value, public string $message = '')
    {
    }

    public function rule(): string
    {
        return 'accepted_if';
    }
}