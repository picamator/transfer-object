<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Finder;

use Symfony\Component\Finder\SplFileInfo;

final readonly class SplFileInfoBridge
{
    public function __construct(private SplFileInfo $fileInfo)
    {
    }

    public function getRelativePath(): string
    {
        return $this->fileInfo->getRelativePath();
    }

    public function getRelativePathname(): string
    {
        return $this->fileInfo->getRelativePathname();
    }

    public function getFilenameWithoutExtension(): string
    {
        return $this->fileInfo->getFilenameWithoutExtension();
    }

    public function getContents(): string
    {
        return $this->fileInfo->getContents();
    }

    public function getFilename(): string
    {
        return $this->fileInfo->getFilename();
    }

    public function getRealPath(): string
    {
        return $this->fileInfo->getRealPath();
    }
}
