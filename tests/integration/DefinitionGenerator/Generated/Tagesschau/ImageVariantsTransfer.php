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
final class ImageVariantsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::ORIGINAL => self::ORIGINAL_DATA_NAME,
    ];

    // original
    public const string ORIGINAL = 'original';
    protected const string ORIGINAL_DATA_NAME = 'ORIGINAL';
    protected const int ORIGINAL_DATA_INDEX = 0;

    public ?string $original {
        get => $this->_data[self::ORIGINAL_DATA_INDEX];
        set => $this->_data[self::ORIGINAL_DATA_INDEX] = $value;
    }
}
