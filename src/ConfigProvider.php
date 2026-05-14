<?php
declare(strict_types=1);

namespace Kooditorm\Hyperf\Validation;


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