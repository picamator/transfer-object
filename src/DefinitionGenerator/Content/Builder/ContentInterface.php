<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content\Builder;

use Picamator\TransferObject\DefinitionGenerator\Content\Enum\GetTypeEnum;

interface ContentInterface
{
    public function getType(): GetTypeEnum;

    public function getPropertyName(): string;

    public function getPropertyValue(): mixed;
}
