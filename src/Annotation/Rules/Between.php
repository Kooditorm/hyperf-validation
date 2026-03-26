<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\BaseRules;

/**
 * 验证字段大小在给定的最小值和最大值之间，字符串、数字、数组和文件都可以像使用 size 规则一样使用该规则：
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Between extends BaseRules
{
}