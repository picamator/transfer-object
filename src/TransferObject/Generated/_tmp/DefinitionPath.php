<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class DefinitionPathTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::PATH => self::PATH_DATA_NAME,
    ];

    // path
    public const string PATH = 'path';
    protected const string PATH_DATA_NAME = 'PATH';
    protected const int PATH_DATA_INDEX = 0;
    
    public ?string $path {
        get => $this->data[self::PATH_DATA_INDEX];
        set => $this->data[self::PATH_DATA_INDEX] = $value;
    }
}
