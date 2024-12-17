<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Definition;

use Picamator\TransferObject\Generated\HelperTransfer;
use Picamator\TransferObject\Generated\HelperValidatorTransfer;

readonly class DefinitionGenerator implements DefinitionGeneratorInterface
{
    public function generateDefinitions(HelperTransfer $helperTransfer): HelperValidatorTransfer
    {
        return new HelperValidatorTransfer();
    }
}
