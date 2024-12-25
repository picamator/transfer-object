<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper;

use Picamator\TransferObject\Generated\TransferGeneratorCallbackTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFacade;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;

trait TransferGeneratorHelperTrait
{
    /**
     * @throws \Throwable
     */
    protected function generateTransfers(callable $postGenerateItemCallback): bool
    {
        $generatorFiber = new TransferGeneratorFacade()->getTransferGeneratorFiber();

        $generatorFiber->start();
        while (!$generatorFiber->isTerminated()) {
            /** @var \Picamator\TransferObject\Generated\TransferGeneratorCallbackTransfer|null $generatorTransfer */
            $generatorTransfer = $generatorFiber->resume();
            $postGenerateItemCallback($generatorTransfer);
        }

        return $generatorFiber->getReturn();
    }

    /**
     * @throws \Throwable
     */
    protected function loadConfig(string $configPath): ValidatorMessageTransfer
    {
        return new ConfigFacade()->loadConfig($configPath);
    }

    protected function assertGenerateTransferSuccessCallback(?TransferGeneratorCallbackTransfer $generatorTransfer): void
    {
        if ($generatorTransfer === null) {
            return;
        }

        $isValid = $generatorTransfer->validator->isValid;
        $assertMessage = !$isValid
            ? 'Fail asserting success' . PHP_EOL . var_export($generatorTransfer->toArray(), true)
            : '';

        $this->assertTrue($isValid, $assertMessage);
    }
}
