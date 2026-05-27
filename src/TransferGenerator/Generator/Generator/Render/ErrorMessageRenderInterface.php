<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Render;

use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

interface ErrorMessageRenderInterface
{
    public function render(TransferGeneratorTransfer $generatorTransfer): string;
}
