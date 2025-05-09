<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Exception;

use InvalidArgumentException;
use Picamator\TransferObject\Shared\Exception\TransferExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ServiceNotFoundException extends InvalidArgumentException implements
    NotFoundExceptionInterface,
    TransferExceptionInterface
{
}
