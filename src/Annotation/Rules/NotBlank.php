<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证字段值不能为空，以下情况字段值都为空： 值为null 值是空字符串 值是空数组或者空的 Countable 对象 值是上传文件但路径为空
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class NotBlank extends ValidatorAnnotation
{
    public function rule(): string
    {
        return 'required';
    }
}