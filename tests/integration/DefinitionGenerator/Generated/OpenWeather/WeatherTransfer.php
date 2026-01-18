<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\OpenWeather;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/open-weather/definition/forecast.transfer.yml Definition file path.
 */
final class WeatherTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::DESCRIPTION_PROP => self::DESCRIPTION_INDEX,
        self::ICON_PROP => self::ICON_INDEX,
        self::ID_PROP => self::ID_INDEX,
        self::MAIN_PROP => self::MAIN_INDEX,
    ];

    // description
    public const string DESCRIPTION_PROP = 'description';
    private const int DESCRIPTION_INDEX = 0;

    public ?string $description {
        get => $this->getData(self::DESCRIPTION_INDEX);
        set {
            $this->setData(self::DESCRIPTION_INDEX, $value);
        }
    }

    // icon
    public const string ICON_PROP = 'icon';
    private const int ICON_INDEX = 1;

    public ?string $icon {
        get => $this->getData(self::ICON_INDEX);
        set {
            $this->setData(self::ICON_INDEX, $value);
        }
    }

    // id
    public const string ID_PROP = 'id';
    private const int ID_INDEX = 2;

    public ?int $id {
        get => $this->getData(self::ID_INDEX);
        set {
            $this->setData(self::ID_INDEX, $value);
        }
    }

    // main
    public const string MAIN_PROP = 'main';
    private const int MAIN_INDEX = 3;

    public ?string $main {
        get => $this->getData(self::MAIN_INDEX);
        set {
            $this->setData(self::MAIN_INDEX, $value);
        }
    }
}
