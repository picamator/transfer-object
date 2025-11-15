<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content\Expander;

use Picamator\TransferObject\DefinitionGenerator\Content\Builder\Content;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

final class CollectionTypeBuilderExpander extends AbstractBuilderExpander
{
    use BuilderExpanderTrait;

    private const \Closure SEARCH_IS_ARRAY_CALLBACK = static function (mixed $value): bool {
        return is_array($value);
    };

    protected function isApplicable(Content $content): bool
    {
        if (!$content->type->isArray() || empty($content->propertyValue)) {
            return false;
        }

        /** @var array<string, mixed> $propertyValue */
        $propertyValue = $content->propertyValue;

        return array_all($propertyValue, self::SEARCH_IS_ARRAY_CALLBACK);
    }

    protected function handleExpander(
        Content $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        $propertyTransfer = $this->createPropertyTransfer($content->propertyName);
        $builderTransfer->definitionContent->properties->append($propertyTransfer);


        $mergedContent = $this->mergeContent($content);
        $className = $propertyTransfer->collectionType?->name ?: '';

        $builderTransfer->generatorContents[] = $this->createGeneratorContentTransfer($className, $mergedContent);
    }

    /**
     * @return array<int|string, mixed>
     */
    private function mergeContent(Content $content): array
    {
        $mergedContent = [];

        /** @var array<string, array<string, mixed>> $propertyValue */
        $propertyValue = $content->propertyValue ?: [];

        foreach ($propertyValue as $contentItem) {
            $contentItemMixed = array_filter($contentItem, $this->filterNonArray(...));
            /** @var array<int|string, array<int|string,mixed>> $contentItemArray */
            $contentItemArray = array_filter($contentItem, $this->filterOnlyArray(...));

            $this->mergeContentMixed($contentItemMixed, $mergedContent);
            $this->mergeContentArray($contentItemArray, $mergedContent);
        }

        return $mergedContent;
    }

    /**
     * @param array<int|string, mixed> $contentItem
     * @param array<int|string, mixed> $mergedContent
     */
    private function mergeContentMixed(array $contentItem, array &$mergedContent): void
    {
        foreach ($contentItem as $contentKey => $contentValue) {
            $mergedContent[$contentKey] ??= $contentValue;
        }
    }

    /**
     * @param array<int|string, array<int|string,mixed>> $contentItem
     * @param array<int|string, mixed> $mergedContent
     */
    private function mergeContentArray(array $contentItem, array &$mergedContent): void
    {
        foreach ($contentItem as $contentKey => $contentValue) {
            $mergedContent[$contentKey] ??= [];
            if (is_array($mergedContent[$contentKey])) {
                $mergedContent[$contentKey] = array_merge($mergedContent[$contentKey], $contentValue);
            }
        }
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
