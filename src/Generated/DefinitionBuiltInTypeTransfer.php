<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuiltInTypeEnum;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Transformer\EnumTransformerAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /config/definition/transfer-generator.transfer.yml Definition file path.
 */
final class DefinitionBuiltInTypeTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::DOC_BLOCK_PROP => self::DOC_BLOCK_INDEX,
        self::NAME_PROP => self::NAME_INDEX,
    ];

    protected const array META_TRANSFORMERS = [
        self::NAME_PROP => 'NAME_PROP',
    ];

    // docBlock
    public const string DOC_BLOCK_PROP = 'docBlock';
    private const int DOC_BLOCK_INDEX = 0;

    public ?string $docBlock {
        get => $this->getData(self::DOC_BLOCK_INDEX);
        set {
            $this->setData(self::DOC_BLOCK_INDEX, $value);
        }
    }

    // name
    #[EnumTransformerAttribute(BuiltInTypeEnum::class)]
    public const string NAME_PROP = 'name';
    private const int NAME_INDEX = 1;

    public BuiltInTypeEnum $name {
        get => $this->getData(self::NAME_INDEX);
        set {
            $this->setData(self::NAME_INDEX, $value);
        }
    }
}
