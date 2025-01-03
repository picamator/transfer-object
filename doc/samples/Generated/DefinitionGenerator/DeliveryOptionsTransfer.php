<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated\DefinitionGenerator;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update corresponding definition file and run generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class DeliveryOptionsTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::NAME => self::NAME_DATA_NAME,
    ];

    // name
    public const string NAME = 'name';
    protected const string NAME_DATA_NAME = 'NAME';
    protected const int NAME_DATA_INDEX = 0;

    public ?string $name {
        get => $this->getData(self::NAME_DATA_INDEX);
        set => $this->setData(self::NAME_DATA_INDEX, $value);
    }
}
