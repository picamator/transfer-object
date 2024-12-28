<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper;

trait CleanTmpHelperTrait
{
    protected function deleteTmpDir(string $generatedPath): void
    {
        $generatedPath .= '/_tmp';
        if (!is_dir($generatedPath)) {
            return;
        }

        $files = glob($generatedPath . '/*Transfer.php') ?: [];
        array_map('unlink', $files);

        rmdir($generatedPath);
    }
}
