<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\GetTypeEnum;

interface ContentInterface
{
    public function getType(): GetTypeEnum;

    public function getPropertyName(): string;

    public function getPropertyValue(): mixed;
}
