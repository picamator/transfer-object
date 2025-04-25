<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Validator;

interface NamespaceValidatorInterface
{
    public function isValidNamespace(?string $namespace): bool;
}
