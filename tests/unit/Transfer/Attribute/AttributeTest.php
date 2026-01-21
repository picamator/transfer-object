<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Transfer\Attribute;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Transfer\Attribute\AttributeTrait;
use Picamator\TransferObject\Transfer\Exception\AttributeTransferException;

#[Group('transfer')]
class AttributeTest extends TestCase
{
    private AttributeInterface $attribute;

    protected function setUp(): void
    {
        $this->attribute = new class () implements AttributeInterface {
            use AttributeTrait {
                getInitiatorAttribute as public;
                getTransformerAttribute as public;
            }
        };
    }

    #[TestDox('Get initiator attribute for constant without attribute should throw exception')]
    public function testGetInitiatorAttributeForConstantWithoutAttributeShouldThrowException(): void
    {
        // Expect
        $this->expectException(AttributeTransferException::class);

        // Act
        $this->attribute->getInitiatorAttribute(AttributeInterface::SOME_CONSTANT_WITHOUT_ATTRIBUTE);
    }

    #[TestDox('Get transformer attribute for constant without attribute should throw exception')]
    public function testGetTransformerAttributeForConstantWithoutAttributeShouldThrowException(): void
    {
        // Expect
        $this->expectException(AttributeTransferException::class);

        // Act
        $this->attribute->getTransformerAttribute(AttributeInterface::SOME_CONSTANT_WITHOUT_ATTRIBUTE);
    }
}
