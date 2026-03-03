<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Exception;

use RuntimeException;

class FileLockerException extends RuntimeException implements TransferExceptionInterface
{
}
