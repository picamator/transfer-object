<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator;

use Closure;

interface GeneratorFacadeInterface
{
    /**
     * Specification:
     * - Generates Transfer Objects based on definitions files
     * - Executes `$errorItemCallback` with argument `\Picamator\TransferObject\Generated\GeneratorTransfer` for each failed Transfer Object generation
     * - Returns `true` when whole process is successful, `false` otherwise
     * - Returns `false` if any definition file was found
     *
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     */
    public function generateTransfers(Closure $errorItemCallback): bool;
}
