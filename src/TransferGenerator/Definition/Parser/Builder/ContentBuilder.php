<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Builder;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\TypePrefixEnum;
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
        $contentTransfer->className = $className . TypePrefixEnum::TRANSFER->value;

        foreach ($properties as $propertyName => $propertyType) {
            $propertyTransfer = new DefinitionPropertyTransfer();
            $propertyTransfer->propertyName = (string)$propertyName;

            $this->propertyExpander->expandPropertyTransfer($propertyType, $propertyTransfer);

            $contentTransfer->properties[] = $propertyTransfer;
        }

        return $contentTransfer;
    }
}
