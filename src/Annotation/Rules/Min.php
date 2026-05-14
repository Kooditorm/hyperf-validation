<?php
declare(strict_types=1);

namespace Kooditorm\Hyperf\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Hyperf\Validation\Annotation\BaseRules;

/**
 * 与 max:value 相对，验证字段必须大于等于最小值，对字符串、数值、数组、文件字段而言，和 size 规则使用方式一致。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Min extends BaseRules
{
}