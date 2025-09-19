<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Expander;

use Picamator\TransferObject\DefinitionGenerator\Builder\BuilderContentInterface;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

final class CollectionTypeBuilderExpander extends AbstractBuilderExpander
{
    use BuilderExpanderTrait;

    protected function isApplicable(BuilderContentInterface $content): bool
    {
        if (!$content->getType()->isArray() || empty($content->getPropertyValue())) {
            return false;
        }

        /** @var array<string, mixed> $propertyValue */
        $propertyValue = $content->getPropertyValue();

        return array_all($propertyValue, fn (mixed $value): bool => is_array($value));
    }

    protected function handleExpander(
        BuilderContentInterface $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        $propertyTransfer = $this->createPropertyTransfer($content->getPropertyName());
        $builderTransfer->definitionContent->properties[] = $propertyTransfer;


        $mergedContent = $this->mergeContent($content);
        $className = $propertyTransfer->collectionType?->name ?: '';

        $builderTransfer->generatorContents[] = $this->createGeneratorContentTransfer($className, $mergedContent);
    }

    /**
     * @return array<int|string, mixed>
     */
    private function mergeContent(BuilderContentInterface $content): array
    {
        $mergedContent = [];
        /** @var array<string, array<string, mixed>> $propertyValue */
        $propertyValue = $content->getPropertyValue() ?: [];

        foreach ($propertyValue as $contentItem) {
            foreach ($contentItem as $contentKey => $contentValue) {
                if (!is_array($contentValue)) {
                    $mergedContent[$contentKey] ??= $contentValue;

                    continue;
                }

                $mergedContent[$contentKey] ??= [];
                if (is_array($mergedContent[$contentKey])) {
                    $mergedContent[$contentKey] = array_merge($mergedContent[$contentKey], $contentValue);
                }
            }
        }

        return $mergedContent;
    }

    private function createPropertyTransfer(string $propertyName): DefinitionPropertyTransfer
    {
        $typeTransfer = new DefinitionEmbeddedTypeTransfer();
        $typeTransfer->name = $this->getClassName($propertyName);

        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->collectionType = $typeTransfer;
        $propertyTransfer->isNullable = true;
        $propertyTransfer->isProtected = false;

        return $propertyTransfer;
    }
}
