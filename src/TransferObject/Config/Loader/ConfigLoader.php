<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Config\Loader;

use Picamator\TransferObject\Config\Container\ConfigContainer;
use Picamator\TransferObject\Config\Filesystem\ConfigFilesystemInterface;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ConfigValidatorTransfer;

readonly class ConfigLoader implements ConfigLoaderInterface
{
    private const string ERROR_MESSAGE_TEMPLATE = 'Cannot load configuration. Missed required configuration keys "%s".';

    public function __construct(
        private ConfigFilesystemInterface $filesystem,
    ) {
    }

    public function loadConfig(string $configPath): ConfigValidatorTransfer
    {
        $configTransfer = $this->filesystem->getConfig($configPath);
        $validatorTransfer = $this->validateConfig($configTransfer);

        if ($validatorTransfer->isValid) {
            ConfigContainer::loadConfig($configTransfer);
        }

        return $validatorTransfer;
    }

    private function validateConfig(ConfigTransfer $configTransfer): ConfigValidatorTransfer
    {
        $validatorTransfer = new ConfigValidatorTransfer();
        $validatorTransfer->isValid = true;

        $configContent = $configTransfer->toArray();
        $missedConfig = array_diff_key($configContent, array_filter($configContent));

        if (count($missedConfig) > 0) {
            $validatorTransfer->isValid = false;
            $validatorTransfer->errorMessage = sprintf(
                self::ERROR_MESSAGE_TEMPLATE,
                implode(', ', array_keys($missedConfig)),
            );
        }

        return $validatorTransfer;
    }
}
