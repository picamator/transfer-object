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
use Picamator\TransferObject\Shared\Parser\DocBlockParserTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;

final class BuildInTypeBuilderExpander extends AbstractBuilderExpander
{
    use DocBlockParserTrait;

    private const string DOC_BLOCK_TEMPLATE = '%s<%s,%s>';

    private const string DOC_BLOCK_MIXED = 'mixed';

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

            $content->type->isArray() => $this->resolveArrayType($content),

            $content->type->isObject() => $this->resolveObjectType($content),

            $content->type->isNull() => $this->resolveNullType($content),

            default => $this->resolveDefaultType($content),
        };

        $builderTransfer->definitionContent->properties->append($propertyTransfer);
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

    private function resolveArrayType(Content $content): DefinitionPropertyTransfer
    {
        /** @var array<int|string,mixed> $propertyValue */
        $propertyValue = $content->propertyValue;
        $type = GetTypeEnum::array->name;

        if (count($propertyValue) > 0) {
            $keyType = array_key_first($propertyValue)
                    |> gettype(...)
                    |> GetTypeEnum::from(...);

            $valueType = array_first($propertyValue)
                    |> gettype(...)
                    |> GetTypeEnum::tryFrom(...);

            $type = sprintf(
                self::DOC_BLOCK_TEMPLATE,
                $type,
                $keyType->name,
                $valueType?->name ?: self::DOC_BLOCK_MIXED,
            );
        }

        return $this->createPropertyTransfer($content->propertyName, $type);
    }

    private function resolveNullType(Content $content): DefinitionPropertyTransfer
    {
        return $this->createPropertyTransfer($content->propertyName, GetTypeEnum::string->name);
    }

    private function resolveStringType(Content $content): DefinitionPropertyTransfer
    {
        /** @var string $propertyValue */
        $propertyValue = $content->propertyValue;
        if (DateTime::createFromFormat(DateTimeInterface::ATOM, $propertyValue) !== false) {
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
        $tapeWithDocBlock = $this->parseTypeWithDocBlock($buildInType) ?? [];

        /** @var string $type */
        $type = array_key_first($tapeWithDocBlock);
        $type = BuildInTypeEnum::from($type);

        $docBlock = array_first($tapeWithDocBlock);

        $buildInTypeTransfer = new DefinitionBuildInTypeTransfer();
        $buildInTypeTransfer->name = $type;
        $buildInTypeTransfer->dockBlock = $docBlock;

        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->buildInType = $buildInTypeTransfer;

        return $propertyTransfer;
    }
}
