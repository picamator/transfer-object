<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;

readonly class BulkTransferGenerator implements BulkTransferGeneratorInterface
{
    private const string ERROR_MESSAGE = 'Failed to generate Transfer Objects.';
    private const string ERROR_MESSAGE_TEMPLATE = 'Error: "%s".';

    private const string TRANSFER_OBJECT_MESSAGE_TEMPLATE = 'Transfer Object: "%s".';
    private const string DEFINITION_MESSAGE_TEMPLATE = 'Definition file: "%s".';

    public function __construct(
        private TransferGeneratorInterface $generator,
    ) {
    }

    /**
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     */
    public function generateTransfers(string $configPath): void
    {
        $transferGenerator = $this->generator->getTransferGenerator($configPath);
        foreach ($transferGenerator as $generatorTransfer) {
            if ($generatorTransfer->validator?->isValid === true) {
                continue;
            }

            $this->throwError($generatorTransfer);
        }
    }

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException
     */
    private function throwError(TransferGeneratorTransfer $generatorTransfer): never
    {
        $messageParts = [self::ERROR_MESSAGE];
        if ($generatorTransfer->className !== null) {
            $messageParts[] = sprintf(self::TRANSFER_OBJECT_MESSAGE_TEMPLATE, $generatorTransfer->className);
        }

        if ($generatorTransfer->fileName !== null) {
            $messageParts[] = sprintf(self::DEFINITION_MESSAGE_TEMPLATE, $generatorTransfer->fileName);
        }

        $validatorMessage = $generatorTransfer->validator?->errorMessages[0] ?? null;
        if ($validatorMessage?->errorMessage !== null) {
            $messageParts[] = sprintf(self::ERROR_MESSAGE_TEMPLATE, $validatorMessage->errorMessage);
        }

        throw new TransferGeneratorException(implode(' ', $messageParts));
    }
}
