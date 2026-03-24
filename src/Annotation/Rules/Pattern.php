<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证字段必须匹配给定正则表达式。 该规则底层使用的是 PHP 的 preg_match 函数。因此，指定的模式需要遵循 preg_match 函数所要求的格式并且包含有效的分隔符。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Pattern extends ValidatorAnnotation
{
    public function __construct(public string $value, public string $message = '')
    {
    }

    public function rule(): string
    {
        return 'regex';
    }
}