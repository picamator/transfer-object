<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Expander;

use ArrayObject;
use DateTime;
use DateTimeInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\BuilderContentInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\GetTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\ObjectTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;

final class BuildInTypeBuilderExpander extends AbstractBuilderExpander
{
    /**
     * phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter
     */
    protected function isApplicable(BuilderContentInterface $content): true
    {
        return true;
    }

    protected function handleExpander(
        BuilderContentInterface $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        $propertyTransfer = match (true) {
            $content->getType()->isString()
                //  @phpstan-ignore argument.type
                && DateTime::createFromFormat(DateTimeInterface::ATOM, $content->getPropertyValue()) !== false
                => $this->createDateTimePropertyTransfer($content->getPropertyName()),

            $content->getType()->isNull() || $content->getType()->isString()
                => $this->createPropertyTransfer($content->getPropertyName(), GetTypeEnum::string->name),

            $content->getType()->isObject() && $content->getPropertyValue() instanceof ArrayObject
                => $this->createPropertyTransfer($content->getPropertyName(), ObjectTypeEnum::ARRAY_OBJECT->value),

            $content->getType()->isObject() => throw new DefinitionGeneratorException(
                sprintf(
                    'Property "%s" with "%s" type is not supported.',
                    $content->getPropertyName(),
                    get_debug_type($content->getPropertyValue()),
                ),
            ),

            default => $this->createPropertyTransfer($content->getPropertyName(), $content->getType()->name),
        };

        $builderTransfer->definitionContent->properties[] = $propertyTransfer;
    }

    private function createDateTimePropertyTransfer(string $propertyName): DefinitionPropertyTransfer
    {
        $typeTransfer = new DefinitionEmbeddedTypeTransfer();
        $typeTransfer->name = ObjectTypeEnum::DATE_TIME->value;

        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->dateTimeType = $typeTransfer;
        $propertyTransfer->isNullable = true;
        $propertyTransfer->isProtected = false;

        return $propertyTransfer;
    }

    private function createPropertyTransfer(string $propertyName, string $buildInType): DefinitionPropertyTransfer
    {
        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->buildInType = BuildInTypeEnum::from($buildInType);

        return $propertyTransfer;
    }
}
