<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content\Builder;

use Picamator\TransferObject\DefinitionGenerator\Content\Enum\GetTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Shared\Validator\VariableValidatorTrait;

readonly class ContentBuilder implements ContentBuilderInterface
{
    use VariableValidatorTrait;

    public function createBuilderContent(string $propertyName, mixed $propertyValue): Content
    {
        $this->assertPropertyName($propertyName);
        $typeEnum = $this->getTypeEnum($propertyName, $propertyValue);

        return new Content($typeEnum, $propertyName, $propertyValue);
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    private function getTypeEnum(string $propertyName, mixed $propertyValue): GetTypeEnum
    {
        /** @var GetTypeEnum|null $typeEnum */
        $typeEnum = gettype($propertyValue) |> GetTypeEnum::tryFrom(...);

        if ($typeEnum !== null) {
            return $typeEnum;
        }

        throw new DefinitionGeneratorException(
            sprintf(
                'Property "%s" with type "%s" is not supported.',
                $propertyName,
                get_debug_type($propertyValue),
            ),
        );
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    private function assertPropertyName(string $propertyName): void
    {
        if ($this->isValidVariable($propertyName)) {
            return;
        }

        throw new DefinitionGeneratorException(
            sprintf('Invalid property name "%s".', $propertyName),
        );
    }
}
