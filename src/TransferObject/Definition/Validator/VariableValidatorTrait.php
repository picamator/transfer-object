<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator;

trait VariableValidatorTrait
{
    /**
     * @see https://www.php.net/manual/en/language.oop5.basic.php
     * @see https://www.php.net/manual/en/language.variables.basics.php
     */
    private const string VARIABLE_NAME_PATTERN = '#^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$#';

    public function isValid(?string $variableName): bool
    {
        return preg_match(static::VARIABLE_NAME_PATTERN, $variableName) >= 1;
    }
}
