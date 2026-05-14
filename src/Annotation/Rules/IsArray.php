<?php
declare(strict_types=1);

namespace Kooditorm\Hyperf\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Hyperf\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证字段必须是 PHP 数组。
 *
 * 验证的数组的key必须要包含值之中
 *
 * 'username' => 'array:a,b,c',
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class IsArray extends ValidatorAnnotation
{
    public function rule():string
    {
        return 'array';
    }
}