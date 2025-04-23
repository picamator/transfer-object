<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Exception;

use Exception;
use Picamator\TransferObject\Shared\Exception\TransferExceptionInterface;

class PropertyTypeTransferException extends Exception implements TransferExceptionInterface
{
}
