<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\BaseRules;

/**
 * 验证文件必须匹配给定的 MIME 文件类型之一
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class MimeTypes extends BaseRules
{
}