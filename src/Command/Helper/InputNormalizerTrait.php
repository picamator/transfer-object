<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command\Helper;

trait InputNormalizerTrait
{
    private function normalizePath(?string $value): string
    {
        $value = $this->normalizeEmpty($value);
        if ($value === '') {
            return '';
        }

        $workingDirectory = getcwd() ?: '';
        $value = ltrim($value, '\/');

        return $workingDirectory . DIRECTORY_SEPARATOR . $value;
    }

    private function normalizeEmpty(?string $value): string
    {
        return $value ? trim($value) : '';
    }
}
