<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Expander;

use Picamator\TransferObject\DefinitionGenerator\Builder\BuilderContentInterface;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

readonly class CollectionTypeBuilderExpander implements BuilderExpanderInterface
{
    use BuilderExpanderTrait;

    public function isApplicable(BuilderContentInterface $content): bool
    {
        if (!$content->getType()->isArray() || empty($content->getPropertyValue())) {
            return false;
        }

        $propertyValue = (array)$content->getPropertyValue();
        $countArrayItems = $this->countArrayItems($propertyValue);

        return $countArrayItems === count($propertyValue);
    }

    public function expandBuilderTransfer(
        BuilderContentInterface $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        $propertyTransfer = $this->createPropertyTransfer($content->getPropertyName());
        $builderTransfer->definitionContent->properties[] = $propertyTransfer;

        $firstCollectionItem = current((array)$content->getPropertyValue()) ?: [];

        $builderTransfer->generatorContents[] = $this->createGeneratorContentTransfer(
            $propertyTransfer->collectionType,
            $firstCollectionItem,
        );
    }

    private function createPropertyTransfer(string $propertyName): DefinitionPropertyTransfer
    {
        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->collectionType = $this->getClassName($propertyName);

        return $propertyTransfer;
    }

    /**
     * @param array<string,mixed> $propertyValue
     */
    private function countArrayItems(array $propertyValue): int
    {
        $countArrayItem = 0;
        foreach ($propertyValue as $item) {
            $countArrayItem += is_array($item) ? 1: 0;
        }

        return $countArrayItem;
    }
}
