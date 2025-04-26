<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

trait VariableValidatorTrait
{
    /**
     * @link https://www.php.net/manual/en/language.oop5.basic.php
     * @link https://www.php.net/manual/en/language.variables.basics.php
     */
    private const string VARIABLE_NAME_PATTERN = '#^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$#';

    protected function isValidVariable(?string $variableName): bool
    {
        return $variableName !== null && preg_match(self::VARIABLE_NAME_PATTERN, $variableName) === 1;
    }
}
