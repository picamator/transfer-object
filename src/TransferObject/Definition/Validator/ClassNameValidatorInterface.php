<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator;

interface ClassNameValidatorInterface
{
    public function validate(?string $className): ?string;
}
