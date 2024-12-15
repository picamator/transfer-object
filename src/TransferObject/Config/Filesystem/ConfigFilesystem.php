<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Config\Filesystem;

use Picamator\TransferObject\Exception\ConfigTransferException;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Symfony\Component\Yaml\Parser;
use Throwable;

readonly class ConfigFilesystem implements ConfigFilesystemInterface
{
    private const string CONFIG_SECTION_KEY = 'generator';

    public function __construct(
        private Parser $yml
    ) {
    }

    public function getConfig(string $configPath): ConfigTransfer
    {
        $configContent = $this->parseConfig($configPath)[self::CONFIG_SECTION_KEY] ?? [];

        return new ConfigTransfer()->fromArray($configContent);
    }

    /**
     * @throws \Picamator\TransferObject\Exception\ConfigTransferException
     *
     * @return array<string, mixed>
     */
    private function parseConfig(string $configPath): array
    {
        try {
            return $this->yml->parseFile($configPath);
        } catch (Throwable $e) {
            throw new ConfigTransferException(
                sprintf(
                    'Cannot parse configuration file "%s".',
                    $configPath,
                ),
                previous: $e,
            );
        }
    }
}
