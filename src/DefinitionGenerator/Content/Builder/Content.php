<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content\Builder;

use Picamator\TransferObject\DefinitionGenerator\Content\Enum\GetTypeEnum;

readonly class Content implements ContentInterface
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
