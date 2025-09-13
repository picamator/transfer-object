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
final class StatusTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::CODE_INDEX => self::CODE,
        self::CONTENT_INDEX => self::CONTENT,
        self::TYPE_INDEX => self::TYPE,
    ];

    // Code
    public const string CODE = 'Code';
    protected const int CODE_INDEX = 0;

    public ?int $Code {
        get => $this->getData(self::CODE_INDEX);
        set => $this->setData(self::CODE_INDEX, $value);
    }

    // Content
    public const string CONTENT = 'Content';
    protected const int CONTENT_INDEX = 1;

    public ?string $Content {
        get => $this->getData(self::CONTENT_INDEX);
        set => $this->setData(self::CONTENT_INDEX, $value);
    }

    // Type
    public const string TYPE = 'Type';
    protected const int TYPE_INDEX = 2;

    public ?string $Type {
        get => $this->getData(self::TYPE_INDEX);
        set => $this->setData(self::TYPE_INDEX, $value);
    }
}
