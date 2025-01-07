<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper;

trait OutputBufferHelperTrait
{
    protected function getOutputBuffer(string $scriptPath): bool|string
    {
        try {
            ob_start();
            include $scriptPath;
        } finally {
            return ob_get_clean();
        }
    }
}
