<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content\Expander;

use ArrayObject;
use DateTime;
use DateTimeInterface;
use Picamator\TransferObject\DefinitionGenerator\Content\Builder\Content;
use Picamator\TransferObject\DefinitionGenerator\Content\Enum\GetTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Content\Enum\ObjectTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionBuildInTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;

final class BuildInTypeBuilderExpander extends AbstractBuilderExpander
{
    /**
     * phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter
     */
    protected function isApplicable(Content $content): true
    {
        return true;
    }

    protected function handleExpander(
        Content $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        $propertyTransfer = match (true) {
            $content->type->isString() => $this->resolveStringType($content),

            $content->type->isNull() => $this->resolveNullType($content),

            $content->type->isObject() => $this->resolveObjectType($content),

            default => $this->resolveDefaultType($content),
        };

        $builderTransfer->definitionContent->properties[] = $propertyTransfer;
    }

    private function resolveDefaultType(Content $content): DefinitionPropertyTransfer
    {
        return $this->createPropertyTransfer($content->propertyName, $content->type->name);
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    private function resolveObjectType(Content $content): DefinitionPropertyTransfer
    {
        if ($content->propertyValue instanceof ArrayObject) {
            return $this->createPropertyTransfer($content->propertyName, ObjectTypeEnum::ARRAY_OBJECT->value);
        }

        throw new DefinitionGeneratorException(
            sprintf(
                'Property "%s" with "%s" type is not supported.',
                $content->propertyName,
                get_debug_type($content->propertyValue),
            ),
        );
    }

    private function resolveNullType(Content $content): DefinitionPropertyTransfer
    {
        return $this->createPropertyTransfer($content->propertyName, GetTypeEnum::string->name);
    }

    private function resolveStringType(Content $content): DefinitionPropertyTransfer
    {
        //  @phpstan-ignore argument.type
        if (DateTime::createFromFormat(DateTimeInterface::ATOM, $content->propertyValue) !== false) {
            return $this->createDateTimePropertyTransfer($content->propertyName);
        }

        return $this->createPropertyTransfer($content->propertyName, GetTypeEnum::string->name);
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
        $buildItTypeTransfer = new DefinitionBuildInTypeTransfer();
        $buildItTypeTransfer->name = BuildInTypeEnum::from($buildInType);

        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->buildInType = $buildItTypeTransfer;

        return $propertyTransfer;
    }
}
