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
 */
final class DefinitionGeneratorContentTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CLASS_NAME => self::CLASS_NAME_DATA_NAME,
        self::CONTENT => self::CONTENT_DATA_NAME,
    ];

    // className
    public const string CLASS_NAME = 'className';
    protected const string CLASS_NAME_DATA_NAME = 'CLASS_NAME';
    protected const int CLASS_NAME_DATA_INDEX = 0;

    public string $className {
        get => $this->_data[self::CLASS_NAME_DATA_INDEX];
        set => $this->_data[self::CLASS_NAME_DATA_INDEX] = $value;
    }

    // content
    #[ArrayPropertyTypeAttribute]
    public const string CONTENT = 'content';
    protected const string CONTENT_DATA_NAME = 'CONTENT';
    protected const int CONTENT_DATA_INDEX = 1;

    /** @var array<int|string,mixed> */
    public array $content {
        get => $this->_data[self::CONTENT_DATA_INDEX];
        set => $this->_data[self::CONTENT_DATA_INDEX] = $value;
    }
}
