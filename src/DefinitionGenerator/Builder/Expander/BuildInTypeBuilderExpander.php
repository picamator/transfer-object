<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Expander;

use ArrayObject;
use Picamator\TransferObject\DefinitionGenerator\Builder\BuilderContentInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\GetTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\ObjectTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

readonly class BuildInTypeBuilderExpander implements BuilderExpanderInterface
{
    use BuilderExpanderTrait;

    public function isApplicable(BuilderContentInterface $content): true
    {
        return true;
    }

    public function expandBuilderTransfer(
        BuilderContentInterface $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        $propertyTransfer = match(true) {
            $content->getType()->isNull() || $content->getType()->isString()
                => $this->createPropertyTransfer($content->getPropertyName(), GetTypeEnum::string->name),

            !$content->getType()->isObject()
                => $this->createPropertyTransfer($content->getPropertyName(), $content->getType()->name),

            $content->getPropertyValue() instanceof ArrayObject
                => $this->createPropertyTransfer($content->getPropertyName(), ObjectTypeEnum::ARRAY_OBJECT->value),

            is_iterable($content->getPropertyValue())
                => $this->createPropertyTransfer($content->getPropertyName(), ObjectTypeEnum::ITERABLE->value),

            default => throw new DefinitionGeneratorException(
                sprintf(
                    'Property "%s" type "%s" is not supported.',
                    $content->getPropertyName(),
                    get_class($content->getPropertyValue()),
                ),
            ),
        };

        $builderTransfer->definitionContent->properties[] = $propertyTransfer;
    }

    private function createPropertyTransfer(string $propertyName, string $buildInType): DefinitionPropertyTransfer
    {
        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->buildInType = $buildInType;

        return $propertyTransfer;
    }
}
