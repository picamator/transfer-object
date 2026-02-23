<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Environment\Enum;

enum EnvironmentEnum: string
{
    case PROJECT_ROOT = self::ENV_PREFIX . 'PROJECT_ROOT';

    private const string ENV_PREFIX = 'PICAMATOR_TRANSFER_OBJECT_';

    private const array DEFAULT_VALUES = [
        self::PROJECT_ROOT->name => '',
    ];

    public function getDefault(): string
    {
        return self::DEFAULT_VALUES[$this->name];
    }
}
