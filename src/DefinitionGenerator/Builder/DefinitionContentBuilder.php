<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\GetTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;

readonly class DefinitionContentBuilder implements DefinitionContentBuilderInterface
{
    public function createBuilderContent(string $propertyName, mixed $propertyValue): BuilderContentInterface
    {
        if (is_numeric($propertyName)) {
            throw new DefinitionGeneratorException(
                sprintf(
                    'Invalid property name "%s".',
                    $propertyName,
                ),
            );
        }

        $typeEnum = $this->getTypeEnum($propertyName, $propertyValue);

        return new BuilderContent($typeEnum, $propertyName, $propertyValue);
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    private function getTypeEnum(string $propertyName, mixed $propertyValue): GetTypeEnum
    {
        $propertyType = gettype($propertyValue);
        $typeEnum = GetTypeEnum::tryFrom($propertyType);
        if ($typeEnum !== null) {
            return $typeEnum;
        }

        throw new DefinitionGeneratorException(
            sprintf(
                'Property "%s" with type "%s" is not supported.',
                $propertyName,
                $propertyType,
            ),
        );
    }
}
