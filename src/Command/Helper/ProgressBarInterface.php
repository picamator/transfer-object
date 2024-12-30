<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command\Helper;

interface ProgressBarInterface
{
    public function progressStart(int $max = 0): void;

    public function progressAdvance(): void;

    public function progressFinish(): void;
}
