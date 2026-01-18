<?php

declare(strict_types=1);

namespace Picamator\Examples\TransferObject\Generated\DefinitionGenerator;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /examples/config/definition-generator/definition/product.transfer.yml Definition file path.
 */
final class DetailsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::DESCRIPTION_PROP => self::DESCRIPTION_INDEX,
        self::IS_REGIONAL_PROP => self::IS_REGIONAL_INDEX,
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

    // isRegional
    public const string IS_REGIONAL_PROP = 'isRegional';
    private const int IS_REGIONAL_INDEX = 1;

    public ?bool $isRegional {
        get => $this->getData(self::IS_REGIONAL_INDEX);
        set {
            $this->setData(self::IS_REGIONAL_INDEX, $value);
        }
    }
}
