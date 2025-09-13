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
        self::CODE => self::CODE_DATA_NAME,
        self::CONTENT => self::CONTENT_DATA_NAME,
        self::TIME => self::TIME_DATA_NAME,
    ];

    // Code
    public const string CODE = 'Code';
    protected const string CODE_DATA_NAME = 'CODE';
    protected const int CODE_DATA_INDEX = 0;

    public ?string $Code {
        get => $this->getData(self::CODE_DATA_INDEX);
        set => $this->setData(self::CODE_DATA_INDEX, $value);
    }

    // Content
    public const string CONTENT = 'Content';
    protected const string CONTENT_DATA_NAME = 'CONTENT';
    protected const int CONTENT_DATA_INDEX = 1;

    public ?string $Content {
        get => $this->getData(self::CONTENT_DATA_INDEX);
        set => $this->setData(self::CONTENT_DATA_INDEX, $value);
    }

    // Time
    public const string TIME = 'Time';
    protected const string TIME_DATA_NAME = 'TIME';
    protected const int TIME_DATA_INDEX = 2;

    public ?string $Time {
        get => $this->getData(self::TIME_DATA_INDEX);
        set => $this->setData(self::TIME_DATA_INDEX, $value);
    }
}
