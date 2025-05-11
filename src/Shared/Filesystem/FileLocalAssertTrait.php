<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Filesystem;

use Picamator\TransferObject\Shared\Exception\FileLocalException;

trait FileLocalAssertTrait
{
    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileLocalException
     */
    final protected function assertFileLocal(string $filename): void
    {
        if (stream_is_local($filename)) {
            return;
        }

        throw new FileLocalException(sprintf('File "%s" is not a local one.', $filename));
    }
}
