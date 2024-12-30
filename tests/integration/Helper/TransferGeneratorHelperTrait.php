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
    protected function generateTransfers(callable $postGenerateItemCallback): bool
    {
        $generatorIterator = new TransferGeneratorFacade()->getTransferGenerator();

        foreach ($generatorIterator as $generatorTransfer) {
            $postGenerateItemCallback($generatorTransfer);
        }

        return $generatorIterator->getReturn();
    }

    /**
     * @throws \Throwable
     */
    protected function assertLoadConfigSuccess(string $configPath): void
    {
        $configTransfer = new TransferGeneratorFacade()->loadConfig($configPath);
        $message = $this->groupValidatorMessages($configTransfer->validator->errorMessages);

        $this->assertTrue($configTransfer->validator->isValid, $message);
    }

    protected function assertGeneratorSuccess(?TransferGeneratorTransfer $generatorTransfer): void
    {
        if ($generatorTransfer === null) {
            return;
        }

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
