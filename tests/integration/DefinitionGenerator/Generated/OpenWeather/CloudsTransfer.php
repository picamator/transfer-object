<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\OpenWeather;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class CloudsTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::ALL => self::ALL_DATA_NAME,
    ];

    // all
    public const string ALL = 'all';
    protected const string ALL_DATA_NAME = 'ALL';
    protected const int ALL_DATA_INDEX = 0;

    public ?int $all {
        get => $this->getData(self::ALL_DATA_INDEX, false);
        set => $this->setData(self::ALL_DATA_INDEX, $value);
    }
}
