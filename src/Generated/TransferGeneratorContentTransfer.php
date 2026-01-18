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
 * @see /config/definition/transfer-generator.transfer.yml Definition file path.
 */
final class TransferGeneratorContentTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CLASS_NAME_PROP => self::CLASS_NAME_INDEX,
        self::CONTENT_PROP => self::CONTENT_INDEX,
    ];

    // className
    public const string CLASS_NAME_PROP = 'className';
    private const int CLASS_NAME_INDEX = 0;

    public protected(set) string $className {
        get => $this->getData(self::CLASS_NAME_INDEX);
        set {
            $this->setData(self::CLASS_NAME_INDEX, $value);
        }
    }

    // content
    public const string CONTENT_PROP = 'content';
    private const int CONTENT_INDEX = 1;

    public protected(set) string $content {
        get => $this->getData(self::CONTENT_INDEX);
        set {
            $this->setData(self::CONTENT_INDEX, $value);
        }
    }
}
