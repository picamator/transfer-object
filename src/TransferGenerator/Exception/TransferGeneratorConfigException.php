<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Exception;

use Exception;
use Picamator\TransferObject\Exception\TransferExceptionInterface;

class TransferGeneratorConfigException extends Exception implements TransferExceptionInterface
{
}