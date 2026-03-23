<?php
declare(strict_types=1);

namespace Kooditorm\Validation\Annotation\Rules;


use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class AlphaDash extends Alpha
{

    public function rule():string
    {
        return 'alpha_dash:{value}';
    }
}