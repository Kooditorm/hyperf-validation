<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation;

use Hyperf\Di\Annotation\AbstractAnnotation;
use Hyperf\Stringable\StrCache;

abstract class ValidatorAnnotation extends AbstractAnnotation
{
    public function rule(): string
    {
        $ref = new \ReflectionClass(static::class);
        // 获取类名
        $shortName = $ref->getShortName();
        //驼峰转蛇形
        return StrCache::snake($shortName);
    }
}