<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content\Builder;

use Picamator\TransferObject\DefinitionGenerator\Content\Enum\GetTypeEnum;

readonly class Content
{
    public function __construct(
        public GetTypeEnum $type,
        public string $propertyName,
        public mixed $propertyValue,
    ) {
    }
}
