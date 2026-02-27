<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Environment\Enum;

use Deprecated;

enum EnvironmentEnum: string
{
    /**
     * @api
     */
    private const string ENV_PREFIX = 'PICAMATOR_TRANSFER_OBJECT_';

    /**
     * @api
     */
    #[Deprecated(message: 'Please use PROJECT_ROOT instead.', since: '5.5.0')]
    case PROJECT_ROOT_ALIAS = 'PROJECT_ROOT';

    /**
     * @api
     */
    case PROJECT_ROOT = self::ENV_PREFIX . 'PROJECT_ROOT';

    /**
     * @api
     */
    case MAX_FILE_SIZE_MB = self::ENV_PREFIX . 'MAX_FILE_SIZE_MB';

    /**
     * @api
     */
    case IS_CACHE_ENABLED = self::ENV_PREFIX . 'IS_CACHE_ENABLED';

    private const array DEFAULT_VALUES = [
        self::PROJECT_ROOT->name => '',
        self::PROJECT_ROOT_ALIAS->name => '',
        self::MAX_FILE_SIZE_MB->name => '10',
        self::IS_CACHE_ENABLED->name => '1',
    ];

    public function getDefault(): string
    {
        return self::DEFAULT_VALUES[$this->name];
    }
}
