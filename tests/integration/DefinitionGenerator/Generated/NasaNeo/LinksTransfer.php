<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\NasaNeo;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class LinksTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::SELF => self::SELF_DATA_NAME,
    ];

    // self
    public const string SELF = 'self';
    protected const string SELF_DATA_NAME = 'SELF';
    protected const int SELF_DATA_INDEX = 0;

    public ?string $self {
        get => $this->_data[self::SELF_DATA_INDEX];
        set => $this->_data[self::SELF_DATA_INDEX] = $value;
    }
}
