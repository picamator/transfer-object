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
        $propertyValue = (array)$content->getPropertyValue();
        $countArrayItems = $this->countArrayItems($propertyValue);

        return $countArrayItems === count($propertyValue);
    }

    protected function handleExpander(
        BuilderContentInterface $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        $propertyTransfer = $this->createPropertyTransfer($content->getPropertyName());
        $builderTransfer->definitionContent->properties[] = $propertyTransfer;

        $content = (array)$content->getPropertyValue() ?: [];
        $mergedContent = $this->mergeContent($content);

        $className = $propertyTransfer->collectionType?->name ?: '';

        $builderTransfer->generatorContents[] = $this->createGeneratorContentTransfer($className, $mergedContent);
    }

    /**
     * @param array<int|string, mixed> $content
     *
     * @return array<int|string, mixed>
     */
    private function mergeContent(array $content): array
    {
        $mergedContent = [];

        /** @var array<string, mixed> $contentItem */
        foreach ($content as $contentItem) {
            foreach ($contentItem as $contentKey => $contentValue) {
                if (!is_array($contentValue)) {
                    $mergedContent[$contentKey] ??= $contentValue;

                    continue;
                }

                $mergedContent[$contentKey] ??= [];
                //  @phpstan-ignore argument.type
                $mergedContent[$contentKey] = array_merge($mergedContent[$contentKey], $contentValue);
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

    /**
     * @param array<string,mixed> $propertyValue
     */
    private function countArrayItems(array $propertyValue): int
    {
        $count = 0;
        foreach ($propertyValue as $item) {
            if (is_array($item)) {
                $count++;
            }
        }

        return $count;
    }
}
