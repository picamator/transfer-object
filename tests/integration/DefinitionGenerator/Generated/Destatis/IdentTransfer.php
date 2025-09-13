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
        self::METHOD => self::METHOD_DATA_NAME,
        self::SERVICE => self::SERVICE_DATA_NAME,
    ];

    // Method
    public const string METHOD = 'Method';
    protected const string METHOD_DATA_NAME = 'METHOD';
    protected const int METHOD_DATA_INDEX = 0;

    public ?string $Method {
        get => $this->getData(self::METHOD_DATA_INDEX);
        set => $this->setData(self::METHOD_DATA_INDEX, $value);
    }

    // Service
    public const string SERVICE = 'Service';
    protected const string SERVICE_DATA_NAME = 'SERVICE';
    protected const int SERVICE_DATA_INDEX = 1;

    public ?string $Service {
        get => $this->getData(self::SERVICE_DATA_INDEX);
        set => $this->setData(self::SERVICE_DATA_INDEX, $value);
    }
}
