<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Exception;

use Exception;
use Picamator\TransferObject\Shared\Exception\TransferExceptionInterface;

class FileAppenderException extends Exception implements TransferExceptionInterface
{
}
