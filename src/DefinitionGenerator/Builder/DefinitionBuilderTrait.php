<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\GetTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;

trait DefinitionBuilderTrait
{
    protected function createBuilderContent(string $propertyName, mixed $propertyValue): BuilderContentInterface
    {
        $this->assertPropertyName($propertyName);
        $typeEnum = $this->getTypeEnum($propertyName, $propertyValue);

        return new readonly class($typeEnum, $propertyName, $propertyValue) implements BuilderContentInterface
        {
            public function __construct(
                private GetTypeEnum $type,
                private string $propertyName,
                private mixed $propertyValue,
            ) {
            }

            public function getType(): GetTypeEnum
            {
                return $this->type;
            }

            public function getPropertyName(): string
            {
                return $this->propertyName;
            }

            public function getPropertyValue(): mixed
            {
                return $this->propertyValue;
            }
        };
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    private function getTypeEnum(string $propertyName, mixed $propertyValue): GetTypeEnum
    {
        $propertyType = gettype($propertyValue);
        $typeEnum = GetTypeEnum::tryFrom($propertyType);
        if ($typeEnum === null) {
            throw new DefinitionGeneratorException(
                sprintf(
                    'Property "%s" type "%s" is not supported.',
                    $propertyName,
                    $propertyType,
                ),
            );
        }

        return $typeEnum;
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    private function assertPropertyName(int|string $propertyName): void
    {
        if (is_int($propertyName)) {
            throw new DefinitionGeneratorException(
                'Cannot generate definition based on integer indexes.'
            );
        }
    }
}