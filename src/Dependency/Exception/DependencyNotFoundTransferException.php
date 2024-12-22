<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Dependency\Exception;

use Picamator\TransferObject\Exception\TransferException;
use Psr\Container\NotFoundExceptionInterface;

class DependencyNotFoundTransferException extends TransferException implements NotFoundExceptionInterface
{
}
