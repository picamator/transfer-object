<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser;

use ArrayObject;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\PropertyExpanderInterface;

readonly class ContentBuilder implements ContentBuilderInterface
{
    /**
     * @param \ArrayObject<int,PropertyExpanderInterface> $propertyExpanders
     */
    public function __construct(
        private ArrayObject $propertyExpanders,
    ) {
    }

    public function createContentTransfer(string $className, array $properties): DefinitionContentTransfer
    {
        $contentTransfer = new DefinitionContentTransfer();
        $contentTransfer->className = $className;

        foreach ($properties as $propertyName => $propertyType) {
            $propertyType = is_array($propertyType) ? $propertyType : [];
            $propertyType = array_filter($propertyType, $this->propertyTypeFilter(...));

            $propertyTransfer = new DefinitionPropertyTransfer();
            $propertyTransfer->propertyName = (string)$propertyName;
            $this->handlePropertyExpanders($propertyType, $propertyTransfer);

            $contentTransfer->properties[] = $propertyTransfer;
        }

        return $contentTransfer;
    }

    /**
     * @param array<string,string|bool> $propertyType
     */
    private function handlePropertyExpanders(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        foreach ($this->propertyExpanders as $propertyExpander) {
            if (!$propertyExpander->isApplicable($propertyType)) {
                continue;
            }

            $propertyExpander->expandPropertyTransfer($propertyType, $propertyTransfer);
            if (!$propertyExpander->isNextAllowed()) {
                break;
            }
        }
    }

    private function propertyTypeFilter(mixed $typeItem): bool
    {
        return is_string($typeItem) || is_bool($typeItem) || is_null($typeItem);
    }
}
