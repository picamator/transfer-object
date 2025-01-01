<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;

readonly class BulkTransferGenerator implements BulkTransferGeneratorInterface
{
    private const string ERROR_MESSAGE_TEMPLATE
        = 'Failed generating Transfer Object "%s" based on definition file "%s". Error: "%s".';

    public function __construct(
        private TransferGeneratorInterface $generator,
    ) {
    }

    /**
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     */
    public function generateTransfers(): void
    {
        $transferGenerator = $this->generator->getTransferGenerator();
        foreach ($this->generator->getTransferGenerator() as $generatorTransfer) {
            if ($generatorTransfer->validator?->isValid === true) {
                continue;
            }

            $transferGenerator->throw(new TransferGeneratorException());
            $this->throwError($generatorTransfer);
        }
    }

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException
     */
    private function throwError(TransferGeneratorTransfer $generatorTransfer): never
    {
        $errorMessage = $generatorTransfer->validator?->errorMessages[0] ?? null;
        throw new TransferGeneratorException(
            sprintf(
                self::ERROR_MESSAGE_TEMPLATE,
                $generatorTransfer->className ?: '',
                $generatorTransfer->fileName ?: '',
                $errorMessage?->errorMessage ?: '',
            ),
        );
    }
}
