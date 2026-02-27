<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Enum;

use Picamator\TransferObject\Generated\ConfigContentTransfer;

enum ConfigKeyEnum: string
{
    case TRANSFER_NAMESPACE = ConfigContentTransfer::TRANSFER_NAMESPACE_PROP;
    case TRANSFER_PATH = ConfigContentTransfer::TRANSFER_PATH_PROP;
    case DEFINITION_PATH = ConfigContentTransfer::DEFINITION_PATH_PROP;
    case HASH_FILE_NAME = ConfigContentTransfer::HASH_FILE_NAME_PROP;

    private const array DEFAULT_VALUES = [
        self::TRANSFER_NAMESPACE->name => '',
        self::TRANSFER_PATH->name => '',
        self::DEFINITION_PATH->name => '',
        self::HASH_FILE_NAME->name => 'transfer-object.list.csv',
    ];

    /**
     * @return array<string, string|bool>
     */
    public static function getDefaultConfig(): array
    {
        $defaultContent[ConfigContentTransfer::UUID_PROP] = '';
        $defaultContent[ConfigContentTransfer::IS_CACHE_ENABLED_PROP] = true;

        foreach (self::cases() as $keyEnum) {
            $defaultContent[$keyEnum->value] = self::DEFAULT_VALUES[$keyEnum->name];
        }

        return $defaultContent;
    }

    public function getDefaultValue(): string
    {
        return self::DEFAULT_VALUES[$this->name];
    }
}
