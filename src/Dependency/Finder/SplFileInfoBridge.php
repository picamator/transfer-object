<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Finder;

use SplFileInfo;
use Symfony\Component\Finder\SplFileInfo as SymfonySplFileInfo;

final class SplFileInfoBridge extends SplFileInfo
{
    public function __construct(private readonly SymfonySplFileInfo $fileInfo)
    {
        parent::__construct($fileInfo->getRealPath());
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
