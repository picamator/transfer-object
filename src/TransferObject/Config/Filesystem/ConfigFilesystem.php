<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Config\Filesystem;

use Picamator\TransferObject\Exception\ConfigTransferException;
use Symfony\Component\Filesystem\Filesystem;
use Throwable;

readonly class ConfigFilesystem implements ConfigFilesystemInterface
{
    public function __construct(
        private Filesystem $filesystem,
    ) {
    }

    public function exists(string $configPath): bool
    {
        try {
            return $this->filesystem->exists($configPath);
        } catch (Throwable $e) {
            throw new ConfigTransferException(
                sprintf(
                    'Cannot check file if "%s" exist.',
                    $configPath,
                ),
                previous: $e,
            );
        }
    }
}
