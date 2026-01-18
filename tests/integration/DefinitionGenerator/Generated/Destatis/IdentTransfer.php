<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Destatis;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/genesis-destatis-find/definition/destatis.transfer.yml Definition file path.
 */
final class IdentTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::METHOD_PROP => self::METHOD_INDEX,
        self::SERVICE_PROP => self::SERVICE_INDEX,
    ];

    // Method
    public const string METHOD_PROP = 'Method';
    private const int METHOD_INDEX = 0;

    public ?string $Method {
        get => $this->getData(self::METHOD_INDEX);
        set {
            $this->setData(self::METHOD_INDEX, $value);
        }
    }

    // Service
    public const string SERVICE_PROP = 'Service';
    private const int SERVICE_INDEX = 1;

    public ?string $Service {
        get => $this->getData(self::SERVICE_INDEX);
        set {
            $this->setData(self::SERVICE_INDEX, $value);
        }
    }
}
