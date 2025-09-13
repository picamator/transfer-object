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
 *
 * @see /tests/integration/DefinitionGenerator/data/config/tagesschau-api-bund-dev-v2/definition/ardNews.transfer.yml Definition file path.
 */
final class ImageVariantsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::ORIGINAL_INDEX => self::ORIGINAL,
    ];

    // original
    public const string ORIGINAL = 'original';
    protected const int ORIGINAL_INDEX = 0;

    public ?string $original {
        get => $this->getData(self::ORIGINAL_INDEX);
        set => $this->setData(self::ORIGINAL_INDEX, $value);
    }
}
