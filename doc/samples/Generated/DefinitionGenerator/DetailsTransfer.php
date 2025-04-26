<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated\DefinitionGenerator;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /doc/samples/config/definition-generator/definition/product.transfer.yml Definition file path.
 */
final class DetailsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::DESCRIPTION => self::DESCRIPTION_DATA_NAME,
        self::IS_REGIONAL => self::IS_REGIONAL_DATA_NAME,
    ];

    // description
    public const string DESCRIPTION = 'description';
    protected const string DESCRIPTION_DATA_NAME = 'DESCRIPTION';
    protected const int DESCRIPTION_DATA_INDEX = 0;

    public ?string $description {
        get => $this->_data[self::DESCRIPTION_DATA_INDEX];
        set => $this->_data[self::DESCRIPTION_DATA_INDEX] = $value;
    }

    // isRegional
    public const string IS_REGIONAL = 'isRegional';
    protected const string IS_REGIONAL_DATA_NAME = 'IS_REGIONAL';
    protected const int IS_REGIONAL_DATA_INDEX = 1;

    public ?bool $isRegional {
        get => $this->_data[self::IS_REGIONAL_DATA_INDEX];
        set => $this->_data[self::IS_REGIONAL_DATA_INDEX] = $value;
    }
}
