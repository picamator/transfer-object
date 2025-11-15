<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /config/definition/transfer-generator.transfer.yml Definition file path.
 */
final class DefinitionAttributeTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::ARGUMENTS => self::ARGUMENTS_INDEX,
        self::NAMESPACE => self::NAMESPACE_INDEX,
    ];

    // arguments
    public const string ARGUMENTS = 'arguments';
    private const int ARGUMENTS_INDEX = 0;

    public ?string $arguments {
        get => $this->getData(self::ARGUMENTS_INDEX);
        set => $this->setData(self::ARGUMENTS_INDEX, $value);
    }

    // namespace
    #[TransferTransformerAttribute(DefinitionNamespaceTransfer::class)]
    public const string NAMESPACE = 'namespace';
    private const int NAMESPACE_INDEX = 1;

    public DefinitionNamespaceTransfer $namespace {
        get => $this->getData(self::NAMESPACE_INDEX);
        set => $this->setData(self::NAMESPACE_INDEX, $value);
    }
}
