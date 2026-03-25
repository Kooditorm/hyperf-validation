<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证文件必须是图片（'jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'）。
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Image extends ValidatorAnnotation
{
    public function __construct(public string $message = '')
    {

    }
}