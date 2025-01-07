<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Validator;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

interface ClassNameValidatorInterface
{
    public function validate(?string $className): ValidatorMessageTransfer;
}
