<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Builder;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
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

            $propertyType = $this->filterPropertyType($propertyType);
            $this->propertyExpander->expandPropertyTransfer($propertyType, $propertyTransfer);

            $contentTransfer->properties[] = $propertyTransfer;
        }

        return $contentTransfer;
    }

    /**
     * @param mixed $propertyType
     * @return array<string,string|null>
     */
    private function filterPropertyType(mixed $propertyType): array
    {
        if (!is_array($propertyType)) {
            return [];
        }

        $filteredType = [];
        foreach ($propertyType as $key => $typeItem) {
            if (!is_string($key)) {
                continue;
            }

            if (is_bool($typeItem)) {
                $filteredType[$key] = BuildInTypeEnum::getTrueFalse($typeItem)->value;

                continue;
            }

            if (is_string($typeItem) || is_null($typeItem)) {
                $filteredType[$key] = $typeItem;
            }
        }

        return $filteredType;
    }
}
