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

        $firstItem = $content->getPropertyValue()[0] ?? null;

        return is_array($firstItem) && key($firstItem) !== 0;
    }

    public function expandBuilderTransfer(
        BuilderContentInterface $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        $propertyTransfer = $this->createPropertyTransfer($content->getPropertyName());
        $builderTransfer->definitionContent->properties[] = $propertyTransfer;

        $builderTransfer->generatorContents[] = $this->createGeneratorContentTransfer(
            $propertyTransfer->collectionType,
            $content->getPropertyValue()[0],
        );
    }

    private function createPropertyTransfer(string $propertyName): DefinitionPropertyTransfer
    {
        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->collectionType = $this->getClassName($propertyName);

        return $propertyTransfer;
    }
}
