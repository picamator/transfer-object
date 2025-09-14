<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /config/definition/definition-generator.transfer.yml Definition file path.
 */
final class DefinitionFilesystemTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::CONTENT_INDEX => self::CONTENT,
        self::DEFINITION_PATH_INDEX => self::DEFINITION_PATH,
        self::FILE_NAME_INDEX => self::FILE_NAME,
    ];

    // content
    public const string CONTENT = 'content';
    protected const int CONTENT_INDEX = 0;

    public string $content {
        get => $this->getData(self::CONTENT_INDEX);
        set => $this->setData(self::CONTENT_INDEX, $value);
    }

    // definitionPath
    public const string DEFINITION_PATH = 'definitionPath';
    protected const int DEFINITION_PATH_INDEX = 1;

    public string $definitionPath {
        get => $this->getData(self::DEFINITION_PATH_INDEX);
        set => $this->setData(self::DEFINITION_PATH_INDEX, $value);
    }

    // fileName
    public const string FILE_NAME = 'fileName';
    protected const int FILE_NAME_INDEX = 2;

    public string $fileName {
        get => $this->getData(self::FILE_NAME_INDEX);
        set => $this->setData(self::FILE_NAME_INDEX, $value);
    }
}
