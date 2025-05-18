<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Helper;

trait FileStreamHelperTrait
{
    /**
     * @var false|resource|null
     */
    private $file;

    /**
     * @return false|resource
     */
    protected function getTempFileStream(string $mode = 'r')
    {
        return $this->file ??= fopen('php://temp', $mode);
    }

    protected function closeTempFileStream(): void
    {
        if (!isset($this->file)) {
            return;
        }

        if ($this->file === false) {
            unset($this->file);

            return;
        }

        fclose($this->file);
        unset($this->file);
    }
}
