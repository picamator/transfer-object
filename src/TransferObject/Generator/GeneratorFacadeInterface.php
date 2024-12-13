<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator;

use Closure;

interface GeneratorFacadeInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     */
    public function generateTransfers(Closure $errorItemCallback): bool;
}
