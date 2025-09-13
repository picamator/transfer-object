<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /config/definition/transfer-generator.transfer.yml Definition file path.
 */
final class ConfigTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CONTENT_INDEX => self::CONTENT,
        self::VALIDATOR_INDEX => self::VALIDATOR,
    ];

    // content
    #[PropertyTypeAttribute(ConfigContentTransfer::class)]
    public const string CONTENT = 'content';
    protected const int CONTENT_INDEX = 0;

    public ConfigContentTransfer $content {
        get => $this->getData(self::CONTENT_INDEX);
        set => $this->setData(self::CONTENT_INDEX, $value);
    }

    // validator
    #[PropertyTypeAttribute(ValidatorTransfer::class)]
    public const string VALIDATOR = 'validator';
    protected const int VALIDATOR_INDEX = 1;

    public ValidatorTransfer $validator {
        get => $this->getData(self::VALIDATOR_INDEX);
        set => $this->setData(self::VALIDATOR_INDEX, $value);
    }
}
