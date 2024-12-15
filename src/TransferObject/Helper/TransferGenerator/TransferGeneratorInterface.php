<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\TransferGenerator;

use ArrayObject;

interface TransferGeneratorInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     * @throws \Picamator\TransferObject\Exception\HelperTransferException
     *
     * @return \ArrayObject<int,\Picamator\TransferObject\Generated\GeneratorTransfer>
     */
    public function generateTransfers(string $configPath): ArrayObject;
}
