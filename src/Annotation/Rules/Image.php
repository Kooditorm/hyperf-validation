<?php
declare(strict_types=1);

namespace Kooditorm\Hyperf\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Hyperf\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证文件必须是图片（'jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'）。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Image extends ValidatorAnnotation
{
}