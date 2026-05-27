<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\Shared\Exception\TransferExceptionInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Render\ErrorMessageRenderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Workflow\TransferGeneratorWorkflowInterface;

readonly class TransferGeneratorService implements TransferGeneratorServiceInterface
{
    public function __construct(
        private ErrorMessageRenderInterface $errorMessageRender,
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

            $exception = $this->createException($generatorTransfer);
            $generator->throw($exception);
        }

        return $count;
    }

    private function createException(TransferGeneratorTransfer $generatorTransfer): TransferExceptionInterface
    {
        $errorMessage = $this->errorMessageRender->render($generatorTransfer);

        return new TransferGeneratorException($errorMessage);
    }
}
