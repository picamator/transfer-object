<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Exception;

use Picamator\TransferObject\Shared\Exception\TransferExceptionInterface;
use RuntimeException;

class PropertyTypeTransferException extends RuntimeException implements TransferExceptionInterface
{
}
