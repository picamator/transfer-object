<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Exception;

use Exception;
use Picamator\TransferObject\Exception\TransferExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class DependencyNotFoundException extends Exception implements NotFoundExceptionInterface, TransferExceptionInterface
{
}
