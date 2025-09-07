<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Expander;

use Override;
use Picamator\TransferObject\DefinitionGenerator\Builder\BuilderContentInterface;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Shared\Validator\VariableValidatorTrait;

final class TransferTypeBuilderExpander extends AbstractBuilderExpander
{
    use BuilderExpanderTrait;
    use VariableValidatorTrait;

    #[Override]
    protected function isApplicable(BuilderContentInterface $content): bool
    {
        if (!$content->getType()->isArray() || empty($content->getPropertyValue())) {
            return false;
        }

        $propertyValue = (array)$content->getPropertyValue();
        $key = key($propertyValue);

        return is_string($key) && $this->isValidVariable($key);
    }

    protected function handleExpander(
        BuilderContentInterface $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        $propertyTransfer = $this->createPropertyTransfer($content->getPropertyName());
        $builderTransfer->definitionContent->properties[] = $propertyTransfer;

        /** @var array<int|string, mixed> $propertyValue */
        $propertyValue = $content->getPropertyValue();

        $builderTransfer->generatorContents[] = $this->createGeneratorContentTransfer(
            $propertyTransfer->transferType?->name ?: '',
            $propertyValue,
        );
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
