<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

use Fiber;
use Picamator\TransferObject\Generated\ConfigTransfer;

interface TransferGeneratorFacadeInterface
{
    /**
     * Specification:
     * - Provides Transfer Generator Fiber
     * - First Suspend on creating temporary directory
     * - Next Suspend after generating each Transfer Object passing `TransferGeneratorCallbackTransfer` as argument
     * - Fiber returns `true` when whole process is successful, `false` otherwise
     *
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     * @throws \FiberError
     *
     * @return \Fiber<null,null,bool,\Picamator\TransferObject\Generated\TransferGeneratorCallbackTransfer>
     */
    public function getTransferGeneratorFiber(): Fiber;

    /**
     * Specification:
     * - Reads and parses provided configuration file
     * - Statically loads configuration to reuse for transfer object generation
     *
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     */
    public function loadConfig(string $configPath): ConfigTransfer;
}
