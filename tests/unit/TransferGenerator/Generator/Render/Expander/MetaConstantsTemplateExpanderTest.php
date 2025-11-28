<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Render\Expander;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\MetaConstantsTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\TemplateExpanderInterface;

#[Group('transfer-generator')]
class MetaConstantsTemplateExpanderTest extends TestCase
{
    private TemplateExpanderInterface $expander;

    protected function setUp(): void
    {
        $this->expander = new MetaConstantsTemplateExpander();
    }

    #[TestDox('Expand template with meta constants converting property $propertyName to $expected')]
    #[TestWith(['lowerCase', 'LOWER_CASE'])]
    #[TestWith(['UPPERCASE', 'UPPERCASE'])]
    #[TestWith(['UPPER_CASE', 'UPPER_CASE'])]
    #[TestWith(['Mixed_CaSE', 'MIXED_CASE'])]
    public function testExpandTemplateTransfer(string $propertyName, string $expected): void
    {
        // Arrange
        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;

        $templateTransfer = new TemplateTransfer();

        // Act
        $this->expander->expandTemplateTransfer($propertyTransfer, $templateTransfer);

        // Assert
        $this->assertCount(1, $templateTransfer->metaConstants);
        $this->assertSame($expected, $templateTransfer->metaConstants->getIterator()->key());
    }
}
