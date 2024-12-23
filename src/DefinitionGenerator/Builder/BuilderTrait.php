<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\VariableTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;

trait BuilderTrait
{
    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    protected function assertPropertyName(int|string $propertyName): void
    {
        if (is_int($propertyName)) {
            throw new DefinitionGeneratorException(
                'Cannot generate definition based on root Level integer indexes.'
            );
        }
    }

    protected function getClassName(string $propertyName): string
    {
        $className = ucwords($propertyName, '_');

        return str_replace('_', '', $className);
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    protected function getTypeEnum(string $propertyName, mixed $propertyValue): VariableTypeEnum
    {
        $propertyType = gettype($propertyValue);
        $typeEnum = VariableTypeEnum::tryFrom($propertyType);
        if ($typeEnum === null) {
            throw new DefinitionGeneratorException(
                sprintf(
                    'Property "%s" type "%s" is not supported.',
                    $propertyName,
                    $propertyType,
                ),
            );
        }

        return VariableTypeEnum::tryFrom($propertyType);
    }

    /**
     * @param array<int|string,mixed> $content
     */
    protected function createGeneratorContentTransfer(string $className, array $content): DefinitionGeneratorContentTransfer
    {
        $contentTransfer = new DefinitionGeneratorContentTransfer();
        $contentTransfer->className = $className;
        $contentTransfer->content = $content;

        return $contentTransfer;
    }
}
