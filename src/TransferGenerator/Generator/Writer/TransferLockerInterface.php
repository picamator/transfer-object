<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Writer;

interface TransferLockerInterface
{
    public function acquireLock(): void;

    public function releaseLock(): void;
}
