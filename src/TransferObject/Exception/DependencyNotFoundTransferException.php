<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Exception;

use Psr\Container\NotFoundExceptionInterface;

class DependencyNotFoundTransferException extends TransferException implements NotFoundExceptionInterface
{
}
