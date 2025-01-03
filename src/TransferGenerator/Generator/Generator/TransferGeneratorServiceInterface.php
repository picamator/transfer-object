<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

interface TransferGeneratorServiceInterface
{
    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException
     */
    public function generateTransfersOrFail(string $configPath): void;
}
