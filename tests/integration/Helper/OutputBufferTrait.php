<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper;

trait OutputBufferTrait
{
    final protected function getOutputBuffer(string $scriptPath): bool|string
    {
        ob_start();
        include $scriptPath;

        return ob_get_clean();
    }
}
