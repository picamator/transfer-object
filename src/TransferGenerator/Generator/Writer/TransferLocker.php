<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Writer;

use Picamator\TransferObject\Shared\Locker\FileLockerInterface;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;

readonly class TransferLocker implements TransferLockerInterface
{
    private const string LOCK_FILE_NAME = 'transfer.lock';

    public function __construct(
        private FileLockerInterface $fileLocker,
        private ConfigInterface $config,
    ) {
    }

    public function acquireLock(): void
    {
        $lockFilePath = $this->getLockFilePath();
        $this->fileLocker->acquireLock($lockFilePath);
    }

    public function releaseLock(): void
    {
        $this->fileLocker->releaseLock();
    }

    private function getLockFilePath(): string
    {
        return $this->config->getTransferPath() . DIRECTORY_SEPARATOR . self::LOCK_FILE_NAME;
    }
}
