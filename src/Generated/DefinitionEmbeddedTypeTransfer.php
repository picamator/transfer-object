<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class DefinitionEmbeddedTypeTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::NAME => self::NAME_DATA_NAME,
        self::NAMESPACE => self::NAMESPACE_DATA_NAME,
    ];

    // name
    public const string NAME = 'name';
    protected const string NAME_DATA_NAME = 'NAME';
    protected const int NAME_DATA_INDEX = 0;

    public string $name {
        get => $this->getRequiredData(self::NAME_DATA_INDEX);
        set => $this->setData(self::NAME_DATA_INDEX, $value);
    }

    // namespace
    #[PropertyTypeAttribute(DefinitionNamespaceTransfer::class)]
    public const string NAMESPACE = 'namespace';
    protected const string NAMESPACE_DATA_NAME = 'NAMESPACE';
    protected const int NAMESPACE_DATA_INDEX = 1;

    public ?DefinitionNamespaceTransfer $namespace {
        get => $this->getData(self::NAMESPACE_DATA_INDEX);
        set => $this->setData(self::NAMESPACE_DATA_INDEX, $value);
    }
}
