<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayPropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /config/definition/definition-generator.transfer.yml Definition file path.
 */
final class DefinitionGeneratorContentTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CLASS_NAME_INDEX => self::CLASS_NAME,
        self::CONTENT_INDEX => self::CONTENT,
    ];

    // className
    public const string CLASS_NAME = 'className';
    private const int CLASS_NAME_INDEX = 0;

    public string $className {
        get => $this->getData(self::CLASS_NAME_INDEX);
        set => $this->setData(self::CLASS_NAME_INDEX, $value);
    }

    // content
    #[ArrayPropertyTypeAttribute]
    public const string CONTENT = 'content';
    private const int CONTENT_INDEX = 1;

    /** @var array<int|string,mixed> */
    public array $content {
        get => $this->getData(self::CONTENT_INDEX);
        set => $this->setData(self::CONTENT_INDEX, $value);
    }
}
