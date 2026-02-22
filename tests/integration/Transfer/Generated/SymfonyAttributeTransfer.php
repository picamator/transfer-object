<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/Transfer/data/config/definition/symfony-attributes.transfer.yml Definition file path.
 */
final class SymfonyAttributeTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::I_AM_ASSERT_PROP => self::I_AM_ASSERT_INDEX,
    ];

    // iAmAssert
    public const string I_AM_ASSERT_PROP = 'iAmAssert';
    private const int I_AM_ASSERT_INDEX = 0;

    #[NotBlank]
    #[Length(min: 50)]
    public string $iAmAssert {
        get => $this->getData(self::I_AM_ASSERT_INDEX);
        set {
            $this->setData(self::I_AM_ASSERT_INDEX, $value);
        }
    }
}
