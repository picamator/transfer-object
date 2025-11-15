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
final class StatisticsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::CODE => self::CODE_INDEX,
        self::CONTENT => self::CONTENT_INDEX,
        self::CUBES => self::CUBES_INDEX,
        self::INFORMATION => self::INFORMATION_INDEX,
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

    // Cubes
    public const string CUBES = 'Cubes';
    private const int CUBES_INDEX = 2;

    public ?string $Cubes {
        get => $this->getData(self::CUBES_INDEX);
        set => $this->setData(self::CUBES_INDEX, $value);
    }

    // Information
    public const string INFORMATION = 'Information';
    private const int INFORMATION_INDEX = 3;

    public ?string $Information {
        get => $this->getData(self::INFORMATION_INDEX);
        set => $this->setData(self::INFORMATION_INDEX, $value);
    }
}
