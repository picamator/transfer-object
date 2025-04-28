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
    public static function getValueName(): array
    {
        return array_column(self::cases(), column_key: 'name', index_key: 'value');
    }
}
