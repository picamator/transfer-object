<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Expander;

use Picamator\TransferObject\DefinitionGenerator\Builder\BuilderContentInterface;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

readonly class TransferTypeBuilderExpander implements BuilderExpanderInterface
{
    use BuilderExpanderTrait;

    public function isApplicable(BuilderContentInterface $content): bool
    {
        if (!$content->getType()->isArray() || empty($content->getPropertyValue())) {
            return false;
        }

        $propertyValue = (array)$content->getPropertyValue();
        $key = key($propertyValue);

        return is_string($key) && $this->isValidVariable($key);
    }

    public function expandBuilderTransfer(
        BuilderContentInterface $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        $propertyTransfer = $this->createPropertyTransfer($content->getPropertyName());
        $builderTransfer->definitionContent->properties[] = $propertyTransfer;

        $builderTransfer->generatorContents[] = $this->createGeneratorContentTransfer(
            $propertyTransfer->transferType?->name ?: '',
            $content->getPropertyValue(),
        );
    }

    private function createPropertyTransfer(string $propertyName): DefinitionPropertyTransfer
    {
        $typeTransfer = new DefinitionEmbeddedTypeTransfer();
        $typeTransfer->name = $this->getClassName($propertyName);

        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->transferType = $typeTransfer;

        return $propertyTransfer;
    }
}
