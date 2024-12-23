<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class MerchantTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::IS_ACTIVE => self::IS_ACTIVE_DATA_NAME,
        self::MERCHANT_REFERENCE => self::MERCHANT_REFERENCE_DATA_NAME,
    ];

    // isActive
    public const string IS_ACTIVE = 'isActive';
    protected const string IS_ACTIVE_DATA_NAME = 'IS_ACTIVE';
    protected const int IS_ACTIVE_DATA_INDEX = 0;

    public ?bool $isActive {
        get => $this->_data[self::IS_ACTIVE_DATA_INDEX];
        set => $this->_data[self::IS_ACTIVE_DATA_INDEX] = $value;
    }

    // merchantReference
    public const string MERCHANT_REFERENCE = 'merchantReference';
    protected const string MERCHANT_REFERENCE_DATA_NAME = 'MERCHANT_REFERENCE';
    protected const int MERCHANT_REFERENCE_DATA_INDEX = 1;

    public ?string $merchantReference {
        get => $this->_data[self::MERCHANT_REFERENCE_DATA_INDEX];
        set => $this->_data[self::MERCHANT_REFERENCE_DATA_INDEX] = $value;
    }
}
