<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator;

use Picamator\TransferObject\Transfer\Generated\ValidatorTransfer;

interface ClassNameValidatorInterface
{
    public function validate(?string $className): ValidatorTransfer;
}
