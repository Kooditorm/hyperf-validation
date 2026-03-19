<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotations;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_CLASS)]
class Validated extends AbstractAnnotation
{
    public function __construct(
        public object|string $instance = '',
    )
    {
    }
}