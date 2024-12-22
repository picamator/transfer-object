<?php declare(strict_types = 1);

namespace Picamator\TransferGenerator\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class HelperBuilderTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::DEFINITION_CONTENT => self::DEFINITION_CONTENT_DATA_NAME,
        self::HELPER_CONTENTS => self::HELPER_CONTENTS_DATA_NAME,
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

    // helperContents
    #[CollectionPropertyTypeAttribute(HelperContentTransfer::class)]
    public const string HELPER_CONTENTS = 'helperContents';
    protected const string HELPER_CONTENTS_DATA_NAME = 'HELPER_CONTENTS';
    protected const int HELPER_CONTENTS_DATA_INDEX = 1;

    /** @var \ArrayObject<int,HelperContentTransfer> */
    public ArrayObject $helperContents {
        get => $this->_data[self::HELPER_CONTENTS_DATA_INDEX] ?? new ArrayObject();
        set => $this->_data[self::HELPER_CONTENTS_DATA_INDEX] = $value;
    }
}
