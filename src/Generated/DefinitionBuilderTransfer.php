<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class DefinitionBuilderTransfer extends AbstractTransfer
{
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

    public ?DefinitionContentTransfer $definitionContent {
        get => $this->_data[self::DEFINITION_CONTENT_DATA_INDEX];
        set => $this->_data[self::DEFINITION_CONTENT_DATA_INDEX] = $value;
    }

    // generatorContents
    #[CollectionPropertyTypeAttribute(DefinitionGeneratorContentTransfer::class)]
    public const string GENERATOR_CONTENTS = 'generatorContents';
    protected const string GENERATOR_CONTENTS_DATA_NAME = 'GENERATOR_CONTENTS';
    protected const int GENERATOR_CONTENTS_DATA_INDEX = 1;

    /** @var \ArrayObject<int,DefinitionGeneratorContentTransfer> */
    public ArrayObject $generatorContents {
        get => $this->_data[self::GENERATOR_CONTENTS_DATA_INDEX] ?? new ArrayObject();
        set => $this->_data[self::GENERATOR_CONTENTS_DATA_INDEX] = $value;
    }
}
