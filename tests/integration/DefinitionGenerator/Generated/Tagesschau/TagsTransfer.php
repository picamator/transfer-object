<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Tagesschau;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class TagsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::TAG => self::TAG_DATA_NAME,
    ];

    // tag
    public const string TAG = 'tag';
    protected const string TAG_DATA_NAME = 'TAG';
    protected const int TAG_DATA_INDEX = 0;

    public ?string $tag {
        get => $this->_data[self::TAG_DATA_INDEX];
        set => $this->_data[self::TAG_DATA_INDEX] = $value;
    }
}
