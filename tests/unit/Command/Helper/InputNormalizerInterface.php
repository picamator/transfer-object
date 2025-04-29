<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Command\Helper;

interface InputNormalizerInterface
{
    public function normalizePath(?string $value): string;

    public function normalizeInput(?string $value): string;
}
