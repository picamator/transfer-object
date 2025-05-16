<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

use Fiber;
use Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

interface TransferGeneratorFacadeInterface
{
    /**
     * Specification:
     * - Provides a transfer object generator fiber.
     * - Starts the fiber with the provided `$configPath`.
     * - Suspends the fiber after loading the configuration.
     * - Suspends the fiber again after generating the transfer object,
     * - Suspends returns a `TransferGeneratorTransfer`.
     * - The `TransferGeneratorTransfer` object may contain error messages if issues occur during generation.
     * - Returns `true` when the process is successful, or `false` otherwise.
     *
     * @api
     *
     * @example /src/Command/TransferGeneratorCommand.php
     *
     * @throws \Picamator\TransferObject\Shared\Exception\TransferExceptionInterface
     * @throws \FiberError
     * @throws \Throwable
     *
     * @return \Fiber<string,null,bool,TransferGeneratorTransfer>
     */
    public function getTransferGeneratorFiber(): Fiber;

    /**
     * Specification:
     * - Provides a transfer object bulk generator fiber.
     * - Starts the fiber with the provided `$configListPath`.
     * - Suspends the fiber after validating `$configListPath`.
     * - Suspends the fiber again after processing each configuration file from the list
     * - Suspends returns a `TransferGeneratorBulkTransfer`.
     * - The `TransferGeneratorBulkTransfer` object may contain error messages if issues occur during generation.
     * - Returns `true` when the process is successful, or `false` otherwise.
     *
     * @api
     *
     * @example /src/Command/TransferGeneratorBulkCommand.php
     *
     * @throws \Picamator\TransferObject\Shared\Exception\TransferExceptionInterface
     * @throws \FiberError
     * @throws \Throwable
     *
     * @return \Fiber<string,null,bool,TransferGeneratorBulkTransfer>
     */
    public function getTransferGeneratorBulkFiber(): Fiber;

    /**
     * Specification:
     * - Loads the configuration from the specified path.
     * - Generates transfer objects based on the loaded configuration.
     * - Throws an exception if an error occurs during configuration loading or transfer object generation.
     * - Returns the number of successfully generated transfer objects.
     *
     * @api
     *
     * @example /examples/try-transfer-generator.php
     * @example /examples/try-advanced-transfer-generator.php
     *
     * @throws \Picamator\TransferObject\Shared\Exception\TransferExceptionInterface
     */
    public function generateTransfersOrFail(string $configPath): int;
}
