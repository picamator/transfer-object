<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Exception;

use Exception;
use Picamator\TransferObject\Exception\TransferExceptionInterface;

class FilesystemException extends Exception implements TransferExceptionInterface
{
}
