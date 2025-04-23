<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

use Fiber;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

interface TransferGeneratorFacadeInterface
{
    /**
     * Specification:
     * - Provides a transfer object generator fiber.
     * - Starts the fiber with the provided `$configPath`.
     * - Suspends the fiber after loading the configuration.
     * - Suspends the fiber again after generating the transfer object, returning a `TransferGeneratorTransfer`.
     * - The `TransferGeneratorTransfer` object may contain error messages if issues occur during generation.
     * - Returns `true` when the process is successful, or `false` otherwise.
     *
     * @return \Fiber<string,null,bool,TransferGeneratorTransfer>
     * @throws \Picamator\TransferObject\Shared\Exception\TransferExceptionInterface
     * @throws \FiberError
     *
     * @throws \Throwable
     * @example ./src/Command/TransferGeneratorCommand.php
     *
     * @api
     *
     */
    public function getTransferGeneratorFiber(): Fiber;

    /**
     * Specification:
     * - Loads the configuration from the specified path.
     * - Generates transfer objects based on the loaded configuration.
     * - Throws an exception if an error occurs during configuration loading or transfer object generation.
     *
     * @throws \Picamator\TransferObject\Shared\Exception\TransferExceptionInterface
     *
     * @api
     *
     * @example ./doc/samples/try-transfer-generator.php
     * @example ./doc/samples/try-advanced-transfer-generator.php
     */
    public function generateTransfersOrFail(string $configPath): void;
}
