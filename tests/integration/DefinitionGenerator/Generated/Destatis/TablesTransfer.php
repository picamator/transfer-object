<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Destatis;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/genesis-destatis-find/definition/destatis.transfer.yml Definition file path.
 */
final class TablesTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::CODE_PROP => self::CODE_INDEX,
        self::CONTENT_PROP => self::CONTENT_INDEX,
        self::TIME_PROP => self::TIME_INDEX,
    ];

    // Code
    public const string CODE_PROP = 'Code';
    private const int CODE_INDEX = 0;

    public ?string $Code {
        get => $this->getData(self::CODE_INDEX);
        set {
            $this->setData(self::CODE_INDEX, $value);
        }
    }

    // Content
    public const string CONTENT_PROP = 'Content';
    private const int CONTENT_INDEX = 1;

    public ?string $Content {
        get => $this->getData(self::CONTENT_INDEX);
        set {
            $this->setData(self::CONTENT_INDEX, $value);
        }
    }

    // Time
    public const string TIME_PROP = 'Time';
    private const int TIME_INDEX = 2;

    public ?string $Time {
        get => $this->getData(self::TIME_INDEX);
        set {
            $this->setData(self::TIME_INDEX, $value);
        }
    }
}
