<?php declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\VariableTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Exception\GeneratorTransferException;
use Picamator\TransferObject\Generated\HelperContentTransfer;

trait BuilderTrait
{
    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\GeneratorTransferException
     */
    protected function assertPropertyName(int|string $propertyName): void
    {
        if (is_int($propertyName)) {
            throw new GeneratorTransferException(
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
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\GeneratorTransferException
     */
    protected function getTypeEnum(string $propertyName, mixed $propertyValue): VariableTypeEnum
    {
        $propertyType = gettype($propertyValue);
        $typeEnum = VariableTypeEnum::tryFrom($propertyType);
        if ($typeEnum === null) {
            throw new GeneratorTransferException(
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
    protected function createHelperContentTransfer(string $className, array $content): HelperContentTransfer
    {
        $contentTransfer = new HelperContentTransfer();
        $contentTransfer->className = $className;
        $contentTransfer->content = $content;

        return $contentTransfer;
    }
}
