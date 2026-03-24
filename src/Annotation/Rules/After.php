<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;

use Attribute;
use Kooditorm\Validation\Annotation\ValidatorAnnotation;

/**
 * 验证字段必须是给定日期之后的一个值，日期将会通过 PHP 函数 strtotime 传递：
 *
 * 'start_date' => 'required|date|after:tomorrow'
 *
 * 你可以指定另外一个与日期进行比较的字段，而不是传递一个日期字符串给 strtotime 执行：
 *
 * 'finish_date' => 'required|date|after:start_date'
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class After extends ValidatorAnnotation
{

    public function __construct(public string $value, public string $message = '')
    {
    }

    public function rule():string
    {
        return 'after';
    }
}