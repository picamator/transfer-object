<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content\Expander;

use Picamator\TransferObject\DefinitionGenerator\Content\Builder\Content;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Shared\Validator\VariableValidatorTrait;

final class TransferTypeBuilderExpander extends AbstractBuilderExpander
{
    use BuilderExpanderTrait;
    use VariableValidatorTrait;

    protected function isApplicable(Content $content): bool
    {
        if (!$content->type->isArray() || empty($content->propertyValue)) {
            return false;
        }

        /** @var array<int|string, mixed> $propertyValue */
        $propertyValue = $content->propertyValue;

        return array_all(
            $propertyValue,
            // phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter
            fn(mixed $value, int|string $key): bool => is_string($key) && $this->isValidVariable($key)
        );
    }

    protected function handleExpander(
        Content $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        $propertyTransfer = $this->createPropertyTransfer($content->propertyName);
        $builderTransfer->definitionContent->properties->append($propertyTransfer);

        /** @var array<int|string, mixed> $propertyValue */
        $propertyValue = $content->propertyValue;
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
