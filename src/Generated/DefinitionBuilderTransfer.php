<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayObjectInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\CollectionTransformerAttribute;
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
final class DefinitionBuilderTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::DEFINITION_CONTENT_PROP => self::DEFINITION_CONTENT_INDEX,
        self::GENERATOR_CONTENTS_PROP => self::GENERATOR_CONTENTS_INDEX,
    ];

    // definitionContent
    #[TransferTransformerAttribute(DefinitionContentTransfer::class)]
    public const string DEFINITION_CONTENT_PROP = 'definitionContent';
    private const int DEFINITION_CONTENT_INDEX = 0;

    public DefinitionContentTransfer $definitionContent {
        get => $this->getData(self::DEFINITION_CONTENT_INDEX);
        set {
            $this->setData(self::DEFINITION_CONTENT_INDEX, $value);
        }
    }

    // generatorContents
    #[ArrayObjectInitiatorAttribute]
    #[CollectionTransformerAttribute(DefinitionGeneratorContentTransfer::class)]
    public const string GENERATOR_CONTENTS_PROP = 'generatorContents';
    private const int GENERATOR_CONTENTS_INDEX = 1;

    /** @var \ArrayObject<int,DefinitionGeneratorContentTransfer> */
    public ArrayObject $generatorContents {
        get => $this->getData(self::GENERATOR_CONTENTS_INDEX);
        set {
            $this->setData(self::GENERATOR_CONTENTS_INDEX, $value);
        }
    }
}
