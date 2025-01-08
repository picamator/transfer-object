<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

trait TemplateExpanderTrait
{
    protected function enforceTransferInterface(string $propertyType): string
    {
        return 'TransferInterface&' . $propertyType;
    }
}
