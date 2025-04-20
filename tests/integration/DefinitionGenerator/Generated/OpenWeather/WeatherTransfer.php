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
 */
final class WeatherTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::DESCRIPTION => self::DESCRIPTION_DATA_NAME,
        self::ICON => self::ICON_DATA_NAME,
        self::ID => self::ID_DATA_NAME,
        self::MAIN => self::MAIN_DATA_NAME,
    ];

    // description
    public const string DESCRIPTION = 'description';
    protected const string DESCRIPTION_DATA_NAME = 'DESCRIPTION';
    protected const int DESCRIPTION_DATA_INDEX = 0;

    public ?string $description {
        get => $this->_data[self::DESCRIPTION_DATA_INDEX];
        set => $this->_data[self::DESCRIPTION_DATA_INDEX] = $value;
    }

    // icon
    public const string ICON = 'icon';
    protected const string ICON_DATA_NAME = 'ICON';
    protected const int ICON_DATA_INDEX = 1;

    public ?string $icon {
        get => $this->_data[self::ICON_DATA_INDEX];
        set => $this->_data[self::ICON_DATA_INDEX] = $value;
    }

    // id
    public const string ID = 'id';
    protected const string ID_DATA_NAME = 'ID';
    protected const int ID_DATA_INDEX = 2;

    public ?int $id {
        get => $this->_data[self::ID_DATA_INDEX];
        set => $this->_data[self::ID_DATA_INDEX] = $value;
    }

    // main
    public const string MAIN = 'main';
    protected const string MAIN_DATA_NAME = 'MAIN';
    protected const int MAIN_DATA_INDEX = 3;

    public ?string $main {
        get => $this->_data[self::MAIN_DATA_INDEX];
        set => $this->_data[self::MAIN_DATA_INDEX] = $value;
    }
}
