<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Expander;

use Picamator\TransferObject\DefinitionGenerator\Builder\ContentInterface;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Shared\Validator\VariableValidatorTrait;

final class TransferTypeBuilderExpander extends AbstractBuilderExpander
{
    use BuilderExpanderTrait;
    use VariableValidatorTrait;

    protected function isApplicable(ContentInterface $content): bool
    {
        if (!$content->getType()->isArray() || empty($content->getPropertyValue())) {
            return false;
        }

        /** @var array<int|string, mixed> $propertyValue */
        $propertyValue = $content->getPropertyValue();
        $key = key($propertyValue);

        return is_string($key) && $this->isValidVariable($key);
    }

    protected function handleExpander(
        ContentInterface $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        $propertyTransfer = $this->createPropertyTransfer($content->getPropertyName());
        $builderTransfer->definitionContent->properties[] = $propertyTransfer;

        /** @var array<int|string, mixed> $propertyValue */
        $propertyValue = $content->getPropertyValue();
        $className = $propertyTransfer->transferType?->name ?: '';

        $builderTransfer->generatorContents[] = $this->createGeneratorContentTransfer($className, $propertyValue);
    }

    private function createPropertyTransfer(string $propertyName): DefinitionPropertyTransfer
    {
        $typeTransfer = new DefinitionEmbeddedTypeTransfer();
        $typeTransfer->name = $this->getClassName($propertyName);

        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->transferType = $typeTransfer;
        $propertyTransfer->isNullable = true;
        $propertyTransfer->isProtected = false;

        return $propertyTransfer;
    }
}
