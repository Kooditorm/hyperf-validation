<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\BaseRules;

/**
 * 验证字段必须大于给定 field 字段，这两个字段类型必须一致，适用于字符串、数字、数组和文件，和 size 规则类似
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Gt extends BaseRules
{
}