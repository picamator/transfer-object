<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class HelperFilesystemTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::CONTENT => self::CONTENT_DATA_NAME,
        self::DEFINITION_PATH => self::DEFINITION_PATH_DATA_NAME,
        self::FILE_NAME => self::FILE_NAME_DATA_NAME,
    ];

    // content
    public const string CONTENT = 'content';
    protected const string CONTENT_DATA_NAME = 'CONTENT';
    protected const int CONTENT_DATA_INDEX = 0;

    public ?string $content {
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

    // fileName
    public const string FILE_NAME = 'fileName';
    protected const string FILE_NAME_DATA_NAME = 'FILE_NAME';
    protected const int FILE_NAME_DATA_INDEX = 2;

    public ?string $fileName {
        get => $this->_data[self::FILE_NAME_DATA_INDEX];
        set => $this->_data[self::FILE_NAME_DATA_INDEX] = $value;
    }
}
