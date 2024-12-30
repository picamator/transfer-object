<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command\Helper;

use Symfony\Component\Console\Style\SymfonyStyle;

readonly class ProgressBar implements ProgressBarInterface
{
    public function __construct(
        private SymfonyStyle $symfonyStyle,
    ) {
    }

    public function progressStart(int $max = 0): void
    {
        $this->symfonyStyle->progressStart($max);
    }

    public function progressAdvance(): void
    {
        $this->symfonyStyle->progressAdvance();
    }

    public function progressFinish(): void
    {
        $this->symfonyStyle->progressFinish();
    }
}
