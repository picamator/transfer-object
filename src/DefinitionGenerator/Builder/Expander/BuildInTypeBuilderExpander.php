<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Expander;

use ArrayObject;
use DateTime;
use DateTimeInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\ContentInterface;
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
    protected function isApplicable(ContentInterface $content): true
    {
        return true;
    }

    protected function handleExpander(
        ContentInterface $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        $propertyTransfer = match (true) {
            $content->getType()->isString() => $this->resolveStringType($content),
            $content->getType()->isNull() => $this->resolveNullType($content),
            $content->getType()->isObject() => $this->resolveObjectType($content),
            default => $this->resolveDefaultType($content),
        };

        $builderTransfer->definitionContent->properties[] = $propertyTransfer;
    }

    private function resolveDefaultType(ContentInterface $content): DefinitionPropertyTransfer
    {
        return $this->createPropertyTransfer($content->getPropertyName(), $content->getType()->name);
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    private function resolveObjectType(ContentInterface $content): DefinitionPropertyTransfer
    {
        if ($content->getPropertyValue() instanceof ArrayObject) {
            return $this->createPropertyTransfer($content->getPropertyName(), ObjectTypeEnum::ARRAY_OBJECT->value);
        }

        throw new DefinitionGeneratorException(
            sprintf(
                'Property "%s" with "%s" type is not supported.',
                $content->getPropertyName(),
                get_debug_type($content->getPropertyValue()),
            ),
        );
    }

    private function resolveNullType(ContentInterface $content): DefinitionPropertyTransfer
    {
        return $this->createPropertyTransfer($content->getPropertyName(), GetTypeEnum::string->name);
    }

    private function resolveStringType(ContentInterface $content): DefinitionPropertyTransfer
    {
        //  @phpstan-ignore argument.type
        if (DateTime::createFromFormat(DateTimeInterface::ATOM, $content->getPropertyValue()) !== false) {
            return $this->createDateTimePropertyTransfer($content->getPropertyName());
        }

        return $this->createPropertyTransfer($content->getPropertyName(), GetTypeEnum::string->name);
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
