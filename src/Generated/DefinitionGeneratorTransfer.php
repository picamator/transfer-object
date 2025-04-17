<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class DefinitionGeneratorTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CONTENT => self::CONTENT_DATA_NAME,
        self::DEFINITION_PATH => self::DEFINITION_PATH_DATA_NAME,
    ];

    // content
    #[PropertyTypeAttribute(DefinitionGeneratorContentTransfer::class)]
    public const string CONTENT = 'content';
    protected const string CONTENT_DATA_NAME = 'CONTENT';
    protected const int CONTENT_DATA_INDEX = 0;

    public DefinitionGeneratorContentTransfer $content {
        get => $this->getRequiredData(self::CONTENT_DATA_INDEX);
        set => $this->setData(self::CONTENT_DATA_INDEX, $value);
    }

    // definitionPath
    public const string DEFINITION_PATH = 'definitionPath';
    protected const string DEFINITION_PATH_DATA_NAME = 'DEFINITION_PATH';
    protected const int DEFINITION_PATH_DATA_INDEX = 1;

    public string $definitionPath {
        get => $this->getRequiredData(self::DEFINITION_PATH_DATA_INDEX);
        set => $this->setData(self::DEFINITION_PATH_DATA_INDEX, $value);
    }
}
