<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Filesystem;

use ArrayObject;
use Picamator\TransferObject\Shared\Filesystem\FileCacheAppenderInterface;
use Picamator\TransferObject\Shared\Reader\FileCacheReaderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\FilesystemEnum;

class CacheFilesystem implements CacheFilesystemInterface
{
    use FilesystemTrait;

    private const string FILE_NAME = FilesystemEnum::CACHE_FILE_NAME->value;

    /**
     * @var array<string, \ArrayObject<string, string>>
     */
    private array $cachePerConfiguration = [];

    public function __construct(
        private readonly FileCacheReaderInterface $fileReader,
        private readonly FileCacheAppenderInterface $fileAppender,
        private readonly ConfigInterface $config,
    ) {
    }

    public function readFromCache(): ArrayObject
    {
        $uuid = $this->config->getUuid();
        $fromCache = $this->cachePerConfiguration[$uuid] ?? null;
        if ($fromCache !== null) {
            return $fromCache;
        }

        // resetting cache
        $this->cachePerConfiguration = [];

        $filePath = $this->getTransferPath(self::FILE_NAME);
        $this->cachePerConfiguration[$uuid] = $this->fileReader->readFile($filePath);

        return $this->cachePerConfiguration[$uuid];
    }

    public function readFromTempCache(): ArrayObject
    {
        $filePath = $this->getTemporaryPath(self::FILE_NAME);

        return $this->fileReader->readFile($filePath);
    }

    public function appendToTempCache(string $className, string $hash): void
    {
        $filePath = $this->getTemporaryPath(self::FILE_NAME);
        $this->fileAppender->appendToFile($filePath, $className, $hash);
    }

    public function closeTempCache(): void
    {
        $filePath = $this->getTemporaryPath(self::FILE_NAME);
        $this->fileAppender->closeFile($filePath);
    }
}
