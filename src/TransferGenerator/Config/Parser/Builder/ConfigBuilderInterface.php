<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser\Builder;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;

interface ConfigBuilderInterface
{
    public function createConfigTransfer(
        ValidatorTransfer $validatorTransfer,
        ?ConfigContentTransfer $contentTransfer = null,
    ): ConfigTransfer;

    public function createErrorConfigTransfer(string $errorMessage): ConfigTransfer;
}
