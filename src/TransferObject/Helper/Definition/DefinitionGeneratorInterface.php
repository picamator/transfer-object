<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Definition;

use Picamator\TransferObject\Transfer\Generated\HelperTransfer;

interface DefinitionGeneratorInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\HelperTransferException
     */
    public function generateDefinitions(HelperTransfer $helperTransfer): int;
}
