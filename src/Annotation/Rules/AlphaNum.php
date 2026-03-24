<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;


use Attribute;

/**
 * 验证字段必须是字母(包含中文)或数字。为了将此验证规则限制在 ASCII 范围内的字符（a-z 和 A-Z），你可以为验证规则提供 ascii 选项：
 *
 * 'username' => 'alpha_num:ascii',
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class AlphaNum extends Alpha
{

    public function rule():string
    {
        return 'alpha_num';
    }
}