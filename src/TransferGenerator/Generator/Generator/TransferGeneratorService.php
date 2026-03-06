<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Workflow\TransferGeneratorWorkflowInterface;

readonly class TransferGeneratorService implements TransferGeneratorServiceInterface
{
    private const string ERROR_MESSAGE = 'Failed to generate Transfer Objects.';

    private const string TRANSFER_OBJECT_MESSAGE_TEMPLATE = 'Transfer Object: "%s".';
    private const string DEFINITION_MESSAGE_TEMPLATE = 'Definition file: "%s".';

    public function __construct(
        private TransferGeneratorWorkflowInterface $workflow,
    ) {
    }

    public function generateTransfersOrFail(string $configPath): int
    {
        $count = 0;
        $generator = $this->workflow->generateTransfers($configPath);
        foreach ($generator as $generatorTransfer) {
            if ($generatorTransfer->validator->isValid === true) {
                $count++;

                continue;
            }

            $errorMessage = $this->getErrorMessage($generatorTransfer);
            $exception = new TransferGeneratorException($errorMessage);
            $generator->throw($exception);
        }

        return $count;
    }

    private function getErrorMessage(TransferGeneratorTransfer $generatorTransfer): string
    {
        $messageParts[] = self::ERROR_MESSAGE;
        if ($generatorTransfer->className !== null) {
            $messageParts[] = sprintf(self::TRANSFER_OBJECT_MESSAGE_TEMPLATE, $generatorTransfer->className);
        }

        if ($generatorTransfer->fileName !== null) {
            $messageParts[] = sprintf(self::DEFINITION_MESSAGE_TEMPLATE, $generatorTransfer->fileName);
        }

        $messageParts[] = PHP_EOL;

        $validatorMessages = $generatorTransfer->validator->errorMessages;
        foreach ($validatorMessages as $message) {
            $messageParts[] = $message->errorMessage;
        }

        return implode(PHP_EOL, $messageParts);
    }
}
