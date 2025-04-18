<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class DefinitionBuilderTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::DEFINITION_CONTENT => self::DEFINITION_CONTENT_DATA_NAME,
        self::GENERATOR_CONTENTS => self::GENERATOR_CONTENTS_DATA_NAME,
    ];

    // definitionContent
    #[PropertyTypeAttribute(DefinitionContentTransfer::class)]
    public const string DEFINITION_CONTENT = 'definitionContent';
    protected const string DEFINITION_CONTENT_DATA_NAME = 'DEFINITION_CONTENT';
    protected const int DEFINITION_CONTENT_DATA_INDEX = 0;

    public DefinitionContentTransfer $definitionContent {
        get => $this->getData(self::DEFINITION_CONTENT_DATA_INDEX, true);
        set => $this->setData(self::DEFINITION_CONTENT_DATA_INDEX, $value);
    }

    // generatorContents
    #[CollectionPropertyTypeAttribute(DefinitionGeneratorContentTransfer::class)]
    public const string GENERATOR_CONTENTS = 'generatorContents';
    protected const string GENERATOR_CONTENTS_DATA_NAME = 'GENERATOR_CONTENTS';
    protected const int GENERATOR_CONTENTS_DATA_INDEX = 1;

    /** @var \ArrayObject<int,DefinitionGeneratorContentTransfer> */
    public ArrayObject $generatorContents {
        get => $this->getData(self::GENERATOR_CONTENTS_DATA_INDEX, true);
        set => $this->setData(self::GENERATOR_CONTENTS_DATA_INDEX, $value);
    }
}
