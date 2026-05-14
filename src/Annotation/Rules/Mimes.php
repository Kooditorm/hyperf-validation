<?php
declare(strict_types=1);

namespace Kooditorm\Hyperf\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Hyperf\Validation\Annotation\BaseRules;

/**
 * 尽管你只是指定了扩展名，该规则实际上验证的是通过读取文件内容获取到的文件 MIME 类型。 完整的 MIME 类型列表及其相应的扩展可以在这里找到：mime types
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Mimes extends BaseRules
{
}