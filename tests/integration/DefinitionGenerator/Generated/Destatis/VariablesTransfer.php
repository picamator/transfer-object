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
final class VariablesTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 5;

    protected const array META_DATA = [
        self::CODE_INDEX => self::CODE,
        self::CONTENT_INDEX => self::CONTENT,
        self::INFORMATION_INDEX => self::INFORMATION,
        self::TYPE_INDEX => self::TYPE,
        self::VALUES_INDEX => self::VALUES,
    ];

    // Code
    public const string CODE = 'Code';
    private const int CODE_INDEX = 0;

    public ?string $Code {
        get => $this->getData(self::CODE_INDEX);
        set => $this->setData(self::CODE_INDEX, $value);
    }

    // Content
    public const string CONTENT = 'Content';
    private const int CONTENT_INDEX = 1;

    public ?string $Content {
        get => $this->getData(self::CONTENT_INDEX);
        set => $this->setData(self::CONTENT_INDEX, $value);
    }

    // Information
    public const string INFORMATION = 'Information';
    private const int INFORMATION_INDEX = 2;

    public ?string $Information {
        get => $this->getData(self::INFORMATION_INDEX);
        set => $this->setData(self::INFORMATION_INDEX, $value);
    }

    // Type
    public const string TYPE = 'Type';
    private const int TYPE_INDEX = 3;

    public ?string $Type {
        get => $this->getData(self::TYPE_INDEX);
        set => $this->setData(self::TYPE_INDEX, $value);
    }

    // Values
    public const string VALUES = 'Values';
    private const int VALUES_INDEX = 4;

    public ?string $Values {
        get => $this->getData(self::VALUES_INDEX);
        set => $this->setData(self::VALUES_INDEX, $value);
    }
}
