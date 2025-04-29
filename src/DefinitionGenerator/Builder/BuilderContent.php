<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\GetTypeEnum;

readonly class BuilderContent implements BuilderContentInterface
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
}
