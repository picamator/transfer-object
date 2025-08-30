<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command\Helper;

trait InputNormalizerTrait
{
    final protected function normalizePath(mixed $value): string
    {
        $value = $this->normalizeInput($value);
        if ($value === '') {
            return '';
        }

        if (stream_is_local($value)) {
            return $this->getLocalPath($value);
        }

        return $value;
    }

    final protected function normalizeInput(mixed $value): string
    {
        return is_string($value) ? trim($value) : '';
    }

    private function getLocalPath(string $path): string
    {
        $workingDirectory = getcwd() ?: '';
        $value = ltrim($path, '.\/');

        return $workingDirectory . DIRECTORY_SEPARATOR . $value;
    }
}
