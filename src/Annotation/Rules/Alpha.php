<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证字段必须是字母(包含中文)。 为了将此验证规则限制在 ASCII 范围内的字符（a-z 和 A-Z），你可以为验证规则提供 ascii 选项：
 *
 * 'username' => 'alpha:ascii',
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Alpha extends ValidatorAnnotation
{
    public function __construct(public string $value = 'ascii', public string $message = '')
    {

    }
}