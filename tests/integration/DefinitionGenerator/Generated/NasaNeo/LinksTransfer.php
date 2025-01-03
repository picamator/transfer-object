<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\NasaNeo;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update corresponding definition file and run generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class LinksTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::SELF => self::SELF_DATA_NAME,
    ];

    // self
    public const string SELF = 'self';
    protected const string SELF_DATA_NAME = 'SELF';
    protected const int SELF_DATA_INDEX = 0;

    public ?string $self {
        get => $this->getData(self::SELF_DATA_INDEX);
        set => $this->setData(self::SELF_DATA_INDEX, $value);
    }
}
