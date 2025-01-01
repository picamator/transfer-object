<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Exception;

use Exception;
use Picamator\TransferObject\Exception\TransferExceptionInterface;

class ConfigNotFoundException extends Exception implements TransferExceptionInterface
{
}
