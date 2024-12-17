<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Reader;

use Generator;
use Picamator\TransferObject\Transfer\Generated\HelperContentTransfer;

interface HelperReaderInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\HelperTransferException
     *
     * @return \Generator<\Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer>
     */
    public function getDefinitionContents(HelperContentTransfer $helperContentTransfer): Generator;
}
