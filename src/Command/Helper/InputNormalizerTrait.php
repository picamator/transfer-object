<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command\Helper;

trait InputNormalizerTrait
{
    final protected function normalizePath(?string $value): string
    {
        $value = $this->normalizeInput($value);
        if ($value === '') {
            return '';
        }

        $workingDirectory = getcwd() ?: '';
        $value = ltrim($value, '\/');

        return $workingDirectory . DIRECTORY_SEPARATOR . $value;
    }

    final protected function normalizeInput(?string $value): string
    {
        return $value ? trim($value) : '';
    }
}
