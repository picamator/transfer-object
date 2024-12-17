<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Definition;

use Picamator\TransferObject\Generated\HelperTransfer;
use Picamator\TransferObject\Generated\HelperValidatorTransfer;

interface DefinitionGeneratorInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     */
    public function generateDefinitions(HelperTransfer $helperTransfer): HelperValidatorTransfer;
}
