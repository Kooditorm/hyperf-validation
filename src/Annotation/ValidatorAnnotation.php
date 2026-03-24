<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation;

use Hyperf\Di\Annotation\AbstractAnnotation;

abstract class ValidatorAnnotation extends AbstractAnnotation
{
    public function rule(): string
    {
        $ref = new \ReflectionClass(static::class);
        return mb_strtolower($ref->getShortName());
    }
}