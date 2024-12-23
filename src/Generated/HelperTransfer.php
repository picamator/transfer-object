<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class HelperTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CONTENT => self::CONTENT_DATA_NAME,
        self::DEFINITION_PATH => self::DEFINITION_PATH_DATA_NAME,
    ];

    // content
    #[PropertyTypeAttribute(HelperContentTransfer::class)]
    public const string CONTENT = 'content';
    protected const string CONTENT_DATA_NAME = 'CONTENT';
    protected const int CONTENT_DATA_INDEX = 0;

    public ?HelperContentTransfer $content {
        get => $this->_data[self::CONTENT_DATA_INDEX];
        set => $this->_data[self::CONTENT_DATA_INDEX] = $value;
    }

    // definitionPath
    public const string DEFINITION_PATH = 'definitionPath';
    protected const string DEFINITION_PATH_DATA_NAME = 'DEFINITION_PATH';
    protected const int DEFINITION_PATH_DATA_INDEX = 1;

    public ?string $definitionPath {
        get => $this->_data[self::DEFINITION_PATH_DATA_INDEX];
        set => $this->_data[self::DEFINITION_PATH_DATA_INDEX] = $value;
    }
}
