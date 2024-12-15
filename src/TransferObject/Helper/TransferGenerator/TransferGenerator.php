<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\TransferGenerator;

use ArrayObject;
use Picamator\TransferObject\Config\ConfigFacadeInterface;
use Picamator\TransferObject\Exception\HelperTransferException;
use Picamator\TransferObject\Generated\GeneratorTransfer;
use Picamator\TransferObject\Generator\GeneratorFacadeInterface;

readonly class TransferGenerator implements TransferGeneratorInterface
{
    public function __construct(
        private ConfigFacadeInterface $configFacade,
        private GeneratorFacadeInterface $generatorFacade,
    ) {
    }

    public function generateTransfers(string $configPath): ArrayObject
    {
        $this->loadConfig($configPath);

        /** @var \ArrayObject<int,\Picamator\TransferObject\Generated\GeneratorTransfer> $generatorTransfers */
        $generatorTransfers = new ArrayObject();
        $errorItemCallback = fn(GeneratorTransfer $generatorTransfer) => $generatorTransfers[] = $generatorTransfer;

        $this->generatorFacade->generateTransfers($errorItemCallback);

        return $generatorTransfers;
    }

    /**
     * @throws \Picamator\TransferObject\Exception\HelperTransferException
     */
    private function loadConfig(string $configPath): void
    {
        $configValidatorTransfer = $this->configFacade->loadConfig($configPath);

        if (!$configValidatorTransfer->isValid) {
            throw new HelperTransferException($configValidatorTransfer->errorMessage);
        }
    }
}
