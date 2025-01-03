<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Validator;

interface NamespaceValidatorInterface
{
    public function isValidNamespace(?string $namespace): bool;
}
