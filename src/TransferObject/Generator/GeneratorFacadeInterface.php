<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator;

use Fiber;

interface GeneratorFacadeInterface
{
    /**
     * Specification:
     * - Suspends Fiber on creating temporary
     * - Suspends Fiber after each Transfer Object generation returning `\Picamator\TransferObject\Generated\GeneratorTransfer`
     * - Returns `true` when whole process is successful, `false` otherwise
     * - Returns `false` if any definition file was found
     *
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     */
    public function getGeneratorFiber(): Fiber;
}
