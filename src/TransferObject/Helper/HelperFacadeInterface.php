<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper;

use ArrayObject;

interface HelperFacadeInterface
{
    /**
     * Specification:
     * - Generates Transfer Objects based on Definitions files
     * - Returns `ArrayObject` with failed Transfer Objects generation
     * - Returns empty `ArrayObject` when there are no errors
     *
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     *
     * @return \ArrayObject<int,\Picamator\TransferObject\Generated\GeneratorTransfer>
     */
    public function generateTransfers(string $configPath): ArrayObject;

    /**
     * Specification:
     * - Generates Definitions by provided JSON
     * - Saves Definition on the file
     * - Returns `true` in success or `false` otherwise
     *
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     */
    public function generateDefinitions(): bool;
}
