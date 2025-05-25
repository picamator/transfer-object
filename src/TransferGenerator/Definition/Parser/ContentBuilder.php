<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\TypeSuffixEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\PropertyExpanderInterface;

readonly class ContentBuilder implements ContentBuilderInterface
{
    public function __construct(
        private PropertyExpanderInterface $propertyExpander,
    ) {
    }

    public function createContentTransfer(string $className, array $properties): DefinitionContentTransfer
    {
        $contentTransfer = new DefinitionContentTransfer();
        $contentTransfer->className = $this->getTransferClassName($className);

        foreach ($properties as $propertyName => $propertyType) {
            $contentTransfer->properties[] = $this->createPropertyTransfer((string)$propertyName, $propertyType);
        }

        return $contentTransfer;
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    private function createPropertyTransfer(string $propertyName, array $propertyType): DefinitionPropertyTransfer
    {
        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;

        $this->propertyExpander->expandPropertyTransfer($propertyType, $propertyTransfer);

        return $propertyTransfer;
    }

    private function getTransferClassName(string $className): string
    {
        return $className . TypeSuffixEnum::TRANSFER->value;
    }
}
