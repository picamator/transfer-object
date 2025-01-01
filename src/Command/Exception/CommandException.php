<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command\Exception;

use Exception;
use Picamator\TransferObject\Exception\TransferExceptionInterface;

class CommandException extends Exception implements TransferExceptionInterface
{
}
