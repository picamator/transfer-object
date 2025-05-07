<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper;

trait ExtensionHelperTrait
{
    protected function isBcMathLoaded(): bool
    {
        return extension_loaded('bcmath');
    }
}
