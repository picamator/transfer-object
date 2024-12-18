<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper;

use Picamator\TransferObject\Transfer\Generated\HelperTransfer;

interface HelperFacadeInterface
{
    /**
     * Specification:
     * - Generates definitions by content data
     * - Saves definitions on the file
     * - Returns generated definitions number
     *
     * @throws \Picamator\TransferObject\Exception\HelperTransferException
     */
    public function generateDefinitions(HelperTransfer $helperTransfer): int;
}
