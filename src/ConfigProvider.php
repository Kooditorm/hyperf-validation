<?php
declare(strict_types=1);

namespace Kooditorm\Validation;

use Kooditorm\Validation\Exception\Handler\ValidateExceptionHandler;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__
                    ]
                ]
            ],
        ];
    }
}