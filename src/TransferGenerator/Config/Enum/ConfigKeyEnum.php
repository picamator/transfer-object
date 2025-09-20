<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Enum;

use Picamator\TransferObject\Generated\ConfigContentTransfer;

enum ConfigKeyEnum: string
{
    case TRANSFER_NAMESPACE = ConfigContentTransfer::TRANSFER_NAMESPACE;
    case TRANSFER_PATH = ConfigContentTransfer::TRANSFER_PATH;
    case DEFINITION_PATH = ConfigContentTransfer::DEFINITION_PATH;

    /**
     * @return array<string,string>
     */
    public static function getConfigKeys(): array
    {
        return array_column(self::cases(), column_key: 'name', index_key: 'value');
    }

    /**
     * @return array<string, string>
     */
    public static function getDefaultConfig(): array
    {
        /** @var array<string> $configKeys */
        $configKeys = array_column(self::cases(), column_key: 'value');

        /** @var array<string, string> $defaultValueContent */
        $defaultValueContent = array_fill_keys($configKeys, '');

        return $defaultValueContent;
    }
}
