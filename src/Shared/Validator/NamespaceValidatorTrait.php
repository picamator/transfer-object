<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

trait NamespaceValidatorTrait
{
    private const string NAMESPACE_REGEX = '#^(?:[A-Z][a-zA-Z0-9_]*\\\\)*[A-Z][a-zA-Z0-9_]*$#';

    final protected function isValidNamespace(?string $namespace): bool
    {
        return $namespace !== null && preg_match(self::NAMESPACE_REGEX, $namespace) === 1;
    }
}
