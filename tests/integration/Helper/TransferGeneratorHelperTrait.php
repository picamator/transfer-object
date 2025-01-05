<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper;

use ArrayObject;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;

trait TransferGeneratorHelperTrait
{
    /**
     * @throws \Throwable
     */
    protected static function generateTransfersOrFail(string $configPath): void
    {
        new TransferGeneratorFacade()->generateTransfersOrFail($configPath);
    }

    /**
     * @throws \Throwable
     */
    protected function generateTransfersCallback(string $configPath, callable $postGenerateItemCallback): bool
    {
        $generatorFiber = new TransferGeneratorFacade()->getTransferGeneratorFiber();

        $generatorTransfer = $generatorFiber->start($configPath);
        if ($generatorTransfer !== null) {
            $postGenerateItemCallback($generatorTransfer);
        }

        while (!$generatorFiber->isTerminated()) {
            $generatorTransfer = $generatorFiber->resume();
            if ($generatorTransfer !== null) {
                $postGenerateItemCallback($generatorTransfer);
            }
        }

        return $generatorFiber->getReturn();
    }

    protected function assertGeneratorSuccess(TransferGeneratorTransfer $generatorTransfer): void
    {
        $message = $this->groupValidatorMessages($generatorTransfer->validator->errorMessages);

        $this->assertTrue($generatorTransfer->validator->isValid, $message);
    }

    /**
     * @param ArrayObject<int, \Picamator\TransferObject\Generated\ValidatorMessageTransfer> $validatorMessages
     */
    private function groupValidatorMessages(ArrayObject $validatorMessages): string
    {
        $message = '';
        foreach ($validatorMessages as $validatorMessage) {
            $message .= $validatorMessage->errorMessage . PHP_EOL;
        }

        return $message;
    }
}
