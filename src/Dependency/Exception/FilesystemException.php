<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Exception;

use Picamator\TransferObject\Shared\Exception\TransferExceptionInterface;
use RuntimeException;

class FilesystemException extends RuntimeException implements TransferExceptionInterface
{
}
