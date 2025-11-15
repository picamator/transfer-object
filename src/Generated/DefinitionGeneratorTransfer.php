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
 * @see /config/definition/definition-generator.transfer.yml Definition file path.
 */
final class DefinitionGeneratorTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CONTENT => self::CONTENT_INDEX,
        self::DEFINITION_PATH => self::DEFINITION_PATH_INDEX,
    ];

    // content
    #[TransferTransformerAttribute(DefinitionGeneratorContentTransfer::class)]
    public const string CONTENT = 'content';
    private const int CONTENT_INDEX = 0;

    public DefinitionGeneratorContentTransfer $content {
        get => $this->getData(self::CONTENT_INDEX);
        set => $this->setData(self::CONTENT_INDEX, $value);
    }

    // definitionPath
    public const string DEFINITION_PATH = 'definitionPath';
    private const int DEFINITION_PATH_INDEX = 1;

    public string $definitionPath {
        get => $this->getData(self::DEFINITION_PATH_INDEX);
        set => $this->setData(self::DEFINITION_PATH_INDEX, $value);
    }
}
