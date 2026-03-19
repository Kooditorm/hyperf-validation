<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Valid extends Validated
{
}